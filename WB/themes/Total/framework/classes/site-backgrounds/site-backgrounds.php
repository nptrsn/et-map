<?php
/**
 * Used for custom site backgrounds
 *
 * @package     Total
 * @subpackage  Framework
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 2.0.0
 * @version     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Start Class
if ( ! class_exists( 'WPEX_Site_Backgrounds' ) ) {
    
    class WPEX_Site_Backgrounds {

        /**
         * Main constructor
         *
         * @since Total 2.0.0
         */
        function __construct() {
            add_filter( 'wpex_head_css', array( $this, 'get_css' ), 999 );
        }

        /**
         * Generates the CSS output
         *
         * @since Total 2.0.0
         */
        public function get_css( $output ) {

            // Global object
            global $wpex_theme;

            // Vars
            $css = $add_css = '';

            // Global vars
            $css        = '';
            $color      = get_theme_mod( 'background_color' );
            $image      = get_theme_mod( 'background_image' );
            $style      = get_theme_mod( 'background_style' );
            $pattern    = get_theme_mod( 'background_pattern' );
            $post_id    = $wpex_theme->post_id;

            // Single post vars
            if ( $post_id ) {

                // Color
                $single_color = get_post_meta( $post_id, 'wpex_page_background_color', true );
                $single_color = str_replace( '#', '', $single_color );

                // Image
                $single_image = get_post_meta( $post_id, 'wpex_page_background_image_redux', true );
                if ( $single_image ) {
                    if ( is_array( $single_image ) ) {
                        $single_image = ( ! empty( $single_image['url'] ) ) ? $single_image['url'] : '';
                    } else {
                        $single_image = $single_image;
                    }
                } else {
                    $single_image = get_post_meta( $post_id, 'wpex_page_background_image', true );
                }

                // Background style
                $single_style = get_post_meta( $post_id, 'wpex_page_background_image_style', true );

            }

            /*-----------------------------------------------------------------------------------*/
            /*  - Sanitize Data
            /*-----------------------------------------------------------------------------------*/

            // Color
            $color  = ! empty( $single_color ) ? $single_color : $color;
            $color  = str_replace( '#', '', $color );

            // Image
            $image  = ! empty( $single_image ) ? $single_image : $image;

            // Style
            $style  = ( ! empty( $single_image ) && ! empty( $single_style ) ) ? $single_style : $style;
            $style  = $style ? $style : 'stretched';

            /*-----------------------------------------------------------------------------------*/
            /*  - Generate CSS
            /*-----------------------------------------------------------------------------------*/

            // Color
            if ( $color ) {
                $css .= 'background-color:#'. $color .'!important;';
            }
            
            // Image
            if ( $image && ! $pattern ) {
                $css .= 'background-image:url('. $image .');';
                if ( $style == 'stretched' ) {
                    $css .= '-webkit-background-size: cover;
                            -moz-background-size: cover;
                            -o-background-size: cover;
                            background-size: cover;
                            background-position: center center;
                            background-attachment: fixed;
                            background-repeat: no-repeat;';
                }
                elseif ( $style == 'repeat' ) {
                    $css .= 'background-repeat:repeat;';
                }
                elseif ( $style == 'fixed' ) {
                    $css .= 'background-repeat: no-repeat;
                            background-position: center center;
                            background-attachment: fixed;';
                }
            }
            
            // Pattern
            if ( $pattern ) {
                $css .= 'background-image:url('. $pattern .'); background-repeat:repeat;';
            }

            /*-----------------------------------------------------------------------------------*/
            /*  - Return $css
            /*-----------------------------------------------------------------------------------*/
            if ( ! empty( $css ) ) {
                $css = '/*SITE BACKGROUND*/body{'. $css .'}';
                $output .= $css;
            }

            // Return output css
            return $output;

        }

    }

}
new WPEX_Site_Backgrounds();
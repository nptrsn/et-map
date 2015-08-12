<?php
/**
 * Used for generating custom layouts CSS
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
if ( ! class_exists( 'WPEX_Advanced_Styling' ) ) {
    
    class WPEX_Advanced_Styling {

        /**
         * Main constructor
         *
         * @since Total 2.0.0
         */
        public function __construct() {
            add_filter( 'wpex_head_css', array( $this, 'generate' ), 999 );
        }

        /**
         * Generates the CSS output
         *
         * @since Total 2.0.0
         */
        public function generate( $output ) {

            // Get global object
            global $wpex_theme;

            // Define main variables
            $css            = '';
            $add_css        = '';
            $header_height  = '';
            $post_id        = $wpex_theme->post_id;

            /*-----------------------------------------------------------------------------------*/
            /*  - Fixed Header Height - Can't cache this code
            /*-----------------------------------------------------------------------------------*/
            if ( ! $wpex_theme->has_overlay_header ) {
                if ( 'one' == $wpex_theme->header_style ) {
                    $header_top_padding     = intval( get_theme_mod( 'header_top_padding' ) );
                    $header_bottom_padding  = intval( get_theme_mod( 'header_bottom_padding' ) );
                    $header_height          = intval( get_theme_mod( 'header_height' ) );
                    if ( $header_height && '0' != $header_height && 'auto' != $header_height ) {
                        if ( $header_top_padding || $header_bottom_padding ) {
                            $header_height_plus_padding = $header_height + $header_top_padding + $header_bottom_padding;
                        } else {
                            $header_height_plus_padding = $header_height + '60';
                        }
                        $css .= '.header-one #site-header {
                                    height: '. $header_height .'px;
                                }

                                .header-one #site-navigation-wrap,
                                .navbar-style-one .dropdown-menu > li > a {
                                    height:'. $header_height_plus_padding .'px
                                }

                                .navbar-style-one .dropdown-menu > li > a {
                                    line-height:'. $header_height_plus_padding .'px
                                }

                                .header-one #site-logo,
                                .header-one #site-logo a {
                                    height:'. $header_height .'px;line-height:'. $header_height .'px
                                }';
                    }
                }
            }

            /*-----------------------------------------------------------------------------------*/
            /*  - Logo
            /*-----------------------------------------------------------------------------------*/
            // Reset $add_css var
            $add_css = '';

            // Logo top/bottom margins only if custom header height is empty
            if ( ! $header_height ) {

                // Logo top margin
                $margin = intval( get_theme_mod( 'logo_top_margin' ) );
                if ( $margin && '0' != $margin ) {
                    if ( $header_height && '0' != $header_height && 'auto' != $header_height && $wpex_theme->header_logo ) {
                        $add_css .= 'padding-top: '. $margin .'px;';
                    } else {
                        $add_css .= 'margin-top: '. $margin .'px;';
                    }
                }
                
                // Logo bottom margin
                $margin = intval( get_theme_mod( 'logo_bottom_margin' ) );
                if ( $margin ) {
                    if ( $header_height && 'auto' != $header_height && $wpex_theme->header_logo ) {
                        $add_css .= 'padding-bottom: '. $margin .'px;';
                    } else {
                        $add_css .= 'margin-bottom: '. $margin .'px;';
                    }
                }

            }

            // #site-logo css
            if ( $add_css ) {
                $css .= '#site-logo {'. $add_css .'}';
                $add_css = '';
            }

            /*-----------------------------------------------------------------------------------*/
            /*  - Logo Max Widths
            /*-----------------------------------------------------------------------------------*/

            // Desktop
            if ( $width = get_theme_mod( 'logo_max_width' ) ) {
                $css .= '@media only screen and (min-width: 960px) {
                            #site-logo {
                                max-width: '. $width .';
                            }
                        }';
            }

            // Tablet Portrait
            if ( $width = get_theme_mod( 'logo_max_width_tablet_portrait' ) ) {
                $css .= '@media only screen and (min-width: 768px) and (max-width: 959px) {
                            #site-logo {
                                max-width: '. $width .';
                            }
                        }';
            }

            // Phone
            if ( $width = get_theme_mod( 'logo_max_width_phone' ) ) {
                $css .= '@media only screen and (max-width: 767px) {
                            #site-logo {
                                max-width: '. $width .';
                            }
                        }';
            }

            /*-----------------------------------------------------------------------------------*/
            /*  - Other
            /*-----------------------------------------------------------------------------------*/

            // Fix for Fonts In the Visual Composer
            $css .='.wpb_row
                    .fa:before {
                        box-sizing:content-box!important;
                        -moz-box-sizing:content-box!important;
                        -webkit-box-sizing:content-box!important;
                    }';

            // Remove header border if custom color is set
            if ( get_theme_mod( 'header_background' ) ) {
                $css .='.is-sticky #site-header{border-color:transparent;}';
            }
            
            /*-----------------------------------------------------------------------------------*/
            /*  - Return CSS
            /*-----------------------------------------------------------------------------------*/
            if ( ! empty( $css ) ) {
                $output .= '/*ADVANCED STYLING CSS*/'. $css;
            }

            // Return output css
            return $output;

        }

    }

}
new WPEX_Advanced_Styling();
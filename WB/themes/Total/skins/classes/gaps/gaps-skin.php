<?php
/**
 * Gaps Skin Class
 *
 * @package     Total
 * @subpackage  Skins
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.3.0
 * @version     2.0.2
 */

if ( ! class_exists( 'Total_Gaps_Skin' ) ) {
    
    class Total_Gaps_Skin {

        /**
         * Main constructor
         *
         * @since Total 1.3.0
         */
        public function __construct() {
            add_action( 'wp_enqueue_scripts', array( $this, 'load_styles' ), 999 );
            add_action( 'wp_head', array( $this, 'remove_header_menu' ), 10 );
        }

        /**
         * Load custom stylesheet for this skin
         *
         * @link    http://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts
         * @link    http://codex.wordpress.org/Function_Reference/wp_enqueue_style
         * @since   Total 1.3.0
         */
        public function load_styles() {
            wp_enqueue_style(
                'gaps-skin',                                            // Handle
                WPEX_SKIN_DIR_URI .'classes/gaps/css/gaps-style.css',   // Stylesheet URL
                array( 'wpex-style' ),                                  // Dependencies
                '1.0',                                                  // Version number
                'all'                                                   // Media
            );
        }

        /**
         * Remove the menu from the header_bottom hook for header styles 2 and 3
         *
         * @since Total 2.0.0
         */
        public function remove_header_menu() {
            global $wpex_theme;
            if ( in_array( $wpex_theme->header_style, array( 'two', 'three' ) ) ) {
                remove_action( 'wpex_hook_header_bottom', 'wpex_header_menu' );
                add_action( 'wpex_hook_main_before', array( $this, 'gaps_menu_two_three' ) );
            }
        }

        /**
         * Custom function for displaying menu styles 2 and 3 required for this skin
         *
         * @since Total 2.0.2
         */
        public function gaps_menu_two_three() {

            // Get global object and header style
            global $wpex_theme;
            $header_style = $wpex_theme->header_style;

            // Get current filter
            $filter = current_filter();

            // Set bool variable
            $get = false;

            // Check current filter against header style
            if ( in_array( $header_style, array( 'two', 'three' ) ) && 'wpex_hook_main_before' == $filter ) {
                $get = true;
            }

            // Get menu template part
            if ( $get ) {
                get_template_part( 'partials/header/header-menu' );
            }
            
        }
        

    }

}
new Total_Gaps_Skin();
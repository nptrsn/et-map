<?php
/**
 * Agent Skin Class
 *
 * @package     Total
 * @subpackage  Skins
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.3.0
 * @version     2.0.0
 */

if ( ! class_exists( 'Total_Agent_Skin' ) ) {
    
    class Total_Agent_Skin {

        /**
         * Main constructor.
         *
         * @since   Total 1.3.0
         * @access  public
         */
        public function __construct() {
            add_action( 'wp_enqueue_scripts', array( &$this, 'load_styles' ), 999 );
        }

        /**
         * Load custom stylesheet for this skin.
         *
         * @since   Total 1.3.0
         * @access  public
         *
         * @link    http://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts
         * @link    http://codex.wordpress.org/Function_Reference/wp_enqueue_style
         */
        public function load_styles() {
            wp_enqueue_style( 'wpex-agent-skin', WPEX_SKIN_DIR_URI .'classes/agent/css/agent-style.css', array( 'wpex-style' ), '1.0', 'all' );
        }

    }

}
new Total_Agent_Skin();
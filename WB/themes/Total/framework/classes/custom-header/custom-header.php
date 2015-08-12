<?php
/**
 * Adds support for the Custom Header image and adds it to the header
 *
 * @package     Total
 * @subpackage  Framework/Classes
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.6.3
 * @version     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'WPEX_Custom_Header' ) ) {
	class WPEX_Custom_Header {

		/**
		 * Main constructor
		 *
		 * @access  public
		 * @since Total 1.6.3
		 */
		public function __construct() {
			add_filter( 'after_setup_theme', array( $this, 'add_support' ) );
			add_filter( 'wpex_head_css', array( $this, 'custom_header_css' ), 99 );
		}

		/**
		 * Retrieves cached CSS or generates the responsive CSS
		 *
		 * @access  public
		 * @return  void
		 * @link    http://codex.wordpress.org/Plugin_API/Action_Reference/after_setup_theme
		 * @since   1.6.0
		 */
		public function add_support() {
			add_theme_support( 'custom-header', apply_filters( 'wpex_custom_header_args', array(
				'default-image'				=> '',
				'width'						=> 0,
				'height'					=> 0,
				'flex-width'				=> true,
				'flex-height'				=> true,
				'admin-head-callback'		=> 'wpex_admin_header_style',
				'admin-preview-callback'	=> 'wpex_admin_header_image',
			) ) );
		}

		/**
		 * Displays header image as a background for the header
		 *
		 * @access  public
		 * @return  void
		 * @link    http://codex.wordpress.org/Plugin_API/Action_Reference/after_setup_theme
		 * @since   1.6.0
		 */
		public function custom_header_css( $output ) {
			if ( $header_image = get_header_image() ) {
				$output .= '#site-header{background-image:url('. $header_image .');background-size: cover;}';
			}
			return $output;
		}


	}
}
new WPEX_Custom_Header();
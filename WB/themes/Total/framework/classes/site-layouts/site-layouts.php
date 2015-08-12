<?php
/**
 * Used for generating custom layouts CSS
 *
 * @package     Total
 * @subpackage  Framework
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
if ( ! class_exists( 'WPEX_Responsive_Widths_CSS' ) ) {
	
	class WPEX_Responsive_Widths_CSS {

		/**
		 * Main constructor
		 *
		 * @since Total 1.6.3
		 */
		public function __construct() {
			add_filter( 'wpex_head_css', array( $this, 'get_css' ), 999 );
		}

		/**
		 * Retrieves cached CSS or generates the responsive CSS
		 *
		 * @since Total 1.6.3
		 */
		public function get_css( $output ) {

			// Get global object
			global $wpex_theme;
			$this->main_layout = $wpex_theme->main_layout;
			$this->active_skin = $wpex_theme->skin;

			// Vars
			$css = $add_css = '';

			/*-----------------------------------------------------------------------------------*/
			/*  - Desktop Width
			/*-----------------------------------------------------------------------------------*/
			
			// Main Container With
			if ( $width = get_theme_mod( 'main_container_width', false ) ) {
				if ( 'boxed' == $this->main_layout || 'gaps' == $this->active_skin ) {
					$add_css .= '.boxed-main-layout #wrap {
									width:'. $width .';
									max-width:none;
								}';
				} else {
					$add_css .= '.container,
								.vc_row-fluid.container {
									width: '. $width .' !important;
									max-width:none;
								}';
				}
			}
			
			// Left container width
			if ( $width = get_theme_mod( 'left_container_width', false ) ) {
				$add_css .= '.content-area{
								width:'. $width .';
								max-width:none;
							}';
			}

			// Sidebar width
			if ( $width = get_theme_mod( 'sidebar_width', false ) ) {
				$add_css .= '#sidebar{
								width: '. $width .';
								max-width:none;
							}';
			}

			// Add to $css var
			if ( $add_css ) {
				$css .= '@media only screen and (min-width: 1281px){
							'. $add_css .'
						}';
				$add_css = '';
			}


			/*-----------------------------------------------------------------------------------*/
			/*  - Tablet Landscape & Small Screen Widths
			/*-----------------------------------------------------------------------------------*/

			// Main Container With
			if ( $width = get_theme_mod( 'tablet_landscape_main_container_width', false ) ) {
				if ( 'boxed' == $this->main_layout || 'gaps' == $this->active_skin ) {
					$add_css .= '.boxed-main-layout #wrap{
									width:'. $width .';
									max-width:none;
								}';
				} else {
					$add_css .= '.container,
								.vc_row-fluid.container {
									width: '. $width .' !important;
									max-width:none;
								}';
				}
			}

			// Left container width
			if ( $width = get_theme_mod( 'tablet_landscape_left_container_width', false ) ) {
				$add_css .= '.content-area{
								width:'. $width .';
								max-width:none;
							}';
			}

			// Sidebar width
			if ( $width = get_theme_mod( 'tablet_landscape_sidebar_width', false )  ) {
				$add_css .= '#sidebar{
								width: '. $width .';
								max-width:none;
							}';
			}

			// Add to $css var
			if ( $add_css ) {
				$css .= '@media only screen and (min-width: 960px) and (max-width: 1280px) {
							'. $add_css .'
						}';
				$add_css = '';
			}
			

			/*-----------------------------------------------------------------------------------*/
			/*  - Tablet Widths
			/*-----------------------------------------------------------------------------------*/

			// Main Container With
			if ( $width = get_theme_mod( 'tablet_main_container_width', false ) ) {
				if ( 'boxed' == $this->main_layout || 'gaps' == $this->active_skin ) {
					$add_css .= '.boxed-main-layout #wrap{
									width:'. $width .';
									max-width:none;
								}';
				} else {
					$add_css .= '.container,
								.vc_row-fluid.container {
									width: '. $width .' !important;
									max-width:none;
								}';
				}
			}

			// Left container width
			if ( $width = get_theme_mod( 'tablet_left_container_width', false ) ) {
				$add_css .= '.content-area{
								width:'. $width .';
							}';
			}

			// Sidebar width
			if ( $width = get_theme_mod( 'tablet_sidebar_width', false ) ) {
				$add_css .= '#sidebar{
								width: '. $width .';
							}';
			}

			// Add to $css var
			if ( $add_css ) {
				$css .= '@media only screen and (min-width: 768px) and (max-width: 959px){
							'. $add_css .'
						}';
				$add_css = '';
			}

			/*-----------------------------------------------------------------------------------*/
			/*  - Phone Widths
			/*-----------------------------------------------------------------------------------*/
			
			// Phone Portrait
			if ( $width = get_theme_mod( 'mobile_portrait_main_container_width', false ) ) {
				if ( 'boxed' == $this->main_layout || 'gaps' == $this->active_skin ) {
					$css .= '@media only screen and (max-width: 767px) {
							.boxed-main-layout #wrap {
								width: '. $width .' !important; min-width: 0;
							}
						}';
				} else {
					$css .= '@media only screen and (max-width: 767px) {
							.container {
								width: '. $width .' !important; min-width: 0;
							}
					}';
				}
			}
			
			// Phone Landscape
			if ( $width = get_theme_mod( 'mobile_landscape_main_container_width', false ) ) {
				if ( 'boxed' == $this->main_layout || 'gaps' == $this->active_skin ) {
					$css .= '@media only screen and (min-width: 480px) and (max-width: 767px) {
							.boxed-main-layout #wrap {
								width: '. $width .' !important;
							}
						}';
				} else {
					$css .= '@media only screen and (min-width: 480px) and (max-width: 767px) {
							.container {
								width: '. $width .' !important;
							}
					}';
				}
			}
		
			// Return custom CSS
			if ( ! empty( $css ) ) {
				$css = '/*RESPONSIVE WIDTHS*/'. $css;
				$output .= $css;
			}

			// Return output css
			return $output;

		}

	}

}
new WPEX_Responsive_Widths_CSS();
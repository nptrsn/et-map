<?php
/**
 * Revolution Slider Configurations
 *
 * @package     Total
 * @subpackage  Framework
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 2.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'WPEX_Revslider_Config' ) ) {

	class WPEX_Revslider_Config {

		/**
		 * Start things up
		 *
		 * @since 1.6.0
		 */
		public function __construct() {
			add_action( 'do_meta_boxes', array( &$this, 'remove_metabox' ) );
		}

		/**
		 * Remove the Slider revolution metabox where it isn't needed
		 *
		 * @since 1.6.0
		 */
		public function remove_metabox() {
			remove_meta_box( 'mymetabox_revslider_0', 'vc_grid_item', 'normal' );
			remove_meta_box( 'mymetabox_revslider_0', 'templatera', 'normal' );
		}

	}

}
new WPEX_Revslider_Config();
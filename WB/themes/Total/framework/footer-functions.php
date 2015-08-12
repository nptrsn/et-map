<?php
/**
 * Main footer functions
 *
 * @package		Total
 * @subpackage	Footer Functions
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.6.0
 */

/**
 * Conditional check if the footer callout is enabled or disabled
 *
 * @since	Total 1.0.0
 * @return	bool
 */
function wpex_has_footer_callout( $post_id = '' ) {

	// Return true by default
	$return = true;

	// Return false if disabled via Customizer
	if ( ! get_theme_mod( 'callout', true ) ) {
		$return = false;
	}

	// Check if disabled via custom field
	if ( 'on' == get_post_meta( $post_id, 'wpex_disable_footer_callout', true ) ) {
		$return = false;
	}

	// Check if disabled via custom field
	elseif ( 'enable' == get_post_meta( $post_id, 'wpex_disable_footer_callout', true ) ) {
		$return = true;
	}

	// Check if there is custom callout text added for specific ID
	elseif ( get_post_meta( $post_id, 'wpex_callout_text', true ) ) {
		$return = true;
	}

	// Apply filter for child theming
	$return = apply_filters( 'wpex_callout_enabled', $return );

	// Return bool
	return $return;
	
}

/**
 * Conditional check if the footer should display or not
 *
 * @since	Total 1.0
 * @return	bool
 */
function wpex_has_footer( $post_id = '' ) {

	// Return true by default
	$return		= true;

	// Check if disabled via page settings
	if ( 'on' == get_post_meta( $post_id, 'wpex_disable_footer', true ) ) {
		$return = false;
	}

	// Check if enabled via page settings
	if ( 'enable' == get_post_meta( $post_id, 'wpex_disable_footer', true ) ) {
		$return = true;
	}

	// Apply filters
	$return = apply_filters( 'wpex_display_footer', $return );

	// Return
	return $return;

}

/**
 * Conditional check if the footer widgets should display or not
 *
 * @since	Total 1.54
 * @return	bool
 */
function wpex_has_footer_widgets( $post_id = '' ) {

	// Check if enabled via the customizer
	$return = get_theme_mod( 'footer_widgets', true );

	// Check if disabled via page settings
	if ( 'on' == get_post_meta( $post_id, 'wpex_disable_footer_widgets', true ) ) {
		$return = false;
	}

	// Check if enabled via page settings
	if ( 'enable' == get_post_meta( $post_id, 'wpex_disable_footer_widgets', true ) ) {
		$return = true;
	}

	// Apply filters for child theming
	$return = apply_filters( 'wpex_display_footer_widgets', $return );

	// Return bool
	return $return;

}

/**
 * Conditional check if the footer reveal is enabled
 *
 * @since	Total 1.0
 * @return	bool
 */
function wpex_has_footer_reveal() {

	// Global object
	global $wpex_theme;

	// Disabled by default
	$return = false;

	// Theme option check
	if ( get_theme_mod( 'footer_reveal', false ) ) {
		$return = true;
	}

	// Meta check
	if ( $wpex_theme->post_id ) {
		if ( 'on' == get_post_meta( $wpex_theme->post_id, 'wpex_footer_reveal', true ) ) {
			$return = true;
		} elseif ( 'off' == get_post_meta( $wpex_theme->post_id, 'wpex_footer_reveal', true ) ) {
			$return = false;
		}
	}

	// Disable on 404
	if ( is_404() ) {
		$return = false;
	}

	// Disable on mobile
	if ( $wpex_theme->is_mobile ) {
		$return = false;
	}

	// Apply filters
	$return = apply_filters( 'wpex_has_footer_reveal', $return );

	// Disable on boxed style - ALWAYS
	if ( 'boxed' == $wpex_theme->main_layout ) {
		$return = false;
	}

	// Return
	return $return;

}
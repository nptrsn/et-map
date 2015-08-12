<?php
/**
 * Top Bar Functions
 *
 * @package		Total
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.0.0
 * @version		1.0.0
 */

/**
 * Checks if the top bar should display or not
 *
 * @since	Total 1.6.0
 * @return	bool
 */
function wpex_has_top_bar( $post_id = '' ) {

	// Return true by default
	$return = true;

	// Return false if disabled via Customizer
	if ( ! get_theme_mod( 'top_bar', true ) ) {
		$return = false;
	}

	// Return false if disabled via post meta
	if ( 'on' == get_post_meta( $post_id, 'wpex_disable_top_bar', true ) ) {
		$return = false;
	}

	// Return false if disabled via post meta
	if ( 'enable' == get_post_meta( $post_id, 'wpex_disable_top_bar', true ) ) {
		$return = true;
	}

	// Apply filers for child theming
	$return = apply_filters( 'wpex_is_top_bar_enabled', $return );

	// Return bool
	return $return;

}

/**
 * Topbar content
 *
 * @since Total 2.0.0
 */
function wpex_top_bar_content() {

	// Get topbar content from Customizer
	$content = get_theme_mod( 'top_bar_content', '[font_awesome icon="phone" margin_right="5px" color="#000"] 1-800-987-654 [font_awesome icon="envelope" margin_right="5px" margin_left="20px" color="#000"] admin@total.com [font_awesome icon="user" margin_right="5px" margin_left="20px" color="#000"] [wp_login_url text="User Login" logout_text="Logout"]' );

	// Translate the content
	$content = wpex_translate_theme_mod( 'top_bar_content', $content );

	// Apply filters
	$content = apply_filters( 'wpex_top_bar_content', $content );

	// Return content
	return $content;

}

/**
 * Topbar style
 *
 * @since Total 2.0.0
 */
function wpex_top_bar_style() {

	// Get style defined in Customizer
	$style = get_theme_mod( 'top_bar_style', 'one' );

	// Apply filters for child theming
	$style = apply_filters( 'wpex_top_bar_style', $style );

	// Return $style
	return $style;

}

/**
 * Topbar classes
 *
 * @since Total 2.0.0
 */
function wpex_top_bar_classes( $classes = array() ) {

	// Check for content
	if ( wpex_top_bar_content() ) {
		$classes[] = 'has-content';
	}

	// Add clearfix class
	$classes[] = 'clr';

	// Get topbar style
	$style = wpex_top_bar_style();

	// Add classes based on top bar style
	if ( 'one' == $style ) {
		$classes[] = 'top-bar-left';
	} elseif( 'two' == $style ) {
		$classes[] = 'top-bar-right';
	} elseif( 'three' == $style ) {
		$classes[] = 'top-bar-centered';
	}

	// Apply filters for child theming
	$classes = apply_filters( 'wpex_top_bar_classes', $classes );

	// Turn classes array into space seperated string
	$classes = implode( ' ', $classes );

	// Return classes
	return esc_attr( $classes );

}
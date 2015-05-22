<?php
/**
 * Child theme functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Text Domain: wpex
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/**
 * Load the parent style.css file
 */
function total_child_enqueue_parent_theme_style() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}
add_action( 'wp_enqueue_scripts', 'total_child_enqueue_parent_theme_style' );

// Change Meta
// Alter the meta sections array via the "wpex_meta_sections" filder
function my_wpex_meta_sections( $sections ) {

	// Your meta sections array ( you can move them around or remove some )
	$sections = array( 'author', 'date');
	
	// Return sections
	return $sections;

}
add_filter( 'wpex_meta_sections', 'my_wpex_meta_sections' );

// Conditionally Disable Fixed Header/Menu
function my_disable_fixed_header( $bool ) {

	// Disable on front page
	if ( is_front_page() ) {
		$bool = false;
	}

	// Return bool
	return $bool;

}
add_filter( 'wpex_has_fixed_header', 'my_disable_fixed_header' );
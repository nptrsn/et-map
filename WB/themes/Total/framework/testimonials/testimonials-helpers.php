<?php
/**
 * Helper functions for the testimonials post type
 *
 * @package		Total
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 2.0.0
 * @version		1.0.0
 */

/**
 * Returns correct thumbnail HTML for the testimonials entries
 *
 * @since Total 2.0.0
 */
function wpex_get_testimonials_entry_thumbnail() {
    return wpex_get_post_thumbnail( array(
        'size'  => 'testimonials_entry',
        'class' => 'testimonials-entry-img',
        'alt'	=> wpex_get_esc_title(),
    ) );
}

/**
 * Returns testimonials archive columns
 *
 * @since Total 2.0.0
 */
function wpex_testimonials_archive_columns() {
	return get_theme_mod( 'testimonials_entry_columns', '4' );
}

/**
 * Returns correct classes for the testimonials archive wrap
 *
 * @since	Total 2.0.0
 * @return	var $classes
 */
function wpex_get_testimonials_wrap_classes() {

	// Define main classes
	$classes = array( 'wpex-row', 'clr' );

	// Apply filters
	apply_filters( 'wpex_testimonials_wrap_classes', $classes );

	// Turninto space seperated string
	$classes = implode( " ", $classes );

	// Return
	return $classes;

}
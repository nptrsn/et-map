<?php
/**
 * Main staff entry template part
 *
 * @package		Total
 * @subpackage	Partials/Staff
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.6.0
 * @version		1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Counter for clearing floats and margins
if ( ! isset( $wpex_related_query ) ) {
	global $wpex_count;
	$query = 'archive';
} else {
	$query = 'related';
}

// Add Standard Classes
$classes	= array();
$classes[]	= 'staff-entry';
$classes[]	= 'col';
$classes[]	= wpex_staff_column_class( $query );
$classes[]	= 'col-'. $wpex_count;

// Get grid style
$wpex_grid_style = get_theme_mod( 'staff_archive_grid_style', 'fit-rows' );

// Masonry Classes
if ( 'archive' == $query && in_array( $wpex_grid_style, array( 'masonry', 'no-margins' ) ) ) {
	$classes[] = ' isotope-entry';
} ?>

<article id="#post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<?php get_template_part( 'partials/staff/staff-entry', 'media' ); ?>
	<?php get_template_part( 'partials/staff/staff-entry', 'content' ); ?>
</article><!-- .staff-entry -->
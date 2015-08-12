<?php
/**
 * Main testimonials entry template part
 *
 * @package		Total
 * @subpackage	Partials/Testimonials
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

// Get counter & increase it
global $wpex_count;

// Add classes to the entry
$classes	= array();
$classes[]	= 'testimonial-entry';
$classes[]	= 'col';
$classes[]	= wpex_grid_class( wpex_testimonials_archive_columns() );
$classes[]	= 'col-'. $wpex_count; ?>

<article id="#post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<?php get_template_part( 'partials/testimonials/testimonials-entry', 'content' ); ?>
	<div class="testimonial-entry-bottom">
		<?php get_template_part( 'partials/testimonials/testimonials-entry', 'avatar' ); ?>
		<?php get_template_part( 'partials/testimonials/testimonials-entry', 'meta' ); ?>
	</div><!-- .home-testimonial-entry-bottom -->
</article><!-- .testimonial-entry -->
<?php
/**
 * Single related posts
 *
 * @package		Total
 * @subpackage	Partials/Blog
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.6.0
 * @version		1.0.1
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if disabled
if ( ! get_theme_mod( 'blog_related', true ) ) {
	return;
}

// Number of columns for entries
$wpex_columns = apply_filters( 'wpex_related_blog_posts_columns', get_theme_mod( 'blog_related_columns', '3' ) );

// Create an array of current category ID's
$cats		= wp_get_post_terms( get_the_ID(), 'category' );
$cats_ids	= array();
foreach( $cats as $wpex_related_cat ) {
	$cats_ids[] = $wpex_related_cat->term_id;
}

// Query args
$args = array(
	'posts_per_page'		=> get_theme_mod( 'blog_related_count', '3' ),
	'orderby' 				=> 'rand',
	'category__in'			=> $cats_ids,
	'post__not_in'			=> array( get_the_ID() ),
	'no_found_rows'			=> true,
	'tax_query'				=> array (
		'relation'	=> 'AND',
		array (
			'taxonomy'	=> 'post_format',
			'field'		=> 'slug',
			'terms'		=> array( 'post-format-quote', 'post-format-link' ),
			'operator'	=> 'NOT IN',
		),
	),
);
$args = apply_filters( 'wpex_blog_post_related_query_args', $args );

// Related query arguments
$wpex_related_query = new wp_query( $args );

// If the custom query returns post display related posts section
if ( $wpex_related_query->have_posts() ) :

	// Wrapper classes
	$classes = 'related-posts clr';
	if ( 'full-screen' == wpex_get_post_layout() ) {
		$classes .= 'container';
	} ?>

	<div class="<?php echo $classes; ?>">
		<?php get_template_part( 'partials/blog/blog-single-related', 'heading' ); ?>
		<div class="wpex-row clr">
			<?php $wpex_count = 0; ?>
			<?php foreach( $wpex_related_query->posts as $post ) : setup_postdata( $post ); ?>
				<?php $wpex_count++; ?>
				<?php include( locate_template( 'partials/blog/blog-single-related-entry.php' ) ); ?>
				<?php if ( $wpex_columns == $wpex_count ) $wpex_count=0; ?>
			<?php endforeach; ?>
		</div><!-- .wpex-row -->
	</div><!-- .related-posts -->
<?php endif; ?>
<?php wp_reset_postdata(); ?>
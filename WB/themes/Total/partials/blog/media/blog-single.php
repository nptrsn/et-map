<?php
/**
 * Blog single post standard format media
 *
 * @package		Total
 * @subpackage	Partials/Blog/Media
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.6.0
 * @version		2.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get thumbnail
$thumbnail = wpex_get_blog_post_thumbnail();

// Return if there isn't a thumbnail
if ( ! $thumbnail ) {
    return;
} ?>

<div id="post-media" class="clr">

	<?php
	// Image with lightbox link
	if ( get_theme_mod( 'blog_post_image_lightbox' ) ) : ?>

		<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" class="wpex-lightbox<?php wpex_entry_image_animation_classes(); ?>" data-type="image">
			<?php echo $thumbnail; ?>
		</a><!-- .wpex-lightbox -->

	<?php
	// No lightbox
	else : ?>
		<?php echo $thumbnail; ?>
	<?php endif; ?>

	<?php
	// Blog entry caption
	if ( get_theme_mod( 'blog_thumbnail_caption' ) && $caption = wpex_featured_image_caption() ) : ?>
	
		<div class="post-media-caption clr">
			<?php echo $caption; ?>
		</div><!-- .post-media-caption -->

	<?php endif; ?>

</div><!-- #post-media -->
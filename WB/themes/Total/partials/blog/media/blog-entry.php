<?php
/**
 * Blog entry standard format media
 *
 * @package     Total
 * @subpackage  Partials/Blog/Media
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.6.0
 * @version     2.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get thumbnail
$thumbnail = wpex_get_blog_entry_thumbnail();

// Return if there isn't a thumbnail
if ( ! $thumbnail ) {
    return;
} ?>

<div class="blog-entry-media clr">

    <?php
    // Lightbox style entry
    if ( get_theme_mod( 'blog_entry_image_lightbox' ) ) : ?>

        <a href="<?php wpex_lightbox_image( get_post_thumbnail_id() ); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="blog-entry-media-link wpex-lightbox<?php wpex_entry_image_animation_classes(); ?>" data-type="image">
            <?php echo $thumbnail; ?>
        </a><!-- .blog-entry-media-link -->

    <?php
    // Standard link to post
    else : ?>
        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="blog-entry-media-link<?php wpex_entry_image_animation_classes(); ?>">
            <?php echo $thumbnail; ?>
        </a><!-- .blog-entry-media-link -->
    <?php endif; ?>

</div><!-- .blog-entry-media -->
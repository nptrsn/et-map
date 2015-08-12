<?php
/**
 * Blog entry link format media
 *
 * @package     Total
 * @subpackage  Framework/Partials/Blog/Media
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
    <a href="<?php wpex_permalink(); ?>" title="<?php wpex_esc_title(); ?>" rel="bookmark" class="blog-entry-media-link<?php wpex_entry_image_animation_classes(); ?>">
    	<?php echo $thumbnail; ?>
    </a><!-- .blog-entry-media-link -->
</div><!-- .blog-entry-media -->
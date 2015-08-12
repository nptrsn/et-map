<?php
/**
 * Portfolio single media template part
 *
 * @package     Total
 * @subpackage  Partials/Portfolio
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

// If single portfolio media is disabled return
if ( ! get_theme_mod( 'portfolio_single_media' ) ) {
    return;
}

// Get video and thumbnails
$video      = wpex_get_portfolio_post_video();
$thumbnail  = ( ! $video ) ? wpex_get_portfolio_post_thumbnail() : ''; // Only get thumbnail when video is not defined

// Return if there isn't an thumbnail or video
if ( ! $thumbnail && ! $video ) {
    return;
} ?>

<div id="portfolio-single-media" class="clr">

    <?php
    // Display Post Video if defined
    if ( $video ) : ?>
    
        <?php echo $video; ?>
    
    <?php
    // Otherwise display post thumbnail
    elseif ( $thumbnail ) : ?>

        <a href="<?php wpex_lightbox_image(); ?>" title="<?php wpex_esc_title(); ?>" class="wpex-lightbox">
            <?php echo $thumbnail; ?>
        </a>

    <?php endif; ?>

</div><!-- .portfolio-entry-media -->
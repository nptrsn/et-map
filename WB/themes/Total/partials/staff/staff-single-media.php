<?php
/**
 * Staff single media template part
 *
 * @package     Total
 * @subpackage  Partials/Staff
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
if ( ! get_theme_mod( 'staff_single_media' ) ) {
    return;
}

// Get thumbnail
$thumbnail = wpex_get_staff_post_thumbnail();

// Return if there isn't any thumbnail
if ( ! $thumbnail ) {
    return;
} ?>

<div id="staff-single-media" class="clr">
    <a href="<?php wpex_lightbox_image(); ?>" title="<?php wpex_esc_title(); ?>" class="wpex-lightbox">
        <?php echo $thumbnail; ?>
    </a>
</div><!-- .staff-entry-media -->
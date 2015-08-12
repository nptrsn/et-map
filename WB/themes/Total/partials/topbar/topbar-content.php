<?php
/**
 * Topbar content
 *
 * @package     Total
 * @subpackage  Partials/Topbar
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

// Get topbar content
$content = wpex_top_bar_content();

// Display topbar content
if ( $content || has_nav_menu( 'topbar_menu' ) ) : ?>

    <div id="top-bar-content" class="<?php echo wpex_top_bar_classes(); ?>">

        <?php
        // Get topbar menu
        get_template_part( 'partials/topbar/topbar', 'menu' ); ?>

        <?php
        // Check if there is content for the topbar
        if ( $content ) : ?>

            <?php
            // Display top bar content
            echo do_shortcode( $content ); ?>

        <?php endif; ?>

    </div><!-- #top-bar-content -->

<?php endif; ?>
<?php
/**
 * Header menu template part.
 *
 * @package     Total
 * @subpackage  Partials/Header
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.6.0
 * @version     1.0.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Menu Location
$menu_location = apply_filters( 'wpex_main_menu_location', 'main_menu' );

// Get classes for the header menu
$wrap_classes   = wpex_header_menu_classes( 'wrapper' );
$inner_classes  = wpex_header_menu_classes( 'inner' );

// Menu arguments
$menu_args = array(
    'theme_location'    => $menu_location,
    'menu_class'        => 'dropdown-menu sf-menu',
    'fallback_cb'       => false,
    'link_before'       => '<span class="link-inner">',
    'link_after'        => '</span>',
    'walker'            => new WPEX_Dropdown_Walker_Nav_Menu(),
);

// Check for custom menu
if ( $menu = wpex_custom_menu() ) {
    $menu_args['menu']  = $menu;
} ?>

<?php
// Menu before hook
wpex_hook_main_menu_before(); ?>

<div id="site-navigation-wrap" class="<?php echo $wrap_classes; ?>">

    <nav id="site-navigation" class="<?php echo $inner_classes; ?>" role="navigation">

        <?php
        // Menu top hook
        wpex_hook_main_menu_top(); ?>

        <?php
        // Output menu
        wp_nav_menu( $menu_args ); ?>

        <?php
        // Menu bottom hook
        wpex_hook_main_menu_bottom(); ?>

    </nav><!-- #site-navigation -->

</div><!-- #site-navigation-wrap -->

<?php
// Menu after hook
wpex_hook_main_menu_after(); ?>
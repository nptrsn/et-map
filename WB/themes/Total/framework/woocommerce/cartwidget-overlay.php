<?php
/**
 * Add overlay cart code to the wp_footer
 *
 * @package     Total
 * @subpackage  Framework/WooCommerce
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.0.0
 * @version     2.0.0
 */

function wpex_cart_widget_overlay() {
    
    // Check if we should load the template part
    if ( ! get_theme_mod( 'woo_menu_icon', true ) || 'overlay' != get_theme_mod( 'woo_menu_icon_style', 'drop-down' ) || is_cart() || is_checkout() ) {
         return;
    }

    // Get overlay template part
    get_template_part( 'partials/cart/cart', 'overlay' );
    
}
add_action( 'wp_footer', 'wpex_cart_widget_overlay' );
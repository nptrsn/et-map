<?php
/**
 * Loads the required files to extend the Visual Composer plugin
 *
 * @package     Total
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.4.0
 * @version     2.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Return if class not found
if ( ! class_exists( 'WPBakeryShortCode' ) ) {
    return;
}

/**
 * All custom shortcodes for use with the Visual Composer Extension
 *
 * @since Total 1.4.0
 */
$vcex_modules = array(
    'spacing'               => WPEX_VCEX_DIR . 'shortcodes/spacing.php',
    'divider'               => WPEX_VCEX_DIR . 'shortcodes/divider.php',
    'icon_box'              => WPEX_VCEX_DIR . 'shortcodes/icon_box.php',
    'teaser'                => WPEX_VCEX_DIR . 'shortcodes/teaser.php',
    'feature'               => WPEX_VCEX_DIR . 'shortcodes/feature.php',
    'callout'               => WPEX_VCEX_DIR . 'shortcodes/callout.php',
    'list_item'             => WPEX_VCEX_DIR . 'shortcodes/list_item.php',
    'bullets'               => WPEX_VCEX_DIR . 'shortcodes/bullets.php',
    'button'                => WPEX_VCEX_DIR . 'shortcodes/button.php',
    'pricing'               => WPEX_VCEX_DIR . 'shortcodes/pricing.php',
    'skillbar'              => WPEX_VCEX_DIR . 'shortcodes/skillbar.php',
    'icon'                  => WPEX_VCEX_DIR . 'shortcodes/icon.php',
    'milestone'             => WPEX_VCEX_DIR . 'shortcodes/milestone.php',
    'social_links'          => WPEX_VCEX_DIR . 'shortcodes/social_links.php',
    'image_swap'            => WPEX_VCEX_DIR . 'shortcodes/image_swap.php',
    'image_galleryslider'   => WPEX_VCEX_DIR . 'shortcodes/image_galleryslider.php',
    'image_flexslider'      => WPEX_VCEX_DIR . 'shortcodes/image_flexslider.php',
    'image_carousel'        => WPEX_VCEX_DIR . 'shortcodes/image_carousel.php',
    'image_grid'            => WPEX_VCEX_DIR . 'shortcodes/image_grid.php',
    'recent_news'           => WPEX_VCEX_DIR . 'shortcodes/recent_news.php',
    'blog_grid'             => WPEX_VCEX_DIR . 'shortcodes/blog_grid.php',
    'blog_carousel'         => WPEX_VCEX_DIR . 'shortcodes/blog_carousel.php',
    'post_type_grid'        => WPEX_VCEX_DIR . 'shortcodes/post_type_grid.php',
    'post_type_slider'      => WPEX_VCEX_DIR . 'shortcodes/post_type_slider.php',
    'navbar'                => WPEX_VCEX_DIR . 'shortcodes/navbar.php',
    'testimonials_grid'     => WPEX_VCEX_DIR . 'shortcodes/testimonials_grid.php',
    'testimonials_slider'   => WPEX_VCEX_DIR . 'shortcodes/testimonials_slider.php',
    'portfolio_grid'        => WPEX_VCEX_DIR . 'shortcodes/portfolio_grid.php',
    'portfolio_carousel'    => WPEX_VCEX_DIR . 'shortcodes/portfolio_carousel.php',
    'staff_grid'            => WPEX_VCEX_DIR . 'shortcodes/staff_grid.php',
    'staff_carousel'        => WPEX_VCEX_DIR . 'shortcodes/staff_carousel.php',
    'staff_social'          => WPEX_VCEX_DIR . 'shortcodes/staff_social.php',
    'login_form'            => WPEX_VCEX_DIR . 'shortcodes/login_form.php',
    'newsletter_form'       => WPEX_VCEX_DIR . 'shortcodes/newsletter_form.php',
    'layerslider'           => WPEX_VCEX_DIR . 'shortcodes/layerslider.php',
    'woocommerce_carousel'  => WPEX_VCEX_DIR . 'shortcodes/woocommerce_carousel.php',
);

// Apply filters so I can add new modules for specific post-types and add-ons
$vcex_modules = apply_filters( 'vcex_builder_modules', $vcex_modules );

// Load custom modules
if ( ! empty( $vcex_modules ) ) {
    foreach ( $vcex_modules as $key => $val ) {
        if ( file_exists( $val ) ) {
            require_once( $val );
        }
    }
}
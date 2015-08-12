<?php
/**
 * Adds classes to the body tag for various page/post layout styles
 *
 * @package     Total
 * @subpackage  Framework
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.0.0
 * @version     2.0.0
 */

function wpex_body_classes( $classes ) {

    // Get global object
    global $wpex_theme;
    
    // WPExplorer class
    $classes[] = 'wpex-theme';

    // Responsive
    if ( $wpex_theme->responsive ) {
        $classes[] = 'wpex-responsive';
    }

    // Layout Style
    $classes[] = $wpex_theme->main_layout .'-main-layout';
    
    // Add skin to body classes
    $classes[] = 'theme-'. $wpex_theme->skin;

    // Check if the Visual Composer is being used on this page
    if ( $wpex_theme->has_composer ) {
        $classes[] = 'has-composer';
    } else {
        $classes[] = 'no-composer';
    }

    // Boxed Layout dropshadow
    if( 'boxed' == $wpex_theme->main_layout && get_theme_mod( 'boxed_dropdshadow' ) && 'gaps' != $wpex_theme->skin ) {
        $classes[] = 'wrap-boxshadow';
    }

    // Content layout
    if ( $wpex_theme->post_layout ) {
        $classes[] = 'content-'. $wpex_theme->post_layout;
    }

    // Single Post cagegories
    if ( is_singular( 'post' ) ) {
        $cats = get_the_category( $wpex_theme->post_id );
        foreach ( $cats as $cat ) {
            $classes[] = 'post-in-category-'. $cat->category_nicename;
        }
    }

    // Breadcrumbs
    if ( $wpex_theme->has_breadcrumbs && 'default' == get_theme_mod( 'breadcrumbs_position', 'default' ) ) {
        $classes[] = 'has-breadcrumbs';
    }

    // Shrink fixed header
    if ( $wpex_theme->has_fixed_header && 'one' == $wpex_theme->header_style && $wpex_theme->shrink_fixed_header ) {
        $classes[] = 'shrink-fixed-header';
    }

    // Topbar
    if ( $wpex_theme->has_top_bar ) {
        $classes[] = 'has-topbar';
    }

    // Widget Icons
    if ( get_theme_mod( 'widget_icons', true ) ) {
        $classes[] = 'sidebar-widget-icons';
    }

    // Mobile
    if ( $wpex_theme->is_mobile ) {
        $classes[] = 'is-mobile';
    }

    // Overlay header style
    if ( $wpex_theme->has_overlay_header ) {
        $classes[] = 'has-overlay-header';
    }

    // Footer reveal
    if ( $wpex_theme->has_footer_reveal ) {
        $classes[] = 'footer-has-reveal';
    }

    // Slider
    if ( $wpex_theme->has_post_slider ) {
        $classes[] = 'page-with-slider';
    }

    // No header margin
    if ( 'on' == get_post_meta( $wpex_theme->post_id, 'wpex_disable_header_margin', true ) ) {
        $classes[] = 'no-header-margin';
    }

    // Title with Background Image
    if ( 'background-image' == $wpex_theme->page_header_style ) {
        $classes[] = 'page-with-background-title';
    }

    // Disabled header
    if ( ! $wpex_theme->has_page_header ) {
        $classes[] = 'page-header-disabled';
    }

    // Page slider
    if ( $wpex_theme->has_post_slider && $slider_position = wpex_post_slider_position( $wpex_theme->post_id ) ) {
        $classes[] = 'has-post-slider';
        $slider_position = str_replace( '_', '-', $slider_position );
        $classes[] = 'post-slider-'. $slider_position;
    }

    // Font smoothing
    if ( get_theme_mod( 'enable_font_smoothing' ) ) {
        $classes[] = 'smooth-fonts';
    }
    
    // Return classes
    return $classes;

}
add_filter( 'body_class', 'wpex_body_classes' );
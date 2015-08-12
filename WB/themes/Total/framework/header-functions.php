<?php
/**
 * Site Header Helper Functions
 *
 * @package     Total
 * @subpackage  Framework/Header
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.5.3
 * @version     2.0.0
 */

/**
 * Whether the header should display or not.
 * Used by the global $wpex_theme object.
 *
 * @since   Total 1.5.3
 * @return  bool
 */
function wpex_has_header( $post_id = '' ) {

    // Return true by default
    $return = true;

    // Check if disabled via meta option
    if ( 'on' == get_post_meta( $post_id, 'wpex_disable_header', true ) ) {
        $return = false;
    }

    // Apply filter for child theming
    $return = apply_filters( 'wpex_display_header', $return );

    // Return
    return $return;

}

/**
 * Check if the fixed header is enabled
 *
 * @since   Total 2.0.0
 * @return  bool
 */
function wpex_has_fixed_header() {

    // Disable on front-end builder
    if ( wpex_is_front_end_composer() ) {
        $return = false;
    } elseif ( get_theme_mod( 'fixed_header', true ) ) {
        $return = true;
    } else {
        $return = false;
    }

    // Apply filters
    $return = apply_filters( 'wpex_has_fixed_header', $return );

    // Return
    return $return;

}

/**
 * Get correct header style
 *
 * @since   Total 1.5.3
 * @return  bool
 */
function wpex_get_header_style( $post_id = '' ) {

    // Check URL
    if ( ! empty( $_GET['header_style'] ) ) {
        return $_GET['header_style'];
    }

    // Get Global object
    global $wpex_theme;

    // Get header style from customizer setting
    $style = get_theme_mod( 'header_style', 'one' );

    // Check for custom header style defined in meta options
    if ( $meta = get_post_meta( $post_id, 'wpex_header_style', true ) ) {
        $style = $meta;
    }

    // Return header style one if Header Overlay enabled
    if ( $wpex_theme->has_overlay_header ) {
        $style = 'one';
    }

    // Sanitize style to make sure it isn't empty
    if ( empty( $style ) ) {
        $style = 'one';
    }

    // Apply filters for child theming
    $style = apply_filters( 'wpex_header_style', $style );

    // Return style
    return $style;

}

/**
 * Check if the header overlay style is enabled
 *
 * @since   Total 1.5.3
 * @return  bool
 */
function wpex_has_header_overlay( $post_id = '' ) {

    // Return false by default
    $return = false;

    // Return true if enabled via the post meta
    if ( $post_id && 'on' == get_post_meta( $post_id, 'wpex_overlay_header', true ) ) {
        $return = true;
    }

    // Apply filters for child theming
    $return = apply_filters( 'wpex_has_header_overlay', $return );

    // Return false if not enabled
    return $return;

}

/**
 * Returns page header overlay logo
 *
 * @since   Total 2.0.0
 * @return  string
 */
function wpex_header_overlay_logo() {

    // Get global object
    global $wpex_theme;

    // No custom overlay logo by default
    $logo = false;

    // Get logo via custom field
    $logo = get_post_meta( $wpex_theme->post_id, 'wpex_overlay_header_logo', true );

    // Check old method
    if ( is_array( $logo ) ) {
        if ( ! empty( $logo['url'] ) ) {
            $logo = $logo['url'];
        } else {
            $logo = false;
        }
    }

    // Apply filters for child theming
    $logo = apply_filters( 'wpex_header_overlay_logo', $logo );

    // Sanitize URL
    $logo = esc_url( $logo );

    // Return logo
    return $logo;

}

/**
 * Add classes to the header wrap
 *
 * @since   Total 1.5.3
 * @return  string
 */
function wpex_header_classes() {

    // Get global object
    global $wpex_theme;

    // Setup classes array
    $classes = array();

    // Clearfix class
    $classes['clr'] = 'clr';

    // Main header style
    $classes['header_style'] = 'header-'. $wpex_theme->header_style;

    // Sticky Header
    if ( $wpex_theme->has_fixed_header && 'one' == $wpex_theme->header_style ) {
        $classes['fixed_scroll'] = 'fixed-scroll';
    }

    // Header Overlay Style
    if ( $wpex_theme->has_overlay_header ) {

        // Remove fixed scroll class
        unset( $classes['fixed_scroll'] );

        // Add overlay header class
        $classes['overlay_header'] = 'overlay-header';

        // Add a fixed class for the overlay-header style only
        if ( $wpex_theme->has_fixed_header ) {
            $classes['fix_on_scroll'] = 'fix-overlay-header';
        }

        // Add overlay header class
        $classes['overlay_header'] = 'overlay-header';

        // Add overlay header style class
        $overlay_style                      = $wpex_theme->header_overlay_style;
        $overlay_style                      = $overlay_style ? $overlay_style : 'light';
        $classes['overlay_header_style']    = $overlay_style .'-style';

    }

    // Set keys equal to vals
    $classes = array_combine( $classes, $classes );
    
    // Apply filters for child theming
    $classes = apply_filters( 'wpex_header_classes', $classes );

    // Turn classes into space seperated string
    $classes = implode( ' ', $classes );

    // return classes
    return $classes;

}

/**
 * Returns header logo img url
 *
 * @since Total 1.5.3
 */
function wpex_header_logo_img() {

    // Get logo img from admin panel
    $logo = get_theme_mod( 'custom_logo' );

    // WPML translation
    $logo = wpex_translate_theme_mod( 'custom_logo', $logo );

    // Apply filter for child theming
    $logo = apply_filters( 'wpex_header_logo_img_url', $logo );

    // Sanitize URL
    $logo = esc_url( $logo );

    // Return logo
    return $logo;

}

/**
 * Returns header logo icon
 *
 * @since Total 2.0.0
 */
function wpex_header_logo_icon() {

    // Get logo img from admin panel
    $icon = get_theme_mod( 'logo_icon' );

    // Apply filter for child theming
    $icon = apply_filters( 'wpex_header_logo_icon', $icon );

    // Return icon
    if ( $icon && 'none' != $icon ) {
        return '<span class="fa fa-'. $icon .'"></span>';
    } else {
        return NULL;
    }

}

/**
 * Returns header logo title
 *
 * @since Total 2.0.0
 */
function wpex_header_logo_title() {
    $title  = get_bloginfo( 'name' );
    $title  = apply_filters( 'wpex_logo_title', $title );
    return $title;
}

/**
 * Returns header logo URL
 *
 * @since Total 2.0.0
 */
function wpex_header_logo_url() {
    $url    = esc_url( home_url( '/' ) );
    $url    = apply_filters( 'wpex_logo_url', $url );
    return $url;
}

/**
 * Header logo classes
 *
 * @since Total 2.0.0
 */
function wpex_header_logo_classes() {

    // Define classes array
    $classes = array( 'site-branding' );

    // Get global object
    global $wpex_theme;

    // Default class
    $classes[] = 'header-'. $wpex_theme->header_style .'-logo';

    // Get custom overlay logo
    if ( $wpex_theme->has_overlay_header && wpex_header_overlay_logo() ) {
        $classes[] = 'has-overlay-logo';
    }

    // Apply filters for child theming
    $classes = apply_filters( 'wpex_header_logo_classes', $classes );

    // Turn classes into space seperated string
    $classes = implode( ' ', $classes );

    // Return classes
    return $classes;

}


/**
 * Adds js for the retina logo
 *
 * @since Total 1.1.0
 */
function wpex_retina_logo() {

    // Get theme options
    $logo_url       = get_theme_mod( 'retina_logo' );
    $logo_height    = get_theme_mod( 'retina_logo_height' );

    // WPML translation
    $logo_url       = wpex_translate_theme_mod( 'retina_logo', $logo_url );
    $logo_height    = wpex_translate_theme_mod( 'retina_logo_height', $logo_height );

    // Output JS for retina logo
    if ( $logo_url && $logo_height ) {
        $output = '<!-- Retina Logo --><script type="text/javascript">jQuery(function($){if (window.devicePixelRatio == 2) {$("#site-logo img").attr("src", "'. $logo_url .'");$("#site-logo img").css("max-height", "'. intval( $logo_height ) .'");}});</script>';
        echo $output;
    }
}
add_action( 'wp_head', 'wpex_retina_logo' );

/**
 * Returns fixed header logo
 *
 * @since Total 1.7.0
 */
function wpex_fixed_header_logo( $post_id ) {

    // Get custom logo from Customizer
    $logo = get_theme_mod( 'fixed_header_logo' );

    // Apply filters for child theming
    apply_filters( 'wpex_fixed_header_logo', $logo );

    // Return logo
    return $logo;
    
}
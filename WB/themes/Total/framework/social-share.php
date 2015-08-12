<?php
/**
 * Social sharing functions
 *
 * @package     Total
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.0.0
 * @version     1.1.0
 */

/**
 * Returns social sharing template part
 *
 * @since   Total 2.0.0
 * @return  array
 */
function wpex_social_share_sites() {
    $defs   = array( 'twitter', 'facebook', 'google_plus', 'pinterest', 'linkedin' );
    $sites  = get_theme_mod( 'social_share_sites', $defs );
    if ( $sites && ! is_array( $sites ) ) {
        $sites  = explode( ',', $sites );
    }
    return $sites;
}

/**
 * Checks if current page has social share
 *
 * @since Total 2.0.0
 */
function wpex_has_social_share( $post_id = '' ) {

    // Return false by default
    $return = false;

    // Check page settings first to overrides theme mods and filters
    if ( $meta = get_post_meta( $post_id, 'wpex_disable_social', true ) ) {

        // Check if disabled by meta options
        if ( 'on' == $meta ) {
            return false;
        }

        // Return true if enabled via meta option
        if ( 'enable' == $meta ) {
            return true;
        }

    }

    // Page check
    if ( is_page() && get_theme_mod( 'social_share_pages' ) ) {
        $return = true;
    }

    // Check if enabled on single blog posts
    if ( is_singular( 'post' ) && get_theme_mod( 'blog_social_share', true ) ) {
        $return = true;
    }

    // Check if enabled for blog entries
    if ( ! is_singular() && 'post' == get_post_type( $post_id ) && get_theme_mod( 'social_share_blog_entries' ) ) {
        $return = true;
    }

    // Apply filters
    $return = apply_filters( 'wpex_has_social_share', $return );

    // Return
    return $return;

}

/**
 * Returns correct social share position
 *
 * @since Total 2.0.0
 */
function wpex_social_share_position() {

    // Get option from Customizer
    $position = get_theme_mod( 'social_share_position' );

    // Sanitize
    $position = $position ? $position : 'horizontal';

    // Apply filters
    $position = apply_filters( 'wpex_social_share_position', $position );

    // Return positon
    return $position;

}

/**
 * Returns correct social share style
 *
 * @since Total 2.0.0
 */
function wpex_social_share_style() {

    // Get option from Customizer
    $style = get_theme_mod( 'social_share_style' );

    // Sanitize
    $style = $style ? $style : 'minimal';

    // Apply filters
    $style = apply_filters( 'wpex_social_share_position', $style );

    // Return style
    return $style;

}

/**
 * Returns the social share heading
 *
 * @since Total 2.0.0
 */
function wpex_social_share_heading() {

    // Get heading from customizer setting
    $heading = get_theme_mod( 'social_share_heading' );

    // Sanitize to make sure heading isn't empty
    $heading = $heading ? $heading : __( 'Please Share This', 'wpex' );

    // Translate heading for WPML and Polylang
    $heading = wpex_translate_theme_mod( 'social_share_heading', $heading );

    // Apply filters for child theming
    $heading = apply_filters( 'wpex_social_share_heading', $heading );

    // Return heading
    return $heading;
}
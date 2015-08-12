<?php
/**
 * These functions are used to load template parts (partials) when used within action hooks,
 * and they probably should never be updated or modified.
 *
 * @package     Total
 * @subpackage  Framework
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 2.0.0
 * @version     2.0.0
 */


/*-------------------------------------------------------------------------------*/
/* -  Toggle Bar
/*-------------------------------------------------------------------------------*/

/**
 * Get togglebar layout template part if enabled.
 *
 * @since Total 1.0.0
 */
function wpex_toggle_bar() {

    // Get global object
    global $wpex_theme;

    // Get togglebar content if enabled
    if ( $wpex_theme->has_togglebar ) {
        get_template_part( 'partials/togglebar/togglebar', 'layout' );
    }

}

/**
 * Get togglebar button template part.
 *
 * @since Total 1.0.0
 */
function wpex_toggle_bar_button() {
    
    // Get global object
    global $wpex_theme;

    // Get toggle bar button template bar
    if ( $wpex_theme->has_togglebar ) {
        get_template_part( 'partials/togglebar/togglebar-button' );
    }

}


/*-------------------------------------------------------------------------------*/
/* -  Top Bar
/*-------------------------------------------------------------------------------*/

/**
 * Get Top Bar layout template part if enabled.
 *
 * @since Total 1.0.0
 */
function wpex_top_bar() {

    // Get blobal object
    global $wpex_theme;

    // Get tobar layout if enabled
    if ( $wpex_theme->has_top_bar ) {
        get_template_part( 'partials/topbar/topbar', 'layout' );
    }
        
}


/*-------------------------------------------------------------------------------*/
/* -  Header
/*-------------------------------------------------------------------------------*/

/**
 * Get the header template part if enabled.
 *
 * @since   Total 1.5.3
 */
function wpex_header() {
    
    // Get global object
    global $wpex_theme;

    // Get header template file if enabled
    if ( $wpex_theme->has_site_header ) {
        get_template_part( 'partials/header/header', 'layout' );
    }

}

/**
 * Get the header logo template part.
 *
 * @since Total 1.0.0
 */
function wpex_header_logo() {
    get_template_part( 'partials/header/header-logo' );
}

/**
 * Get the header aside content template part.
 *
 * @since Total 1.5.3
 */
function wpex_header_aside() {
    get_template_part( 'partials/header/header-aside' );
}

/**
 * Get header search dropdown template part.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wpex_search_dropdown' ) ) {
    function wpex_search_dropdown() {

        // Get global object & header style
        global $wpex_theme;
        $header_style = $wpex_theme->header_style;

        // Make sure site is set to dropdown style
        if ( 'drop_down' != $wpex_theme->header_search_style ) {
            return;
        }

        // Get current filter
        $filter = current_filter();

        // Set get variable to false by default
        $get = false;

        // Check current filter against header style
        if ( 'one' == $header_style && 'wpex_hook_header_inner' == $filter ) {
            $get = true;
        } elseif ( in_array( $header_style, array( 'two', 'three', 'four' ) ) && 'wpex_hook_main_menu_bottom' == $filter ) {
            $get = true;
        }

        // Get search dropdown template part
        if ( $get ) {
            get_template_part( 'partials/search/header-search', 'dropdown' );
        }

    }
}

/**
 * Get header search replace template part.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wpex_search_header_replace' ) ) {
    function wpex_search_header_replace() {

        // Get global object
        global $wpex_theme;

        // Get template part
        if ( 'header_replace' == $wpex_theme->header_search_style ) {
            get_template_part( 'partials/search/header-search', 'replace' );
        }

    }
}

/**
 * Gets header search overlay template part.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wpex_search_overlay' ) ) {
    function wpex_search_overlay() {

        // Get global object
        global $wpex_theme;

        // Get template part
        if ( 'overlay' == $wpex_theme->header_search_style ) {
            get_template_part( 'partials/search/header-search', 'overlay' );
        }

    }
}


/*-------------------------------------------------------------------------------*/
/* -  Menu
/*-------------------------------------------------------------------------------*/

/**
 * Outputs the main header menu
 *
 * @since Total 1.0.0
 */
function wpex_header_menu() {

    // Get global object and header style
    global $wpex_theme;
    $header_style = $wpex_theme->header_style;

    // Get current filter
    $filter = current_filter();

    // Set bool variable
    $get = false;

    // Check current filter against header style
    if ( 'one' == $header_style && 'wpex_hook_header_inner' == $filter ) {
        $get = true;
    } elseif ( 'four' == $header_style && 'wpex_hook_header_top' == $filter ) {
        $get = true;
    } elseif ( in_array( $header_style, array( 'two', 'three' ) ) && 'wpex_hook_header_bottom' == $filter ) {
        $get = true;
    }

    // Get menu template part
    if ( $get ) {
        get_template_part( 'partials/header/header-menu' );
    }

}

/**
 * Gets the template part for the "icons" style mobile menu.
 *
 * @since Total 1.0.0
 */
function wpex_mobile_menu_icons() {
    
    // Return if responsiveness is disabled
    if ( ! wpex_is_responsive() ) {
        return;
    }
    
    get_template_part( 'partials/header/header-menu-mobile-icons' );

}

/**
 * Get mobile menu alternative if enabled.
 *
 * @since Total 1.3.0
 */
function wpex_mobile_menu_alt() {

    // Get global object
    global $wpex_theme;

    // Return if responsive is disabled or the mobile alternative is disabled
    if ( ! $wpex_theme->responsive || ! has_nav_menu( 'mobile_menu_alt' ) ) {
        return;
    }

    get_template_part( 'partials/header/header-menu-mobile-alt' );
    
}


/*-------------------------------------------------------------------------------*/
/* -  Page Header
/*-------------------------------------------------------------------------------*/

/**
 * Get page header template part if enabled.
 *
 * @since Total 1.5.2
 */
function wpex_page_header() {
    global $wpex_theme;
    if ( $wpex_theme->has_page_header ) {
        get_template_part( 'partials/page-header' );
    }
}

/**
 * Get page header title template part if enabled.
 *
 * @since Total 1.0.0
 */
function wpex_page_header_title() {
    global $wpex_theme;
    if ( $wpex_theme->has_page_header_title ) {
        get_template_part( 'partials/page-header-title' );
    }
}

/**
 * Get post heading template part.
 *
 * @since Total 1.0.0
 */
function wpex_page_header_subheading() {
    get_template_part( 'partials/page-header-subheading' );
}


/*-------------------------------------------------------------------------------*/
/* -  Content
/*-------------------------------------------------------------------------------*/

/**
 * Get term description.
 *
 * @since Total 1.0.0
 */
function wpex_term_description() {
    get_template_part( 'partials/term-description' );
}

/**
 * Get next/previous links.
 *
 * @since Total 1.0.0
 */
function wpex_next_prev() {
    get_template_part( 'partials/next-prev' );
}

/**
 * Get next/previous links.
 *
 * @since Total 1.0.0
 */
function wpex_post_edit() {
    get_template_part( 'partials/post-edit' );
}

/*-------------------------------------------------------------------------------*/
/* -  Blog
/*-------------------------------------------------------------------------------*/

/**
 * Blog single media above content
 *
 * @since Total 1.0.0
 */
function wpex_blog_single_media_above() {

    // Only needed for blog posts
    if ( ! is_singular( 'post' ) ) {
        return;
    }

    // Media position
    $blog_single_media_position = get_post_meta( get_the_ID(), 'wpex_post_media_position', true );
    $blog_single_media_position = apply_filters( 'wpex_blog_single_media_position', $blog_single_media_position );

    // Display the post media above the post (this is a meta option)
    if ( 'above' == $blog_single_media_position && ! post_password_required() ) {

        // Get post format.
        $post_format = get_post_format() ? get_post_format() : 'thumbnail';

        // Get correct media template part
        get_template_part( 'partials/blog/media/blog-single', $post_format );

    }

}


/*-------------------------------------------------------------------------------*/
/* -  Footer
/*-------------------------------------------------------------------------------*/

/**
 * Gets the footer callout template part.
 *
 * @since Total 1.0.0
 */
function wpex_footer_callout() {
    get_template_part( 'partials/footer/footer-callout' );   
}

/**
 * Gets the footer layout template part.
 *
 * @since Total 2.0.0
 */
function wpex_footer() {
    get_template_part( 'partials/footer/footer-layout' );
}

/**
 * Get the footer widgets template part.
 *
 * @since Total 1.0.0
 */
function wpex_footer_widgets() {
    get_template_part( 'partials/footer/footer-widgets' );
}

/**
 * Gets the footer bottom template part.
 *
 * @since Total 1.0.0
 */
function wpex_footer_bottom() {
    if ( get_theme_mod( 'footer_bottom', true ) ) {
        get_template_part( 'partials/footer/footer-bottom' );
    }
}

/**
 * Gets the scroll to top button template part.
 *
 * @since Total 1.0.0
 */
if ( ! function_exists( 'wpex_scroll_top' ) ) {
    function wpex_scroll_top() {
        get_template_part( 'partials/scroll-top' );
    }
}

/**
 * Footer reaveal open code
 *
 * @since Total 2.0.0
 */
function wpex_footer_reveal_open() {
    get_template_part( 'partials/footer-reveal-open' );
}

/**
 * Footer reaveal close code
 *
 * @since Total 2.0.0
 */
function wpex_footer_reveal_close() {
    get_template_part( 'partials/footer-reveal-close' );
}


/*-------------------------------------------------------------------------------*/
/* -  Other
/*-------------------------------------------------------------------------------*/

/**
 * Returns social sharing template part
 *
 * @since Total 2.0.0
 */
function wpex_social_share() {
    get_template_part( 'partials/social-share' );
}
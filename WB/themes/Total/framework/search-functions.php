<?php
/**
 * Core search functions
 *
 * @package     Total
 * @subpackage  Framework/Search
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.0.0
 * @version     1.0.0
 */

/**
 * Check if search icon should be in the nav
 *
 * @since   Total 1.0.0
 * @return  bool
 */
if ( ! function_exists( 'wpex_search_in_menu' ) ) {
    function wpex_search_in_menu() {

        // Get global object
        global $wpex_theme;

        // Return false by default
        $return = false;

        // Always return true for the header style 2, we can hide via CSS
        if ( 'two' == $wpex_theme->header_style ) {
            $return = true;
        }

        // Return true if enabled via the Customizer
        elseif ( get_theme_mod( 'main_search', true ) ) {
            $return = true;
        }

        // Apply filters
        $return = apply_filters( 'wpex_search_in_menu', $return );

        // Return
        return $return;

    }
}

/**
 * Get Correct header search style
 *
 * @since Total 1.0.0
 */
if ( ! function_exists( 'wpex_header_search_style' ) ) {
    function wpex_header_search_style() {

        // Return if search disabled form the menu
        if ( ! wpex_search_in_menu() ) {
            return;
        }

        // Get search style from Customizer
        $style = get_theme_mod( 'main_search_toggle_style', 'drop_down' );

        // Apply filters for advanced edits
        $style = apply_filters( 'wpex_header_search_style', $style );

        // Sanitize output so it's not empty
        $style = $style ? $style : 'drop_down';

        // Return style
        return $style;

    }
}

/**
 * Adds the search icon to the menu items
 *
 * @since   Total 1.0.0
 * @return  bool
 */
if ( ! function_exists( 'wpex_add_search_to_menu' ) ) {
    function wpex_add_search_to_menu ( $items, $args ) {

        // Only used on main menu
        if ( 'main_menu' != $args->theme_location ) {
            return $items;
        }

        // Get global object
        global $wpex_theme;

        // Return if disabled
        if ( ! $wpex_theme->header_search_style ) {
            return $items;
        }
        
        // Get correct search icon class
        if ( 'overlay' == $wpex_theme->header_search_style ) {
            $class = ' search-overlay-toggle';
        } elseif ( 'drop_down' == $wpex_theme->header_search_style ) {
            $class = ' search-dropdown-toggle';
        } elseif ( 'header_replace' == $wpex_theme->header_search_style ) {
            $class = ' search-header-replace-toggle';
        }

        // Add search item to menu
        $items .= '<li class="search-toggle-li">';
            $items .= '<a href="#" class="site-search-toggle'. $class .'">';
                $items .= '<span class="link-inner">';
                    $items .= '<span class="fa fa-search"></span>';
                $items .= '</span>';
            $items .= '</a>';
        $items .= '</li>';
        
        // Return nav $items
        return $items;

    }
}
add_filter( 'wp_nav_menu_items', 'wpex_add_search_to_menu', 11, 2 );

/**
 * Adds a hidden searchbox in the footer for use with the mobile menu
 *
 * @since Total 1.5.1
 */
if ( ! function_exists( 'wpex_mobile_searchform' ) ) {
    function wpex_mobile_searchform() {

        // Make sure the mobile search is enabled for the sidr nav other wise return
        if ( function_exists( 'wpex_mobile_menu_source' ) ) {
            $sidr_elements = wpex_mobile_menu_source();
            if ( isset( $sidr_elements ) && is_array( $sidr_elements ) ) {
                if ( ! isset( $sidr_elements['search'] ) ) {
                    return;
                }
            }
        }

        // Output the search
        $placeholder = apply_filters( 'wpex_mobile_searchform_placeholder', __( 'Search', 'wpex' ) );

        // Add Classes
        $classes = 'clr hidden';
        if ( 'toggle' == get_theme_mod( 'mobile_menu_style' ) ) {
            $classes .= ' container';
        } ?>

        <div id="mobile-menu-search" class="<?php echo $classes; ?>">
            <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" class="mobile-menu-searchform">
                <input type="search" name="s" autocomplete="off" placeholder="<?php echo $placeholder; ?>" />
                <?php if ( WPEX_WPML_ACTIVE ) { ?>
                    <input type="hidden" name="lang" value="<?php echo( ICL_LANGUAGE_CODE ); ?>"/>
                <?php } ?>
            </form>
        </div>
        
    <?php }
}

/**
 * Search Dropdown
 *
 * @since 1.0.0
 */
function wpex_header_search_placeholder() {

    // Get global object
    global $wpex_theme;

    // Default
    $return = __( 'Search', 'wpex' );

    // Overlay
    if ( 'overlay' == $wpex_theme->header_search_style ) {
        $return = __( 'Search', 'wpex' );
    }

    // Header Overlay
    if ( 'header_replace' == $wpex_theme->header_search_style ) {
        $return = __( 'Type then hit enter to search...', 'wpex' );
    }

    // Apply filters
    $return = apply_filters( 'wpex_search_placeholder_text', $return );

    // Return
    return $return;

}
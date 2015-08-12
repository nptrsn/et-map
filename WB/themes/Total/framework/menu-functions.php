<?php
/**
 * Header Menu Functions
 *
 * @package     Total
 * @subpackage  Framework/Menu
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.0.0
 * @version     2.0.0
 */

/**
 * Returns correct menu classes
 *
 * @since Total 2.0.0
 */
function wpex_header_menu_classes( $return ) {

    // Define classes array
    $classes = array();

    // Get global object
    global $wpex_theme;

    // Get data
    $header_style   = $wpex_theme->header_style;
    $header_height  = absint( get_theme_mod( 'header_height' ) );
    $woo_icon       = get_theme_mod( 'woo_menu_icon', true );

    // Return wrapper classes
    if ( 'wrapper' == $return ) {

        // Add clearfix
        $classes[] = 'clr';

        // Add Header Style to wrapper
        $classes[] = 'navbar-style-'. $header_style;

        // Add the fixed-nav class if the fixed header option is enabled
        if ( 'one' != $header_style && get_theme_mod( 'fixed_header', true ) ){
            $classes[] = 'fixed-nav';
        }

        // Add fixed height class if it's header style one and a header height is defined in the admin
        if ( 'one' == $header_style && $header_height && '0' != $header_height && 'auto' != $header_height ) {
            $classes[] = 'nav-custom-height';
        }

        // Add special class if the dropdown top border option in the admin is enabled
        if ( get_theme_mod( 'menu_dropdown_top_border' ) ) {
            $classes[] = 'nav-dropdown-top-border';
        }

        // Set keys equal to vals
        $classes = array_combine( $classes, $classes );

        // Apply filters
        $classes = apply_filters( 'wpex_header_menu_wrap_classes', $classes );

    }

    // Inner Classes
    elseif ( 'inner' == $return ) {

        // Core
        $classes[] = 'navigation';
        $classes[] = 'main-navigation';
        $classes[] = 'clr';

        // Add the container div for specific header styles
        if ( in_array( $header_style, array( 'two', 'three', 'four' ) ) ) {
            $classes[] = 'container';
        }

        // Add classes if the search setting is enabled
        if ( wpex_search_in_menu() ) {
            $classes[] = 'has-search-icon';
            if ( WPEX_WOOCOMMERCE_ACTIVE && $woo_icon ) {
                $classes[] = 'has-cart-icon';
            }
        }

        // Set keys equal to vals
        $classes = array_combine( $classes, $classes );

        // Apply filters
        $classes = apply_filters( 'wpex_header_menu_classes', $classes );

    }

    // Return
    if ( is_array( $classes ) ) {
        return implode( ' ', $classes );
    } else {
        return $return;
    }

}

/**
 * Custom menu walker
 *
 * @since Total 1.3.0
 */
if ( ! class_exists( 'WPEX_Dropdown_Walker_Nav_Menu' ) ) {
    class WPEX_Dropdown_Walker_Nav_Menu extends Walker_Nav_Menu {
        function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

            // Get field ID
            $id_field = $this->db_fields['id'];

            // Down Arrows
            if ( ! empty( $children_elements[$element->$id_field] ) && ( $depth == 0 ) ) {
                $element->classes[] = 'dropdown';
                if ( get_theme_mod( 'menu_arrow_down', true ) ) {
                    $element->title .= ' <span class="nav-arrow fa fa-angle-down"></span>';
                }
            }

            // Right/Left Arrows
            if ( ! empty( $children_elements[$element->$id_field] ) && ( $depth > 0 ) ) {
                $element->classes[] = 'dropdown';
                if ( get_theme_mod( 'menu_arrow_side', true ) ) {
                    if ( is_rtl() ) {
                        $element->title .= '<span class="nav-arrow fa fa-angle-left"></span>';
                    } else {
                        $element->title .= '<span class="nav-arrow fa fa-angle-right"></span>';
                    }
                }
            }

            // Define walker
            Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

        }
    }
}

/**
 * Checks for custom menus.
 *
 * @since Total 1.3.0
 */
function wpex_custom_menu( $menu = '' ) {

    // Get global object
    global $wpex_theme;

    // Get post ID
    $post_id = $wpex_theme->post_id;

    // Check for custom menu
    if ( $post_id ) {
        $meta = get_post_meta( $post_id, 'wpex_custom_menu', true );
        if ( $meta && 'default' != $meta ) {
            $menu = $meta;
        }
    }

    // Return custom menu
    return apply_filters( 'wpex_custom_menu', $menu );

}
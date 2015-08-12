<?php
/**
 * All page header functions
 *
 * @package		Total
 * @subpackage	Functions
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.0.0
 * @version 	1.0.1
 */

/**
 * Checks if the page header (title) should display
 *
 * @since Total 1.5.2
 * @return bool
 */
function wpex_has_page_header() {

	// Return true by default
	$return = true;

	// Get global object
	global $wpex_theme;

	// Return if page header is disabled via custom field
	if ( $wpex_theme->post_id ) {

		// Check meta value
		$meta = get_post_meta( $wpex_theme->post_id, 'wpex_disable_title', true );

		// Return if page header is disabled and there isn't a page header background defined
		if ( 'on' == $meta && 'background-image' != $wpex_theme->page_header_style ) {
			$return	= false;
		}

	}

	// Display if page header style is set to Hidden
	if ( 'hidden' == $wpex_theme->page_header_style ) {
		$return = false;
	}

	// Apply filters
	$return	= apply_filters( 'wpex_display_page_header', $return );

	// Return bool
	return $return;
}

/**
 * Get current page header style
 * Needs to be added first because it's used in multiple functions
 *
 * @since Total 1.5.4
 */
function wpex_page_header_style( $post_id = '' ) {

	// Get default page header style defined in Customizer
	$style = get_theme_mod( 'page_header_style' );

	// Get for header style defined in page settings
	if ( $meta = get_post_meta( $post_id, 'wpex_post_title_style', true ) ) {
		$style = $meta;
	}

	// Sanitize data
	$style = ( 'default' == $style ) ? '' : $style;
	
	// Apply filters for child theming
	$style = apply_filters( 'wpex_page_header_style', $style );

	// Return page header style
	return $style;

}

/**
 * Adds correct classes to the page header
 *
 * @since	Total 2.0.0
 * @return	array
 */
function wpex_page_header_classes() {

	// Get global object
	global $wpex_theme;

	// Define main class
	$classes = array( 'page-header' );

	// Add classes for title style
	if ( $wpex_theme->page_header_style ) {
		$classes[] = $wpex_theme->page_header_style .'-page-header';
	}

	// Apply filters
	apply_filters( 'wpex_page_header_classes', $classes );

	// Turn into comma seperated list
	$classes = implode( ' ', $classes );

	// Return classes
	return $classes;
	

}

/**
 * Checks if the page has a page header
 *
 * @since Total 1.0.0
 */
function wpex_has_page_header_title() {

	// Get global object
	global $wpex_theme;

	// True by default
	$return = true;

	// Disable title if the page header is disabled via meta
	if ( 'on' == get_post_meta( $wpex_theme->post_id, 'wpex_disable_title', true ) ) {
		$return = false;
	}

	// Apply filters
	$return = apply_filters( 'wpex_has_page_header_title', $return );

	// Return
	return $return;

}

/**
 * Check if current post has subheading
 *
 * @since Total 1.0.0
 */
function wpex_has_page_header_subheading( $post_id ) {
	if ( wpex_get_page_subheading( $post_id ) ) {
		return true;
	}
}

/**
 * Get the post subheading
 *
 * @since Total 1.0.0
 */
function wpex_get_page_subheading( $post_id = '' ) {

	// Subheading is NULL by default
	$subheading = NULL;

	// Posts & Pages
	if ( $post_id ) {

		// Get subheading
		if ( get_post_meta( $post_id, 'wpex_post_subheading', true ) ) {
			$subheading = get_post_meta( $post_id, 'wpex_post_subheading', true );
		}

	}

	// Categories
	elseif ( is_category() ) {
		if ( get_theme_mod( 'category_descriptions', true ) && 'under_title' == get_theme_mod( 'category_description_position', 'under_title' ) ) {
			$subheading = term_description();
		}
	}

	// Author
	elseif ( is_author() ) {
		$subheading = __( 'This author has written', 'wpex' ) .' '. get_the_author_posts() .' '. __( 'articles', 'wpex' );
	}

	// All other Taxonomies
	elseif ( is_tax() && ! wpex_has_term_description_above_loop() ) {
		$subheading = term_description();
	}

	// Apply filters
	$subheading = apply_filters( 'wpex_post_subheading', $subheading );

	// Return subheading
	return $subheading;

}

/**
 * Get page header background image URL
 *
 * @since Total 1.5.4
 */
function wpex_page_header_background_image( $post_id = '' ) {

	// Return NULL by default
	$return = NULL;

	// Get background image
	$new_meta = get_post_meta( $post_id, 'wpex_post_title_background_redux', true );

	// Sanitize data
	if ( $new_meta ) {
		if ( is_array( $new_meta ) && ! empty( $new_meta['url'] ) ) {
			$return = $new_meta['url'];
		} else {
			$return = $new_meta;
		}
	} else {
		$return = get_post_meta( $post_id, 'wpex_post_title_background', true );
	}

	// Apply filters
	$return = apply_filters( 'wpex_page_header_background_image', $return );

	// Return URL
	return $return;
}

/**
 * Outputs Custom CSS for the page title
 *
 * @since Total 1.5.3
 */
function wpex_page_header_overlay() {

	// Return null by default
	$return = NULL;

	// Get global object
	global $wpex_theme;

	// Return if ID not defined
	if ( ! $wpex_theme->post_id ) {
		return;
	}

	// Only needed for the background-image style so return otherwise
	if ( 'background-image' != $wpex_theme->page_header_style ) {
		return;
	}

	// Get opacity and overlay style
	$overlay	= get_post_meta( $wpex_theme->post_id, 'wpex_post_title_background_overlay', true );
	$opacity	= get_post_meta( $wpex_theme->post_id, 'wpex_post_title_background_overlay_opacity', true );

	// Check that overlay style isn't set to none
	if ( $overlay && 'none' != $overlay ) {

		// Get overlay style
		$overlay_style = get_post_meta( $wpex_theme->post_id, 'wpex_post_title_background_overlay', true );

		if ( $overlay_style ) {

			// Add opacity style if opacity is defined
			if ( $opacity ) {
				$opacity = 'style="opacity:'. get_post_meta( $wpex_theme->post_id, 'wpex_post_title_background_overlay_opacity', true ) .'"';
			}

			// Echo the span for the background overlay
			$return = '<span class="background-image-page-header-overlay style-'. $overlay_style .'" '. $opacity .'></span>';

		}
	}

	// Apply filters for child theming
	$return = apply_filters( 'wpex_page_header_overlay', $return );

	// Return
	echo $return;
}

/**
 * Outputs Custom CSS for the page title
 *
 * @since Total 1.5.3
 */
function wpex_page_header_css( $output ) {

	// Get global object
	global $wpex_theme;

	// Return output if page header is disabled
	if ( ! $wpex_theme->has_page_header ) {
		return $output;
	}

	// Return output if ID not defined
	if ( ! $wpex_theme->post_id ) {
		return $output;
	}

	// Define var
	$css = '';

	// Check if a header style is defined and make header style dependent tweaks
	if ( $wpex_theme->page_header_style ) {

		// Customize background color
		if ( $wpex_theme->page_header_style == 'solid-color' || $wpex_theme->page_header_style == 'background-image' ) {
			$bg_color = get_post_meta( $wpex_theme->post_id, 'wpex_post_title_background_color', true );
			if ( $bg_color ) {
				$css .='background-color: '. $bg_color .' !important;';
			}
		}

		// Background image Style
		if ( $wpex_theme->page_header_style == 'background-image' ) {

			// Add background image
			$bg_img = wpex_page_header_background_image( $wpex_theme->post_id );
			if ( $bg_img ) {

				// Add css for background image
				$css .= 'background-image: url('. $bg_img .' ) !important;
						background-position: 50% 0;
						-webkit-background-size: cover;
						-moz-background-size: cover;
						-o-background-size: cover;
						background-size: cover;';

				// Custom height
				$title_height	= get_post_meta( $wpex_theme->post_id, 'wpex_post_title_height', true );
				$title_height	= $title_height ? $title_height : '400';
				if ( $title_height ) {
					$css .= 'height:'. wpex_sanitize_data( $title_height, 'px' ) .' !important;';
				}
			}

		}

	}

	// Apply all css to the page-header class
	if ( ! empty( $css ) ) {
		$css = '.page-header { '. $css .' }';
	}

	// Overlay Color
	if ( ! empty( $bg_img ) ) {
		$overlay_color = get_post_meta( $wpex_theme->post_id, 'wpex_post_title_background_overlay', true );
		if ( 'bg_color' == $overlay_color && $wpex_theme->page_header_style == 'background-image' && isset( $bg_color ) ) {
			$css .= '.background-image-page-header-overlay { background-color: '. $bg_color .' !important; }';
		}
	}

	// If css var isn't empty add to custom css output
	if ( ! empty( $css ) ) {
		$output .= wpex_minify_css( $css );
	}

	// Return output
	return $output;

}
add_filter( 'wpex_head_css', 'wpex_page_header_css' );
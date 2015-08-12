<?php
/**
 * Create awesome overlays for image hovers
 *
 * @package		Total
 * @subpackage	Framework
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.0.0
 */

/**
 * Displays the Overlay HTML
 *
 * @since Total 1.0.0
 */
if ( ! function_exists( 'wpex_overlay' ) ) {
	function wpex_overlay( $position = 'inside_link', $style = '', $args = array() ) {

		// If style is set to none lets bail
		if ( 'none' == $style ) {
			return;
		}

		// If style not defined get correct style based on theme_mods
		elseif ( ! $style ) {
			$style = wpex_overlay_style();
		}

		// If style is defined lets locate and include the overlay template
		if ( $style ) {

			// Load the overlay template
			$overlays_dir	= 'partials/overlays/';
			$template		= $overlays_dir . $style .'.php';
			$template		= locate_template( $template, false );

			// Only load template if it exists
			if ( $template ) {
				include( $template );
			}

		}

	}
}

/**
 * Create an array of overlay styles so they can be altered via child themes
 *
 * @since Total 1.0.0
 */
if ( ! function_exists( 'wpex_overlay_styles_array' ) ) {
	function wpex_overlay_styles_array( $style = NULL ) {
		$array = array(
			''								=> __( 'None', 'wpex' ),
			'plus-hover'					=> __( 'Plus Icon Hover', 'wpex' ),
			'plus-two-hover'				=> __( 'Plus Icon #2 Hover', 'wpex' ),
			'view-lightbox-buttons-buttons'	=> __( 'View/Lightbox Icons Hover', 'wpex' ),
			'view-lightbox-buttons-text'	=> __( 'View/Lightbox Text Hover', 'wpex' ),
			'title-excerpt-hover'			=> __( 'Title + Excerpt Hover', 'wpex' ),
			'title-category-hover'			=> __( 'Title + Category Hover', 'wpex' ),
			'title-category-visible'		=> __( 'Title + Category Visible', 'wpex' ),
			'title-date-hover'				=> __( 'Title + Date Hover', 'wpex' ),
			'title-date-visible'			=> __( 'Title + Date Visible', 'wpex' ),
			'slideup-title-white'			=> __( 'Slide-Up Title White', 'wpex' ),
			'slideup-title-black'			=> __( 'Slide-Up Title Black', 'wpex' ),
		);
		$array = apply_filters( 'wpex_overlay_styles_array', $array );
		return $array;
	}
}

/**
 * Returns the overlay type depending on your theme options & post type
 *
 * @since Total 1.0.0
 */
if ( ! function_exists( 'wpex_overlay_style' ) ) {
	function wpex_overlay_style( $style = '' ) {

		// Get style
		$style = $style ? $style : get_post_type();

		// Portfolio
		if ( 'portfolio' == $style ) {
			return get_theme_mod( 'portfolio_entry_overlay_style' );
		}
		
		// Staff
		elseif ( 'staff' == $style ) {
			return get_theme_mod( 'staff_entry_overlay_style' );
		}

	}
}

/**
 * Returns the correct overlay Classname
 *
 * @since Total 1.0.0
 */
if ( ! function_exists( 'wpex_overlay_classes' ) ) {
	function wpex_overlay_classes( $style = '' ) {

		// Return if style is set to none
		if ( 'none' == $style ) {
			return;
		}

		// If style is empty get the style
		if ( empty( $style ) ) {
			$style = wpex_overlay_style();
		}

		// Return classes
		if ( $style ) {
			return 'overlay-parent overlay-parent-'. $style;
		}

	}
}
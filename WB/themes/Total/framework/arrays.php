<?php
/**
 * Useful functions that return arrays
 *
 * @package     Total
 * @subpackage  Framework
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.6.0
 */

/**
 * Returns array of Social Options for the Top Bar
 *
 * @since   Total 1.6.0
 * @return  bool
 */
function wpex_topbar_social_options() {
    $social_options = array(
        'twitter'       => array(
            'label'         => 'Twitter',
            'icon_class'    => 'fa fa-twitter',
        ),
        'facebook'      => array(
            'label'         => 'Facebook',
            'icon_class'    => 'fa fa-facebook',
        ),
        'googleplus'    => array(
            'label'         => 'Google Plus',
            'icon_class'    => 'fa fa-google-plus',
        ),
        'pinterest'     => array(
            'label'         => 'Pinterest',
            'icon_class'    => 'fa fa-pinterest',
        ),
        'dribbble'      => array(
            'label'         => 'Dribbble',
            'icon_class'    => 'fa fa-dribbble',
        ),
        'vk'            => array(
            'label'         => 'Vk',
            'icon_class'    => 'fa fa-vk',
        ),
        'instagram'     => array(
            'label'         => 'Instragram',
            'icon_class'    => 'fa fa-instagram',
        ),
        'linkedin'      => array(
            'label'         => 'LinkedIn',
            'icon_class'    => 'fa fa-linkedin',
        ),
        'tumblr'        => array(
            'label'         => 'Tumblr',
            'icon_class'    => 'fa fa-tumblr',
        ),
        'github'        => array(
            'label'         => 'Github',
            'icon_class'    => 'fa fa-github-alt',
        ),
        'flickr'        => array(
            'label'         => 'Flickr',
            'icon_class'    => 'fa fa-flickr',
        ),
        'skype'         => array(
            'label'         => 'Skype',
            'icon_class'    => 'fa fa-skype',
        ),
        'youtube'       => array(
            'label'         => 'Youtube',
            'icon_class'    => 'fa fa-youtube',
        ),
        'vimeo'         => array(
            'label'         => 'Vimeo',
            'icon_class'    => 'fa fa-vimeo-square',
        ),
        'vine'          => array(
            'label'         => 'Vine',
            'icon_class'    => 'fa fa-vine',
        ),
        'xing'          => array(
            'label'         => 'Xing',
            'icon_class'    => 'fa fa-xing',
        ),
        'yelp'          => array(
            'label'         => 'Yelp',
            'icon_class'    => 'fa fa-yelp',
        ),

        'rss'           => array(
            'label'         => __( 'RSS', 'wpex' ),
            'icon_class'    => 'fa fa-rss',
        ),
        'email'         => array(
            'label'         => __( 'Email', 'wpex' ),
            'icon_class'    => 'fa fa-envelope',
        ),
    );
    return apply_filters ( 'wpex_topbar_social_options', $social_options );
}

/**
 * Array of social profiles for staff members
 *
 * @since Total 1.5.4
 */
function wpex_staff_social_array() {
    $array = array(
        array (
            'key'           => 'twitter',
            'meta'          => 'wpex_staff_twitter',
            'icon_class'    => 'fa fa-twitter',
            'label'         => 'Twitter',
        ),
        array (
            'key'           => 'facebook',
            'meta'          => 'wpex_staff_facebook',
            'icon_class'    => 'fa fa-facebook',
            'label'         => 'Facebook',
        ),
        array (
            'key'           => 'google-plus',
            'meta'          => 'wpex_staff_google-plus',
            'icon_class'    => 'fa fa-google-plus',
            'label'         => 'Google Plus',
        ),
        array (
            'key'           => 'linkedin',
            'meta'          => 'wpex_staff_linkedin',
            'icon_class'    => 'fa fa-linkedin',
            'label'         => 'Linkedin',
        ),
        array (
            'key'           => 'dribbble',
            'meta'          => 'wpex_staff_dribbble',
            'icon_class'    => 'fa fa-dribbble',
            'label'         => 'Dribbble',
        ),
        array (
            'key'           => 'vk',
            'meta'          => 'wpex_staff_vk',
            'icon_class'    => 'fa fa-vk',
            'label'         => 'VK',
        ),
        array (
            'key'           => 'skype',
            'meta'          => 'wpex_staff_skype',
            'icon_class'    => 'fa fa-skype',
            'label'         => 'Skype',
        ),
        array (
            'key'           => 'phone_number',
            'meta'          => 'wpex_staff_phone_number',
            'icon_class'    => 'fa fa-phone',
            'label'         => __( 'Phone Number', 'wpex' ),
        ),
        array (
            'key'           => 'email',
            'meta'          => 'wpex_staff_email',
            'icon_class'    => 'fa fa-envelope',
            'label'         => __( 'Email', 'wpex' ),
        ),
        array (
            'key'           => 'website',
            'meta'          => 'wpex_staff_website',
            'icon_class'    => 'fa fa-external-link-square',
            'label'         => __( 'Website', 'wpex' ),
        ),
    );
    return apply_filters( 'wpex_staff_social_array', $array );
}

/**
 * Creates an array for adding the staff social options to the metaboxes
 *
 * @since   Total 1.5.4
 * @return  array
 */
function wpex_staff_social_meta_array() {
    $profiles = wpex_staff_social_array();
    $array = array();
    foreach ( $profiles as $profile ) {
        $array[] = array(
                'title'     => '<span class="'. $profile['icon_class'] .'"></span>' . $profile['label'],
                'id'        => $profile['meta'],
                'type'      => 'text',
                'std'       => '',
        );
    }
    return $array;
}

/**
 * Grid Columns
 *
 * @since   Total 2.0.0
 * @return  array
 */
function wpex_grid_columns() {
    $columns = array(
        '1' => __( 'One', 'wpex' ),
        '2' => __( 'Two', 'wpex' ),
        '3' => __( 'Three', 'wpex' ),
        '4' => __( 'Four', 'wpex' ),
        '5' => __( 'Five', 'wpex' ),
        '6' => __( 'Six', 'wpex' ),
    );
    return apply_filters( 'wpex_grid_columns', $columns );
}

/**
 * Grid Column Gaps
 *
 * @since   Total 2.0.0
 * @return  array
 */
function wpex_column_gaps() {
    $gaps = array(
        ''      => __( 'Default', 'wpex' ),
        'none'  => '0px',
        '5'     => '5px',
        '10'    => '10px',
        '15'    => '15px',
        '20'    => '20px',
        '25'    => '25px',
        '30'    => '30px',
        '35'    => '35px',
        '40'    => '40px',
        '50'    => '50px',
        '60'    => '60px',
    );
    return apply_filters( 'wpex_column_gaps', $gaps );
}

/**
 * Typography Styles
 *
 * @since   Total 2.0.0
 * @return  array
 */
function wpex_typography_styles() {
    $columns = array(
        ''      => __( 'Default', 'wpex' ),
        'light' => __( 'Light', 'wpex' ),
        'white' => __( 'White', 'wpex' ),
        'black' => __( 'Black', 'wpex' ),
        'none'  => __( 'None', 'wpex' ),
    );
    return apply_filters( 'wpex_typography_styles', $columns );
}

/**
 * Button styles
 *
 * @since   Total 1.6.2
 * @return  array
 */
function wpex_button_styles() {
    $styles = array(
        ''          => __( 'Default', 'wpex' ),
        'flat'      => __( 'Flat', 'wpex' ),
        'graphical' => __( 'Graphical', 'wpex' ),
        'clean'     => __( 'Clean', 'wpex' ),
        'three-d'   => __( '3D', 'wpex' ),
        'outline'   => __( 'Outline', 'wpex' ),
    );
    return apply_filters( 'wpex_button_styles', $styles );
}

/**
 * Button colors
 *
 * @since   Total 1.6.2
 * @return  array
 */
function wpex_button_colors() {
    $colors = array(
        ''          => __( 'Default', 'wpex' ),
        'black'     => __( 'Black', 'wpex' ),
        'blue'      => __( 'Blue', 'wpex' ),
        'brown'     => __( 'Brown', 'wpex' ),
        'grey'      => __( 'Grey', 'wpex' ),
        'green'     => __( 'Green', 'wpex' ),
        'gold'      => __( 'Gold', 'wpex' ),
        'orange'    => __( 'Orange', 'wpex' ),
        'pink'      => __( 'Pink', 'wpex' ),
        'purple'    => __( 'Purple', 'wpex' ),
        'red'       => __( 'Red', 'wpex' ),
        'rosy'      => __( 'Rosy', 'wpex' ),
        'teal'      => __( 'Teal', 'wpex' ),
        'white'     => __( 'White', 'wpex' ),
    );
    return apply_filters( 'wpex_button_colors', $colors );
}

/**
 * Array of image crop locations
 *
 * @link    http://codex.wordpress.org/Function_Reference/get_intermediate_image_sizes
 * @since   Total 2.0.0
 * @return  array
 */
function wpex_image_crop_locations() {
    return array(
        ''              => __( 'Default', 'wpex' ),
        'left-top'      => __( 'Top Left', 'wpex' ),
        'right-top'     => __( 'Top Right', 'wpex' ),
        'center-top'    => __( 'Top Center', 'wpex' ),
        'left-center'   => __( 'Center Left', 'wpex' ),
        'right-center'  => __( 'Center Right', 'wpex' ),
        'center-center' => __( 'Center Center', 'wpex' ),
        'left-bottom'   => __( 'Bottom Left', 'wpex' ),
        'right-bottom'  => __( 'Bottom Right', 'wpex' ),
        'center-bottom' => __( 'Bottom Center', 'wpex' ),
    );
}

/**
 * Image Hovers
 *
 * @since   Total 1.6.2
 * @return  array
 */
function wpex_image_hovers() {
    $hovers = array(
        ''              => __( 'Default', 'wpex' ),
        'opacity'       => __( 'Opacity', 'wpex' ),
        'grow'          => __( 'Grow', 'wpex' ),
        'shrink'        => __( 'Shrink', 'wpex' ),
        'side-pan'      => __( 'Side Pan', 'wpex' ),
        'vertical-pan'  => __( 'Vertical Pan', 'wpex' ),
        'tilt'          => __( 'Tilt', 'wpex' ),
        'blurr'         => __( 'Normal - Blurr', 'wpex' ),
        'blurr-invert'  => __( 'Blurr - Normal', 'wpex' ),
        'sepia'         => __( 'Sepia', 'wpex' ),
        'fade-out'      => __( 'Fade Out', 'wpex' ),
        'fade-in'       => __( 'Fade In', 'wpex' ),
    );
    return apply_filters( 'wpex_image_hovers', $hovers );
}

/**
 * Returns correct image hover classnames
 *
 * @since   Total 2.0.0
 * @return  array
 */
function wpex_image_hover_classes( $style ) {
    $classes    = array( 'wpex-image-hover' );
    $classes[]  = $style;
    return implode( ' ', $classes );
}

/**
 * Returns correct image rendering class
 *
 * @since   Total 2.0.0
 * @return  array
 */
function wpex_image_rendering_class( $rendering ) {
    return 'image-rendering-'. $rendering;
}

/**
 * Returns correct image filter class
 *
 * @since   Total 2.0.0
 * @return  array
 */
function wpex_image_filter_class( $filter ) {
    if ( ! $filter || 'none' == $filter ) {
        return;
    }
    return 'image-filter-'. $filter;
}

/**
 * Font Weights
 *
 * @since   Total 1.6.2
 * @return  array
 */
function wpex_font_weights() {
    $weights = array(
        ''          => __( 'Default', 'wpex' ),
        'normal'    => __( 'Normal', 'wpex' ),
        'semibold'  => __( 'Semibold', 'wpex' ),
        'bold'      => __( 'Bold', 'wpex' ),
        'bolder'    => __( 'Bolder', 'wpex' ),
        '100'       => '100',
        '200'       => '200',
        '300'       => '300',
        '400'       => '400',
        '500'       => '500',
        '600'       => '600',
        '700'       => '700',
        '800'       => '800',
        '900'       => '900',
    );
    return apply_filters( 'wpex_font_weights', $weights );
}

/**
 * Array of ilightbox skins
 *
 * @since   Total 2.0.0
 * @return  array
 */
function wpex_ilightbox_skins() {
    $skins = array(
        //'total'         => __( 'Total', 'wpex' ),
        'dark'          => __( 'Dark', 'wpex' ),
        'light'         => __( 'Light', 'wpex' ),
        'mac'           => __( 'Mac', 'wpex' ),
        'metro-black'   => __( 'Metro Black', 'wpex' ),
        'metro-white'   => __( 'Metro White', 'wpex' ),
        'parade'        => __( 'Parade', 'wpex' ),
        'smooth'        => __( 'Smooth', 'wpex' ),
    );
    return apply_filters( 'wpex_ilightbox_skins', $skins );
}

/**
 * Text Transform
 *
 * @since   Total 1.6.2
 * @return  array
 */
function wpex_text_transforms() {
    return array(
        ''              => __( 'Default', 'wpex' ),
        'none'          => __( 'None', 'wpex' ) ,
        'capitalize'    => __( 'Capitalize', 'wpex' ),
        'uppercase'     => __( 'Uppercase', 'wpex' ),
        'lowercase'     => __( 'Lowercase', 'wpex' ),
    );
}

/**
 * Border Styles
 *
 * @since   Total 1.6.0
 * @return  array
 */
function wpex_border_styles() {
    return array(
        ''          => __( 'Default', 'wpex' ),
        'solid'     => __( 'Solid', 'wpex' ),
        'dotted'    => __( 'Dotted', 'wpex' ),
        'dashed'    => __( 'Dashed', 'wpex' ),
    );
}

/**
 * Alignments
 *
 * @since   Total 1.6.0
 * @return  array
 */
function wpex_alignments() {
    return array(
        ''          => __( 'Default', 'wpex' ),
        'left'      => __( 'Left', 'wpex' ),
        'right'     => __( 'Right', 'wpex' ),
        'center'    => __( 'Center', 'wpex' ),
    );
}

/**
 * Visibility
 *
 * @since   Total 1.6.0
 * @return  array
 */
function wpex_visibility() {
    $visibility = array(
        ''                          => __( 'Always Visible', 'wpex' ),
        'hidden-phone'              => __( 'Hidden on Phones', 'wpex' ),
        'hidden-tablet'             => __( 'Hidden on Tablets', 'wpex' ),
        'hidden-tablet-landscape'   => __( 'Hidden on Tablets: Landscape', 'wpex' ),
        'hidden-tablet-portrait'    => __( 'Hidden on Tablets: Portrait', 'wpex' ),
        'hidden-desktop'            => __( 'Hidden on Desktop', 'wpex' ),
        'visible-desktop'           => __( 'Visible on Desktop Only', 'wpex' ),
        'visible-phone'             => __( 'Visible on Phones Only', 'wpex' ),
        'visible-tablet'            => __( 'Visible on Tablets Only', 'wpex' ),
        'visible-tablet-landscape'  => __( 'Visible on Tablets: Landscape Only', 'wpex' ),
        'visible-tablet-portrait'   => __( 'Visible on Tablets: Portrait Only', 'wpex' ),
    );
    return apply_filters( 'wpex_visibility', $visibility );
}

/**
 * CSS Animations
 *
 * @since   Total 1.6.0
 * @return  array
 */
function wpex_css_animations() {
    $animations = array(
        ''              => __( 'None', 'wpex') ,
        'top-to-bottom' => __( 'Top to bottom', 'wpex' ),
        'bottom-to-top' => __( 'Bottom to top', 'wpex' ),
        'left-to-right' => __( 'Left to right', 'wpex' ),
        'right-to-left' => __( 'Right to left', 'wpex' ),
        'appear'        => __( 'Appear from center', 'wpex' ),
    );
    return apply_filters( 'wpex_css_animations', $animations );
}

/**
 * Array of Hover CSS animations
 *
 * @since   Total 2.0.0
 * @return  array
 */
function wpex_hover_css_animations() {
    $animations = array(
        ''                          => __( 'Default', 'wpex' ),
        'shadow'                    => __( 'Shadow', 'wpex' ),
        'grow-shadow'               => __( 'Grow Shadow', 'wpex' ),
        'float-shadow'              => __( 'Float Shadow', 'wpex' ),
        'grow'                      => __( 'Grow', 'wpex' ),
        'shrink'                    => __( 'Shrink', 'wpex' ),
        'pulse'                     => __( 'Pulse', 'wpex' ),
        'pulse-grow'                => __( 'Pulse Grow', 'wpex' ),
        'pulse-shrink'              => __( 'Pulse Shrink', 'wpex' ),
        'push'                      => __( 'Push', 'wpex' ),
        'pop'                       => __( 'Pop', 'wpex' ),
        'bounce-in'                 => __( 'Bounce In', 'wpex' ),
        'bounce-out'                => __( 'Bounce Out', 'wpex' ),
        'rotate'                    => __( 'Rotate', 'wpex' ),
        'grow-rotate'               => __( 'Grow Rotate', 'wpex' ),
        'float'                     => __( 'Float', 'wpex' ),
        'sink'                      => __( 'Sink', 'wpex' ),
        'bob'                       => __( 'Bob', 'wpex' ),
        'hang'                      => __( 'Hang', 'wpex' ),
        'skew'                      => __( 'Skew', 'wpex' ),
        'skew-backward'             => __( 'Skew Backward', 'wpex' ),
        'wobble-horizontal'         => __( 'Wobble Horizontal', 'wpex' ),
        'wobble-vertical'           => __( 'Wobble Vertical', 'wpex' ),
        'wobble-to-bottom-right'    => __( 'Wobble To Bottom Right', 'wpex' ),
        'wobble-to-top-right'       => __( 'Wobble To Top Right', 'wpex' ),
        'wobble-top'                => __( 'Wobble Top', 'wpex' ),
        'wobble-bottom'             => __( 'Wobble Bottom', 'wpex' ),
        'wobble-skew'               => __( 'Wobble Skew', 'wpex' ),
        'buzz'                      => __( 'Buzz', 'wpex' ),
        'buzz-out'                  => __( 'Buzz Out', 'wpex' ),
        'glow'                      => __( 'Glow', 'wpex' ),
        'shadow-radial'             => __( 'Shadow Radial', 'wpex' ),
        'box-shadow-outset'         => __( 'Box Shadow Outset', 'wpex' ),
        'box-shadow-inset'          => __( 'Box Shadow Inset', 'wpex' ),
    );
    return apply_filters( 'wpex_hover_css_animations', $animations );
}
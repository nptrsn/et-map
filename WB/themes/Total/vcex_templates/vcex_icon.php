<?php
/**
 * Output for the Total button Visual Composer module
 *
 * @package     Total
 * @subpackage  vcex_templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 2.0.0
 * @version     2.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Not needed in admin ever.
if ( is_admin() ) return;

// Extract shortcode attributes
extract( shortcode_atts( array(
    'unique_id'         => '',
    'wrap_classes'      => '',
    'icon_type'         => 'fontawesome',
    'icon'              => '',
    'icon_fontawesome'  => '',
    'icon_openiconic'   => '',
    'icon_typicons'     => '',
    'icon_entypo'       => '',
    'icon_linecons'     => '',
    'icon_pixelicons'   => '',
    'style'             => '',
    'float'             => '',
    'size'              => '',
    'custom_size'       => '',
    'color'             => '',
    'color_hover'       => '',
    'background_hover'  => '',
    'padding'           => '',
    'background'        => '',
    'border_radius'     => '',
    'css_animation'     => '',
    'hover_animation'   => '',
    'link_url'          => '',
    'link_target'       => '',
    'link_rel'          => '',
    'link_title'        => '',
    'link_local_scroll' => '',
    'el_class'          => '',
    'height'            => '',
    'width'             => '',
    //'css'               => '',
), $atts ) );

// Sanitize data
$css                = false; // Disable CSS module
$icon               = vcex_get_icon_class( $atts, 'icon' );
$link_local_scroll  = ( 'true' == $link_local_scroll ) ? true : false;

// Enqueue needed icon font
if ( $icon && 'fontawesome' != $icon_type ) {
    vcex_enqueue_icon_font( $icon_type );
}

// Link attributes and wrap_classes
if ( $link_url ) {

    // Generate link
    $link_url_temp  = $link_url;
    $link_url       = vcex_get_link_data( 'url', $link_url_temp );

    if ( $link_url ) {

        // Link attributes
        $link_title     = vcex_get_link_data( 'title', $link_url_temp, $link_title );
        $link_title     = vcex_html( 'title_attr', $link_title );
        $link_target    = vcex_get_link_data( 'target', $link_url_temp, $link_target );

        // Link wrap_classes
        $link_wrap_classes = array( 'vcex-icon-link' );

        // Local links
        if ( $link_local_scroll || 'local' == $link_target ) {
            $link_target    = 'local';
            $link_wrap_classes[] = 'local-scroll-link';
        }

        // Generate link target HTMl
        else {
            $link_target = vcex_html( 'target_attr', $link_target );
        }

    }

}

// Add styling
$icon_style = vcex_inline_style( array(
    'font_size'         => $custom_size,
    'color'             => $color,
    'padding'           => $padding,
    'background_color'  => $background,
    'border_radius'     => $border_radius,
    'height'            => $height,
    'line_height'       => vcex_sanitize_data( $height, 'px' ),
    'width'             => $width,
) );

// Icon Classes 
$wrap_classes = array( 'vcex-icon', 'clr' );
if ( $style ) {
    $wrap_classes[] = 'vcex-icon-'. $style;
}
if ( $size ) {
    $wrap_classes[] = 'vcex-icon-'. $size;
}
if ( $float ) {
    $wrap_classes[] = 'vcex-icon-float-'. $float;
}
if ( $custom_size ) {
    $wrap_classes[] = 'custom-size';
}
if ( $background ) {
    $wrap_classes[] = 'has-bg';
}
if ( ! $background ) {
    $wrap_classes[] = 'remove-dimensions';
}
if ( $height || $width ) {
    $wrap_classes[] = 'remove-padding';
    $wrap_classes[] = 'remove-dimensions';
}
if ( $css_animation ) {
    $wrap_classes[] = $this->getCSSAnimation( $css_animation );
}
if ( $el_class ) {
    $wrap_classes[] = $this->getExtraClass( $el_class );
}

// Turn wrap classes into string
$wrap_classes = implode( ' ', $wrap_classes );

// Icon classes
$icon_classes = array( 'vcex-icon-wrap' );
if ( $hover_animation ) {
    $icon_classes[] = wpex_hover_animation_class( $hover_animation );
    vcex_enque_style( 'hover-animations' );
}

// Icon hovers
if ( $color_hover || $background_hover ) {

    // Define data attributes
    $data_attributes = array();

    // Add hover background data attribute
    if ( $background_hover ) {
        $data_attributes[] = 'data-hover-background="'. $background_hover .'"';
    }

    // Add hover color data
    if ( $color_hover ) {
        $data_attributes[] = 'data-hover-color="'. $color_hover .'"';
    }

    // Check for data attributes
    if ( $data_attributes ) {

        // Add hover class to wrap classes
        $icon_classes[] = 'wpex-data-hover';

        // Turn data attributes into a string
        $data_attributes = implode( ' ', $data_attributes );

    }

    // Load js for front end composer
    vcex_inline_js( 'data_hover' );

} else {
    $data_attributes = '';
}

// Turn icon classes into string
$icon_classes = implode( ' ', $icon_classes ); ?>

<?php
// Open CSS wrap
if ( $css ) : ?>
    
    <div class="clr <?php echo apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css ), 'vcex_icon', $atts ); ?>">

<?php endif; ?>

    <div class="<?php echo $wrap_classes; ?>"<?php vcex_unique_id( $unique_id ); ?>>

        <?php
        // Open link tag
        if ( $link_url ) : ?>

            <?php
            // Turn link wrap_classes into string
            $link_wrap_classes = implode( ' ', $link_wrap_classes ); ?>

            <a href="<?php echo $link_url; ?>" class="<?php echo $link_wrap_classes; ?>"<?php echo $link_title; ?><?php echo $link_target; ?>>

        <?php endif; ?>

        <div class="<?php echo $icon_classes; ?>"<?php echo $icon_style; ?><?php echo $data_attributes; ?>>
            <span class="<?php echo $icon; ?>"></span>
        </div><!-- .vcex-icon-wrap -->

        <?php
        // Close link tag
        if ( $link_url ) echo '</a>'; ?>

    </div><!-- .<?php echo $wrap_classes; ?> -->

<?php
// Close css wrap
if ( $css ) echo '</div>'; ?>
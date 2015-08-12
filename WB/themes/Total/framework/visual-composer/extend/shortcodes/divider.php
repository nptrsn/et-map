<?php
/**
 * Registers the divider shortcode and adds it to the Visual Composer
 *
 * @package     Total
 * @subpackage  Framework/Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.4.1
 * @version     2.0.0
 */

/**
 * Register shortcode with VC Composer
 *
 * @since Total 2.0.0
 */
class WPBakeryShortCode_vcex_divider extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_divider.php' ) );
        return ob_get_clean();
    }
}

/**
 * Parse shortcode attributes and set correct values
 *
 * @since Total 2.0.0
 */
function parse_vcex_divider_atts( $atts ) {

    // Set font family if icon is defined
    if ( isset( $atts['icon'] ) && empty( $atts['icon_type'] ) ) {
        $atts['icon_type']  = 'fontawesome';
        $atts['icon']       = 'fa fa-'. $atts['icon'];
    }

    // Return $atts
    return $atts;
}
add_filter( 'vc_edit_form_fields_attributes_vcex_divider', 'parse_vcex_divider_atts' );

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_divider_shortcode_vc_map' ) ) {
    function vcex_divider_shortcode_vc_map() {
        vc_map( array(
            'name'                  => __( 'Divider', 'wpex' ),
            'description'           => __( 'Line seperator', 'wpex' ),
            'base'                  => 'vcex_divider',
            'icon'                  => 'vcex-divider',
            'category'              => WPEX_THEME_BRANDING,
            'params'                => array(

                // General
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Classes', 'wpex' ),
                    'param_name'    => 'el_class',
                    'description'   => __( 'Add additonal classes to the main element.', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Appear Animation', 'wpex' ),
                    'param_name'    => 'css_animation',
                    'value'         => array(
                        __( 'No', 'wpex' )                  => '',
                        __( 'Top to bottom', 'wpex' )       => 'top-to-bottom',
                        __( 'Bottom to top', 'wpex' )       => 'bottom-to-top',
                        __( 'Left to right', 'wpex' )       => 'left-to-right',
                        __( 'Right to left', 'wpex' )       => 'right-to-left',
                        __( 'Appear from center', 'wpex' )  => 'appear'
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Visibility', 'wpex' ),
                    'param_name'    => 'visibility',
                    'value'         => vcex_visibility(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'dropdown',
                    'admin_label'   => true,
                    'heading'       => __( 'Style', 'wpex' ),
                    'param_name'    => 'style',
                    'value'         => array(
                        __( 'Solid', 'wpex')    => 'solid',
                        __( 'Dashed', 'wpex' )  => 'dashed',
                        __( 'Dotted', 'wpex' )  => 'dotted',
                        __( 'Double', 'wpex' )  => 'double',
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Width', 'wpex' ),
                    'param_name'    => 'width',
                    'description'   => __( 'Enter a pixel or percentage value.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Height', 'wpex' ),
                    'param_name'    => 'height',
                    'description'   => __( 'Please enter a px value.', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'style',
                        'value'     => array( 'solid', 'dashed', 'double' ),
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Height', 'wpex' ),
                    'param_name'    => 'dotted_height',
                    'description'   => __( 'Please enter a px value.', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'style',
                        'value'     => 'dotted',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Color', 'wpex' ),
                    'param_name'    => 'color',
                    'value'         => '',
                    'dependency'    => Array(
                        'element'   => 'style',
                        'value'     => array( 'solid', 'dashed', 'double' ),
                    ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Margin Top', 'wpex' ),
                    'param_name'        => 'margin_top',
                    'description'       => __( 'Please enter a px value.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Margin Bottom', 'wpex' ),
                    'description'       => __( 'Please enter a px value.', 'wpex' ),
                    'param_name'        => 'margin_bottom',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),

                // Icon
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Icon library', 'wpex' ),
                    'param_name'    => 'icon_type',
                    'description'   => __( 'Select icon library.', 'wpex' ),
                    'value'         => array(
                        __( 'Font Awesome', 'wpex' )    => 'fontawesome',
                        __( 'Open Iconic', 'wpex' )     => 'openiconic',
                        __( 'Typicons', 'wpex' )        => 'typicons',
                        __( 'Entypo', 'wpex' )          => 'entypo',
                        __( 'Linecons', 'wpex' )        => 'linecons',
                        __( 'Pixel', 'wpex' )           => 'pixelicons',
                    ),
                    'group'         => __( 'Icon', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon', 'wpex' ),
                    'param_name'    => 'icon',
                    'std'           => '',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'fontawesome',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'fontawesome',
                    ),
                    'group'         => __( 'Icon', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon', 'wpex' ),
                    'param_name'    => 'icon_openiconic',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'openiconic',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'openiconic',
                    ),
                    'group'         => __( 'Icon', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon', 'wpex' ),
                    'param_name'    => 'icon_typicons',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'typicons',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'typicons',
                    ),
                    'group'         => __( 'Icon', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon', 'wpex' ),
                    'param_name'    => 'icon_entypo',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'entypo',
                        'iconsPerPage'  => 300,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'entypo',
                    ),
                    'group'         => __( 'Icon', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon', 'wpex' ),
                    'param_name'    => 'icon_linecons',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'linecons',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'linecons',
                    ),
                    'group'         => __( 'Icon', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon', 'wpex' ),
                    'param_name'    => 'icon_pixelicons',
                    'settings'      => array(
                        'emptyIcon' => true,
                        'type'      => 'pixelicons',
                        'source'    => vcex_pixel_icons(),
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'pixelicons',
                    ),
                    'group'         => __( 'Icon', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Icon Color', 'wpex' ),
                    'param_name'    => 'icon_color',
                    'group'         => __( 'Icon', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Icon Background', 'wpex' ),
                    'param_name'    => 'icon_bg',
                    'group'         => __( 'Icon', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Icon Size', 'wpex' ),
                    'param_name'    => 'icon_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                    'group'         => __( 'Icon', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Icon Height', 'wpex' ),
                    'param_name'    => 'icon_height',
                    'description'   => __( 'Please enter a px value.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                    'group'         => __( 'Icon', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Icon Width', 'wpex' ),
                    'param_name'    => 'icon_width',
                    'description'   => __( 'Please enter a px value.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                    'group'         => __( 'Icon', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Icon Padding', 'wpex' ),
                    'param_name'    => 'icon_padding',
                    'description'   => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'group'         => __( 'Icon', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Icon Border Radius', 'wpex' ),
                    'param_name'    => 'icon_border_radius',
                    'description'   => __( 'Please enter a px value. Or enter 100% for a circle.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'         => __( 'Icon', 'wpex' ),
                ),
            )
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_divider_shortcode_vc_map' );
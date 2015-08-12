<?php
/**
 * Registers the Icon Box shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_icon_box extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_icon_box.php' ) );
        return ob_get_clean();
    }
}

/**
 * Parse shortcode attributes and set correct values
 *
 * @since Total 2.0.0
 */
function parse_vcex_icon_box_atts( $atts ) {

    // Set font family if icon is defined
    if ( isset( $atts['icon'] ) && empty( $atts['icon_type'] ) ) {
        $atts['icon_type']  = 'fontawesome';
        $atts['icon']       = 'fa fa-'. $atts['icon'];
    }

    // Return $atts
    return $atts;
}
add_filter( 'vc_edit_form_fields_attributes_vcex_icon_box', 'parse_vcex_icon_box_atts' );

/**
 * Register the shortcode for use with the Visual Composer
 *
 * @link    https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
 * @since   1.4.1
 */
if ( ! function_exists( 'vcex_icon_box_shortcode_vc_map' ) ) {
    function vcex_icon_box_shortcode_vc_map() {

        vc_map( array(
            'name'                  => __( 'Icon Box', 'wpex' ),
            'base'                  => 'vcex_icon_box',
            'category'              => WPEX_THEME_BRANDING,
            'icon'                  => 'vcex-icon-box',
            'description'           => __( 'Content box with icon', 'wpex' ),
            'params'                => array(

                // General
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Unique Id', 'wpex' ),
                    'description'   => __( 'Give your main element a unique ID.', 'wpex' ),
                    'param_name'    => 'unique_id',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Classes', 'wpex' ),
                    'param_name'    => 'classes',
                    'description'   => __( 'Add additonal classes to the main element.', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Visibility', 'wpex' ),
                    'param_name'    => 'visibility',
                    'value'         => vcex_visibility(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Appear Animation', 'wpex'),
                    'param_name'        => 'css_animation',
                    'value'             => vcex_css_animations(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Hover Animation', 'wpex'),
                    'param_name'        => 'hover_animation',
                    'value'             => vcex_hover_animations(),
                    'std'               => '',
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Style', 'wpex' ),
                    'param_name'    => 'style',
                    'value'         => vcex_icon_box_styles(),
                    'description'   => __( 'For greater control select left, right or top icon styles then go to the "Design" tab to modify the icon box design.', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Alignment', 'wpex' ),
                    'param_name'    => 'alignment',
                    'dependency'    => Array(
                        'element'   => 'style',
                        'value'     => array( 'two' ),
                    ),
                    'value'         => array(
                        __( 'Default', 'wpex')  => '',
                        __( 'Center', 'wpex')   => 'center',
                        __( 'Left', 'wpex' )    => 'left',
                        __( 'Right', 'wpex' )   => 'right',
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Icon Bottom Margin', 'wpex' ),
                    'param_name'    => 'icon_bottom_margin',
                    'description'   => __( 'Please enter a px value.', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'style',
                        'value'     => array( 'two', 'three', 'four', 'five', 'six' ),
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Container Left Padding', 'wpex' ),
                    'param_name'    => 'container_left_padding',
                    'description'   => __( 'Please enter a px value.', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'style',
                        'value'     => array( 'one' )
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Container Right Padding', 'wpex' ),
                    'param_name'    => 'container_right_padding',
                    'description'   => __( 'Please enter a px value.', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'style',
                        'value'     => array( 'seven' )
                    ),
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
                        __( 'Entypo', 'wpex' )           => 'entypo',
                        __( 'Linecons', 'wpex' )        => 'linecons',
                        __( 'Pixel', 'wpex' )           => 'pixelicons',
                    ),
                    'group'         => __( 'Icon', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon', 'wpex' ),
                    'param_name'    => 'icon',
                    'admin_label'   => true,
                    'value'         => 'fa fa-info-circle',
                    'settings'      => array(
                        'emptyIcon'     => true,
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
                    'type'          => 'textfield',
                    'heading'       => __( 'Icon Font Alternative Classes', 'wpex' ),
                    'param_name'    => 'icon_alternative_classes',
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
                    'param_name'    => 'icon_background',
                    'group'         => __( 'Icon', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Icon Size In Pixels', 'wpex' ),
                    'param_name'        => 'icon_size',
                    'group'             => __( 'Icon', 'wpex' ),
                    'description'       => __( 'Please enter a px value.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Icon Border Radius', 'wpex' ),
                    'param_name'        => 'icon_border_radius',
                    'description'       => __( 'Please enter a px value.', 'wpex' ),
                    'group'             => __( 'Icon', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Fixed Icon Width', 'wpex' ),
                    'param_name'        => 'icon_width',
                    'description'       => __( 'Please enter a px value.', 'wpex' ),
                    'group'             => __( 'Icon', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Fixed Icon Height', 'wpex' ),
                    'param_name'        => 'icon_height',
                    'description'       => __( 'Please enter a px value.', 'wpex' ),
                    'group'             => __( 'Icon', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),

                // Icon
                array(
                    'type'          => 'attach_image',
                    'heading'       => __( 'Icon Image Alternative', 'wpex' ),
                    'param_name'    => 'image',
                    'group'         => __( 'Image', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Icon Image Alternative Width', 'wpex' ),
                    'param_name'    => 'image_width',
                    'description'   => __( 'Please enter a px value.', 'wpex' ),
                    'group'         => __( 'Image', 'wpex' ),
                ),

                // Heading
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Heading', 'wpex' ),
                    'param_name'    => 'heading',
                    'value'         => 'Sample Heading',
                    'group'         => __( 'Heading', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Heading Font Color', 'wpex' ),
                    'param_name'    => 'heading_color',
                    'group'         => __( 'Heading', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Heading Type', 'wpex' ),
                    'param_name'        => 'heading_type',
                    'value'     => array(
                        __( 'Default', 'wpex' ) => '',
                        'h2'                    => 'h2',
                        'h3'                    => 'h3',
                        'h4'                    => 'h4',
                        'h5'                    => 'h5',
                        'div'                   => 'div',
                        'span'                  => 'span',
                    ),
                    'group'             => __( 'Heading', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Heading Font Weight', 'wpex' ),
                    'param_name'        => 'heading_weight',
                    'value'             => vcex_font_weights(),
                    'std'               => '',
                    'group'             => __( 'Heading', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Heading Text Transform', 'wpex' ),
                    'param_name'        => 'heading_transform',
                    'std'               => '',
                    'group'             => __( 'Heading', 'wpex' ),
                    'value'             => vcex_text_transforms(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Heading Font Size', 'wpex' ),
                    'param_name'        => 'heading_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'             => __( 'Heading', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Heading Letter Spacing', 'wpex' ),
                    'param_name'        => 'heading_letter_spacing',
                    'description'       => __( 'Please enter a px value.', 'wpex' ),
                    'group'             => __( 'Heading', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Heading Bottom Margin', 'wpex' ),
                    'param_name'        => 'heading_bottom_margin',
                    'description'       => __( 'Please enter a px value.', 'wpex' ),
                    'group'             => __( 'Heading', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),


                // Content
                array(
                    'type'          => 'textarea_html',
                    'holder'        => 'div',
                    'heading'       => __( 'Content', 'wpex' ),
                    'param_name'    => 'content',
                    'value'         => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                    'group'         => __( 'Content', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Content Font Size', 'wpex' ),
                    'param_name'    => 'font_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'         => __( 'Content', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Content Color', 'wpex' ),
                    'param_name'    => 'font_color',
                    'group'         => __( 'Content', 'wpex' ),
                ),

                // URL
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'URL', 'wpex' ),
                    'param_name'    => 'url',
                    'group'         => __( 'URL', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'URL Target', 'wpex' ),
                    'param_name'    => 'url_target',
                     'value'        => array(
                        __( 'Self', 'wpex' )    => '',
                        __( 'Blank', 'wpex' )   => '_blank',
                        __( 'Local', 'wpex' )   => 'local',
                    ),
                    'group'         => __( 'URL', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'URL Rel', 'wpex' ),
                    'param_name'    => 'url_rel',
                    'value'         => array(
                        __( 'None', 'wpex' )        => '',
                        __( 'Nofollow', 'wpex' )    => 'nofollow',
                    ),
                    'group'         => __( 'URL', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Link Container Wrap', 'wpex' ),
                    'param_name'    => 'url_wrap',
                    'value'         => array(
                        __( 'Default', 'wpex' ) => '',
                        __( 'False', 'wpex' )   => 'false',
                        __( 'True', 'wpex' )    => 'true',
                    ),
                    'group'         => __( 'URL', 'wpex' ),
                    'description'   => __( 'Apply the link to the entire wrapper?', 'wpex' ),
                ),

                // Design
                array(
                    'type'          => 'css_editor',
                    'heading'       => __( 'CSS', 'wpex' ),
                    'param_name'    => 'css',
                    'description'   => __( 'If any of these are defined it will add a new wrapper around your icon box with the custom CSS applied to it.', 'wpex' ),
                    'group'         => __( 'Design', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Border Radius', 'wpex' ),
                    'param_name'    => 'border_radius',
                    'description'   => __( 'Please enter a px value.', 'wpex' ),
                    'group'         => __( 'Design', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Hover: background', 'wpex' ),
                    'param_name'    => 'hover_background',
                    'description'   => __( 'Will add a hover background color to your entire icon box or replace the current hover color for specific icon box styles.', 'wpex' ),
                    'group'         => __( 'Design', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'White Text On Hover', 'wpex' ),
                    'param_name'    => 'hover_white_text',
                    'value'         => array(
                        __( 'False', 'wpex' )   => '',
                        __( 'True', 'wpex' )    => 'true',
                    ),
                    'description'   => __( 'If enabled your heading, content and links within your content will all turn white on hover.', 'wpex' ),
                    'group'         => __( 'Design', 'wpex' ),
                ),
            )
        ) );

    }
}
add_action( 'vc_before_init', 'vcex_icon_box_shortcode_vc_map' );
<?php
/**
 * Registers the list item shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_list_item extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_list_item.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_list_item_shortcode_vc_map' ) ) {
    function vcex_list_item_shortcode_vc_map() {
        vc_map( array(
            'name'                  => __( 'List Item', 'wpex' ),
            'description'           => __( 'Font Icon list item', 'wpex' ),
            'base'                  => 'vcex_list_item',
            'icon'                  => 'vcex-list-item',
            'category'              => WPEX_THEME_BRANDING,
            'params'                => array(

                // General
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Unique Id', 'wpex' ),
                    'description'   => __( 'Give your main element a unique ID.', 'wpex' ),
                    'param_name'    => 'unique_id',
                    'group'         => __( 'General', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Custom Classes', 'wpex' ),
                    'description'   => __( 'Add additonal classes to the main element.', 'wpex' ),
                    'param_name'    => 'classes',
                    'group'         => __( 'General', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Visibility', 'wpex' ),
                    'param_name'        => 'visibility',
                    'value'             => vcex_visibility(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'group'             => __( 'General', 'wpex' ),

                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Appear Animation', 'wpex' ),
                    'param_name'        => 'css_animation',
                    'value'             => vcex_css_animations(),
                    'group'             => __( 'General', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'General', 'wpex' ),

                ),

                // Text
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Content', 'wpex' ),
                    'param_name'    => 'content',
                    'admin_label'   => true,
                    'value'         => __( 'This is a pretty list item', 'wpex' ),
                    'group'         => __( 'Text', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Font Color', 'wpex' ),
                    'param_name'    => 'font_color',
                    'group'         => __( 'Text', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Custom Font Size', 'wpex' ),
                    'param_name'    => 'font_size',
                    'group'         => __( 'Text', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Text Align', 'wpex' ),
                    'param_name'    => 'text_align',
                    'value'         => vcex_alignments(),
                    'group'         => __( 'Text', 'wpex' ),
                ),

                // Icon
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Icon library', 'wpex' ),
                    'param_name'    => 'icon_type',
                    'description'   => __( 'Select icon library.', 'wpex' ),
                    'value'         => array(
                        __( 'Font Awesome', 'wpex' ) => 'fontawesome',
                        __( 'Open Iconic', 'wpex' )  => 'openiconic',
                        __( 'Typicons', 'wpex' )     => 'typicons',
                        __( 'Entypo', 'wpex' )       => 'entypo',
                        __( 'Linecons', 'wpex' )     => 'linecons',
                        __( 'Pixel', 'wpex' )        => 'pixelicons',
                    ),
                    'group'         => __( 'Icon', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon', 'wpex' ),
                    'param_name'    => 'icon',
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
                    'heading'       => __( 'Icon Right Margin', 'wpex' ),
                    'param_name'    => 'margin_right',
                    'group'         => __( 'Icon', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Icon Color', 'wpex' ),
                    'param_name'    => 'color',
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
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'group'             => __( 'Icon', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Icon Border Radius', 'wpex' ),
                    'param_name'        => 'icon_border_radius',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'Icon', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Icon Width', 'wpex' ),
                    'param_name'        => 'icon_width',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'group'             => __( 'Icon', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Icon Height', 'wpex' ),
                    'param_name'        => 'icon_height',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'Icon', 'wpex' ),
                ),

                // Link
                array(
                    'type'          => 'vc_link',
                    'heading'       => __( 'Link', 'wpex' ),
                    'param_name'    => 'link',
                    'group'         => __( 'Link', 'wpex' ),
                ),

                // Design
                array(
                    'type'          => 'css_editor',
                    'heading'       => __( 'CSS', 'wpex' ),
                    'param_name'    => 'css',
                    'description'   => __( 'If any of these are defined it will add a new wrapper around your icon box with the custom CSS applied to it.', 'wpex' ),
                    'group'         => __( 'Design', 'wpex' ),
                ),

            )
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_list_item_shortcode_vc_map' );
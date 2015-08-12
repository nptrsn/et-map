<?php
/**
 * Registers the button shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_button extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_button.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_button_shortcode_vc_map' ) ) {
    function vcex_button_shortcode_vc_map() {

        vc_map( array(
            'name'                  => __( 'Total Button', 'wpex' ),
            'description'           => __( 'Eye catching button', 'wpex' ),
            'base'                  => 'vcex_button',
            'category'              => WPEX_THEME_BRANDING,
            'icon'                  => 'vcex-total-button',
            'params'                => array(

                // General
                array(
                    'type'          => 'textfield',
                    'admin_label'   => true,
                    'heading'       => __( 'Unique Id', 'wpex' ),
                    'description'   => __( 'Give your main element a unique ID.', 'wpex' ),
                    'param_name'    => 'unique_id',
                ),
                array(
                    'type'          => 'textfield',
                    'admin_label'   => true,
                    'heading'       => __( 'Classes', 'wpex' ),
                    'description'   => __( 'Add additonal classes to the main element.', 'wpex' ),
                    'param_name'    => 'classes',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Visibility', 'wpex' ),
                    'param_name'        => 'visibility',
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                    'value'             => vcex_visibility(),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Appear Animation', 'wpex'),
                    'param_name'        => 'css_animation',
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                    'value'             => vcex_css_animations(),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Hover Animation', 'wpex'),
                    'param_name'        => 'hover_animation',
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                    'value'             => vcex_hover_animations(),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'URL', 'wpex' ),
                    'param_name'    => 'url',
                    'value'         => 'http://www.google.com/',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Text', 'wpex' ),
                    'param_name'    => 'content',
                    'admin_label'   => true,
                    'std'           => 'Button Text',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Link Title', 'wpex' ),
                    'param_name'    => 'title',
                    'value'         => 'Visit Site',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Link Target', 'wpex' ),
                    'param_name'    => 'target',
                    'value'         => array(
                        __( 'Self', 'wpex' )    => '',
                        __( 'Blank', 'wpex' )   => 'blank',
                        __( 'Local', 'wpex' )   => 'local',
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Link Rel', 'wpex' ),
                    'param_name'    => 'rel',
                    'value'         => array(
                        __( 'None', 'wpex' )        => '',
                        __( 'Nofollow', 'wpex' )    => 'nofollow',
                    ),
                ),

                // Design
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Style', 'wpex' ),
                    'param_name'    => 'style',
                    'std'           => '',
                    'value'         => vcex_button_styles(),
                    'group'         => __( 'Design', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Layout', 'wpex' ),
                    'param_name'        => 'layout',
                    'value'             => array(
                        __( 'Inline', 'wpex' )                      => '',
                        __( 'Block', 'wpex' )                       => 'block',
                        __( 'Expanded (fit container)', 'wpex' )    => 'expanded',
                    ),
                    'group'             => __( 'Design', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Align', 'wpex' ),
                    'param_name'        => 'align',
                    'value'             => vcex_alignments(),
                    'group'             => __( 'Design', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Background', 'wpex' ),
                    'param_name'        => 'color',
                    'std'               => '',
                    'value'             => vcex_button_colors(),
                    'group'             => __( 'Design', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Background', 'wpex' ),
                    'param_name'    => 'custom_background',
                    'group'         => __( 'Design', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Background: Hover', 'wpex' ),
                    'param_name'    => 'custom_hover_background',
                    'group'         => __( 'Design', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Color', 'wpex' ),
                    'param_name'    => 'custom_color',
                    'group'         => __( 'Design', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Color: Hover', 'wpex' ),
                    'param_name'    => 'custom_hover_color',
                    'group'         => __( 'Design', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Size', 'wpex' ),
                    'param_name'    => 'size',
                    'std'           => '',
                    'value'         => array(
                        __( 'Default', 'wpex' ) => '',
                        __( 'Small', 'wpex' )   => 'small',
                        __( 'Medium', 'wpex' )  => 'medium',
                        __( 'Large', 'wpex' )   => 'large',
                    ),
                    'group'         => __( 'Design', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Font Size', 'wpex' ),
                    'param_name'        => 'font_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'             => __( 'Design', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Letter Spacing', 'wpex' ),
                    'param_name'        => 'letter_spacing',
                    'description'       => __( 'Please enter a px value.', 'wpex' ),
                    'group'             => __( 'Design', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Text Transform', 'wpex' ),
                    'param_name'        => 'text_transform',
                    'group'             => __( 'Design', 'wpex' ),
                    'value'             => vcex_text_transforms(),
                    'std'               => '',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Font Weight', 'wpex' ),
                    'param_name'        => 'font_weight',
                    'description'       => __( 'Note: Not all font families support every font weight.', 'wpex' ),
                    'value'             => vcex_font_weights(),
                    'std'               => '',
                    'group'             => __( 'Design', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Custom Width', 'wpex' ),
                    'param_name'        => 'width',
                    'description'       => __( 'Please use a pixel or percentage value.', 'wpex' ),
                    'group'             => __( 'Design', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Border Radius', 'wpex' ),
                    'param_name'        => 'border_radius',
                    'description'       => __( 'Please enter a px value.', 'wpex' ),
                    'group'             => __( 'Design', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Padding', 'wpex' ),
                    'param_name'        => 'font_padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'             => __( 'Design', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Margin', 'wpex' ),
                    'param_name'        => 'margin',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'             => __( 'Design', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),

                // Lightbox
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Lightbox', 'wpex' ),
                    'param_name'    => 'lightbox',
                    'value'         => Array(
                        __( 'No', 'wpex' )  => '',
                        __( 'Yes', 'wpex' ) => 'true',
                    ),
                    'group'         => __( 'Lightbox', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Type', 'wpex' ),
                    'param_name'    => 'lightbox_type',
                    'value'         => array(
                        __( 'Auto Detect - slow', 'wpex' )  => '',
                        __( 'Image', 'wpex' )               => 'image',
                        __( 'Video', 'wpex' )               => 'video_embed',
                        __( 'HTML5', 'wpex' )               => 'html5',
                        __( 'Quicktime', 'wpex' )           => 'quicktime',
                    ),
                    'description'   => __( 'Auto detect depends on the iLightbox API, so by choosing your type it speeds things up and you also allows for HTTPS support.', 'wpex' ),
                    'group'         => __( 'Lightbox', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'lightbox',
                        'value'     => 'true',
                    ),
                ),
                array(
                    'type'          => 'attach_image',
                    'heading'       => __( 'Lightbox Image', 'wpex' ),
                    'param_name'    => 'lightbox_image',
                    'dependency'    => Array(
                        'element'   => 'lightbox_type',
                        'value'     => 'image',
                    ),
                    'group'         => __( 'Lightbox', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'HTML5 Webm URL', 'wpex' ),
                    'param_name'    => 'lightbox_video_html5_webm',
                    'description'   => __( 'Enter the URL to a video, SWF file, flash file or a website URL to open in lightbox.', 'wpex' ),
                    'group'         => __( 'Lightbox', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'lightbox_type',
                        'value'     => 'html5',
                    ),
                ),
                array(
                    'type'          => 'attach_image',
                    'heading'       => __( 'Lightbox HTML5 Poster Image', 'wpex' ),
                    'param_name'    => 'lightbox_poster_image',
                    'dependency'    => Array(
                        'element'   => 'lightbox_type',
                        'value'     => 'html5',
                    ),
                    'group'         => __( 'Lightbox', 'wpex' ),
                ),

                //Icons
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Icon library', 'wpex' ),
                    'param_name'    => 'icon_type',
                    'description'   => __( 'Select icon library.', 'wpex' ),
                    'std'           => 'fontawesome',
                    'value'         => array(
                        __( 'Font Awesome', 'wpex' ) => 'fontawesome',
                        __( 'Open Iconic', 'wpex' )  => 'openiconic',
                        __( 'Typicons', 'wpex' )     => 'typicons',
                        __( 'Entypo', 'wpex' )       => 'entypo',
                        __( 'Linecons', 'wpex' )     => 'linecons',
                        __( 'Pixel', 'wpex' )        => 'pixelicons',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),

                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'wpex' ),
                    'param_name'    => 'icon_left',
                    'admin_label'   => true,
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'fontawesome',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'wpex' ),
                    'param_name'    => 'icon_left_openiconic',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'openiconic',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'openiconic',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'wpex' ),
                    'param_name'    => 'icon_left_typicons',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'typicons',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'typicons',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'wpex' ),
                    'param_name'    => 'icon_left_entypo',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'entypo',
                        'iconsPerPage'  => 300,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'entypo',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'wpex' ),
                    'param_name'    => 'icon_left_linecons',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'linecons',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'linecons',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'wpex' ),
                    'param_name'    => 'icon_left_pixelicons',
                    'settings'      => array(
                        'emptyIcon' => true,
                        'type'      => 'pixelicons',
                        'source'    => vcex_pixel_icons(),
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'pixelicons',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'wpex' ),
                    'param_name'    => 'icon_right',
                    'admin_label'   => true,
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'fontawesome',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'wpex' ),
                    'param_name'    => 'icon_right_openiconic',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'openiconic',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'openiconic',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'wpex' ),
                    'param_name'    => 'icon_right_typicons',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'typicons',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'typicons',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'wpex' ),
                    'param_name'    => 'icon_right_entypo',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'entypo',
                        'iconsPerPage'  => 300,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'entypo',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'wpex' ),
                    'param_name'    => 'icon_right_linecons',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'linecons',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'linecons',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'wpex' ),
                    'param_name'    => 'icon_right_pixelicons',
                    'settings'      => array(
                        'emptyIcon' => true,
                        'type'      => 'pixelicons',
                        'source'    => vcex_pixel_icons(),
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'pixelicons',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),


                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Left Icon: Right Padding', 'wpex' ),
                    'param_name'    => 'icon_left_padding',
                    'group'         => __( 'Icons', 'wpex' ),
                ),

                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Right Icon: Left Padding', 'wpex' ),
                    'param_name'    => 'icon_right_padding',
                    'group'         => __( 'Icons', 'wpex' ),
                ),
            )
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_button_shortcode_vc_map' );
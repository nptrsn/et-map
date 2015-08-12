<?php
/**
 * Registers the teaser shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_teaser extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_teaser.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_teaser_shortcode_vc_map' ) ) {
    function vcex_teaser_shortcode_vc_map() {
        vc_map( array(
            'name'                  => __( 'Teaser Box', 'wpex' ),
            'description'           => __( 'A teaser content box', 'wpex' ),
            'base'                  => 'vcex_teaser',
            'category'              => WPEX_THEME_BRANDING,
            'icon'                  => 'vcex-teaser',
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
                    'heading'       => __( 'Custom Classes', 'wpex' ),
                    'description'   => __( 'Add additonal classes to the main element.', 'wpex' ),
                    'param_name'    => 'classes',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Visibility', 'wpex' ),
                    'param_name'        => 'visibility',
                    'value'             => vcex_visibility(),
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
                    'heading'       => __( 'Text Align', 'wpex' ),
                    'param_name'    => 'text_align',
                    'value'         => array(
                        __( 'Default', 'wpex' ) => '',
                        __( 'Center', 'wpex' )  => 'center',
                        __( 'Left', 'wpex' )    => 'left',
                        __( 'Right', 'wpex' )   => 'right',
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Style', 'wpex' ),
                    'param_name'    => 'style',
                    'value'         => array(
                        __( 'Default', 'wpex' )             => '',
                        __( 'Plain', 'wpex' )               => 'one',
                        __( 'Boxed 1 - Legacy', 'wpex' )    => 'two',
                        __( 'Boxed 2 - Legacy', 'wpex' )    => 'three',
                        __( 'Outline - Legacy', 'wpex' )    => 'four',
                    ),
                    'description'   => __( 'For full control select the "Default" style then go to the "Design Options" tab to style the teaser box to your liking.', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Padding', 'wpex' ),
                    'param_name'    => 'padding',
                    'dependency'    => array(
                        'element'   => 'style',
                        'value'     => array( 'two' ),
                    ),
                    'description'   => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Background Color', 'wpex' ),
                    'param_name'    => 'background',
                    'dependency'    => array(
                        'element'   => 'style',
                        'value'     => array( 'two', 'three' ),
                    ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Border Color', 'wpex' ),
                    'param_name'    => 'border_color',
                    'dependency'    => array(
                        'element'   => 'style',
                        'value'     => array( 'two', 'three', 'four' ),
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Border Radius', 'wpex' ),
                    'param_name'    => 'border_radius',
                    'dependency'    => array(
                        'element'   => 'style',
                        'value'     => array( 'two', 'three', 'four' ),
                    ),
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
                    'heading'       => __( 'Heading Color', 'wpex' ),
                    'param_name'    => 'heading_color',
                    'group'         => __( 'Heading', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Heading Type', 'wpex' ),
                    'param_name'        => 'heading_type',
                     'value'            => array(
                        __( 'h2', 'wpex' )    => 'h2',
                        __( 'h3', 'wpex' )    => 'h3',
                        __( 'h4', 'wpex' )    => 'h4',
                        __( 'h5', 'wpex' )    => 'h5',
                    ),
                    'group'         => __( 'Heading', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Heading Font Weight', 'wpex' ),
                    'param_name'        => 'heading_weight',
                    'std'               => '',
                    'value'             => vcex_font_weights(),
                    'group'             => __( 'Heading', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Heading Text Transform', 'wpex' ),
                    'param_name'        => 'heading_transform',
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
                    'heading'           => __( 'Heading Margin', 'wpex' ),
                    'param_name'        => 'heading_margin',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'             => __( 'Heading', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Heading Letter Spacing', 'wpex' ),
                    'param_name'        => 'heading_letter_spacing',
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
                    'value'         => __( 'Don\'t forget to change this dummy text in your page editor for this lovely teaser box.', 'wpex' ),
                    'group'         => __( 'Content', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Content Margin', 'wpex' ),
                    'param_name'        => 'content_margin',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'             => __( 'Content', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Content Padding', 'wpex' ),
                    'param_name'        => 'content_padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'             => __( 'Content', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Content Font Size', 'wpex' ),
                    'param_name'        => 'content_font_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'             => __( 'Content', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Content Font Weight', 'wpex' ),
                    'param_name'    => 'content_font_weight',
                    'description'   => __( 'Note: Not all font families support every font weight.', 'wpex' ),
                    'std'           => '',
                    'value'         => vcex_font_weights(),
                    'group'         => __( 'Content', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Content Font Color', 'wpex' ),
                    'param_name'    => 'content_color',
                    'group'         => __( 'Content', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Content Background', 'wpex' ),
                    'param_name'    => 'content_background',
                    'group'         => __( 'Content', 'wpex' ),
                ),
                
                // Media
                array(
                    'type'          => 'attach_image',
                    'heading'       => __( 'Image', 'wpex' ),
                    'param_name'    => 'image',
                    'group'         => __( 'Media', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Video link', 'wpex' ),
                    'param_name'    => 'video',
                    'description'   => __( 'Enter in a video URL that is compatible with WordPress\'s built-in oEmbed feature.', 'wpex' ),
                    'group'         => __( 'Media', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Style', 'wpex' ),
                    'param_name'    => 'img_style',
                    'value'         => array(
                        __( 'Default', 'wpex' ) => '',
                        __( 'Stretch', 'wpex' ) => 'stretch',
                    ),
                    'group'         => __( 'Media', 'wpex' ),
                    'dependency'    => array(
                        'element'   => 'image',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Image Crop Width', 'wpex' ),
                    'param_name'        => 'img_width',
                    'group'             => __( 'Media', 'wpex' ),
                    'dependency'        => array(
                        'element'   => 'image',
                        'not_empty' => true,
                    ),
                    'description'       => __( 'Enter a width in pixels.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Image Crop Height', 'wpex' ),
                    'param_name'        => 'img_height',
                    'description'       => __( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'wpex' ),
                    'group'             => __( 'Media', 'wpex' ),
                    'dependency'        => array(
                        'element'   => 'image',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Image Filter', 'wpex' ),
                    'param_name'        => 'img_filter',
                    'value'             => vcex_image_filters(),
                    'group'             => __( 'Media', 'wpex' ),
                    'dependency'        => array(
                        'element'   => 'image',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'CSS3 Image Hover', 'wpex' ),
                    'param_name'        => 'img_hover_style',
                    'value'             => vcex_image_hovers(),
                    'group'             => __( 'Media', 'wpex' ),
                    'dependency'        => array(
                        'element'   => 'image',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Image Rendering', 'wpex' ),
                    'param_name'        => 'img_rendering',
                    'value'             => vcex_image_rendering(),
                    'group'             => __( 'Media', 'wpex' ),
                    'dependency'        => array(
                        'element'   => 'image',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),

                // Link
                array(
                    'type'          => 'vc_link',
                    'heading'       => __( 'URL', 'wpex' ),
                    'param_name'    => 'url',
                    'group'         => __( 'Link', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Link: Local Scroll', 'wpex' ),
                    'param_name'    => 'url_local_scroll',
                    'value'         => array(
                        __( 'False', 'wpex' )   => '',
                        __( 'True', 'wpex' )    => 'true',
                    ),
                    'group'         => __( 'Link', 'wpex' ),
                ),

                // CSS
                array(
                    'type'          => 'css_editor',
                    'heading'       => __( 'CSS', 'wpex' ),
                    'param_name'    => 'css',
                    'group'         => __( 'Design Options', 'wpex' ),
                ),
            )
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_teaser_shortcode_vc_map' );
<?php
/**
 * Registers the feature shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_feature_box extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_feature_box.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_feature_box_shortcode_vc_map' ) ) {
    function vcex_feature_box_shortcode_vc_map() {
        vc_map( array(
            'name'                  => __( 'Feature Box', 'wpex' ),
            'description'           => __( 'A feature content box.', 'wpex' ),
            'base'                  => 'vcex_feature_box',
            'category'              => WPEX_THEME_BRANDING,
            'icon'                  => 'vcex-feature-box',
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
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',

                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Appear Animation', 'wpex'),
                    'param_name'        => 'css_animation',
                    'value'             => vcex_css_animations(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',

                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Style', 'wpex' ),
                    'param_name'    => 'style',
                    'value'         => array(
                        __( 'Left Content - Right Image', 'wpex' )  => 'left-content-right-image',
                        __( 'Left Image - Right Content', 'wpex' )  => 'left-image-right-content',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Alignment', 'wpex' ),
                    'param_name'    => 'text_align',
                    'value'         => array(
                        __( 'Default', 'wpex' ) => '',
                        __( 'Center', 'wpex' )  => 'center',
                        __( 'Left', 'wpex' )    => 'left',
                        __( 'Right', 'wpex' )   => 'right',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Padding', 'wpex' ),
                    'param_name'        => 'padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Border', 'wpex' ),
                    'description'       => __( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'wpex' ),
                    'param_name'        => 'border',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Background', 'wpex' ),
                    'param_name'    => 'background',
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
                        __( 'h2', 'wpex' )  => 'h2',
                        __( 'h3', 'wpex' )  => 'h3',
                        __( 'h4', 'wpex' )  => 'h4',
                        __( 'h5', 'wpex' )  => 'h5',
                        __( 'div', 'wpex' ) => 'div',
                    ),
                    'description'       => __( 'Select your heading type for SEO purposes.', 'wpex' ),
                    'group'             => __( 'Heading', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Heading Font Weight', 'wpex' ),
                    'param_name'        => 'heading_weight',
                    'description'       => __( 'Note: Not all font families support every font weight.', 'wpex' ),
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
                    'std'               => '',
                    'description'       => __( 'Select a custom text transform to override the default.', 'wpex' ),
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
                    'heading'           => __( 'Heading Margin', 'wpex' ),
                    'param_name'        => 'heading_margin',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'             => __( 'Heading', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'vc_link',
                    'heading'       => __( 'Heading URL', 'wpex' ),
                    'param_name'    => 'heading_url',
                    'group'         => __( 'Heading', 'wpex' ),
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
                    'heading'       => __( 'Content Padding', 'wpex' ),
                    'param_name'    => 'content_padding',
                    'description'   => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'         => __( 'Content', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Content Font Size', 'wpex' ),
                    'param_name'    => 'content_font_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'         => __( 'Content', 'wpex' ),
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
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Content Background', 'wpex' ),
                    'param_name'    => 'content_background',
                    'group'         => __( 'Content', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Content Font Color', 'wpex' ),
                    'param_name'    => 'content_color',
                    'group'         => __( 'Content', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),

                // Image
                array(
                    'type'          => 'attach_image',
                    'heading'       => __( 'Image', 'wpex' ),
                    'param_name'    => 'image',
                    'group'         => __( 'Image', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Equal Heights?', 'wpex' ),
                    'param_name'    => 'equal_heights',
                    'value'         => array(
                        __( 'No', 'wpex' )  => '',
                        __( 'Yes', 'wpex' ) => 'true',
                    ),
                    'description'   => __( 'Keeps the image column the same height as your content.', 'wpex' ),
                    'group'         => __( 'Image', 'wpex' ),
                ),
                array(
                    'type'          => 'vc_link',
                    'heading'       => __( 'Image URL', 'wpex' ),
                    'param_name'    => 'image_url',
                    'group'         => __( 'Image', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Lightbox Type', 'wpex' ),
                    'param_name'    => 'image_lightbox',
                    'value'         => array(
                        __( 'None', 'wpex' )                => '',
                        __( 'Self', 'wpex' )                => 'image',
                        __( 'URL', 'wpex' )                 => 'url',
                        __( 'Auto Detect - slow', 'wpex' )  => 'auto-detect',
                        __( 'Video', 'wpex' )               => 'video_embed',
                        __( 'HTML5', 'wpex' )               => 'html5',
                        __( 'Quicktime', 'wpex' )           => 'quicktime',
                    ),
                    'group'         => __( 'Image', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Size', 'wpex' ),
                    'param_name'    => 'img_size',
                    'std'           => 'wpex_custom',
                    'value'         => vcex_image_sizes(),
                    'group'         => __( 'Image', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Crop Location', 'wpex' ),
                    'param_name'    => 'img_crop',
                    'std'           => 'center-center',
                    'value'         => vcex_image_crop_locations(),
                    'dependency'    => array(
                        'element'   => 'img_size',
                        'value'     => 'wpex_custom',
                    ),
                    'group'         => __( 'Image', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Image Width', 'wpex' ),
                    'param_name'        => 'img_width',
                    'description'       => __( 'Enter a width in pixels.', 'wpex' ),
                    'group'             => __( 'Image', 'wpex' ),
                    'dependency'        => array(
                        'element'   => 'img_size',
                        'value'     => 'wpex_custom',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Image Height', 'wpex' ),
                    'param_name'        => 'img_height',
                    'description'       => __( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'wpex' ),
                    'group'             => __( 'Image', 'wpex' ),
                    'dependency'        => array(
                        'element'   => 'img_size',
                        'value'     => 'wpex_custom',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Border Radius', 'wpex' ),
                    'param_name'    => 'img_border_radius',
                    'description'   => __( 'Please enter a px value.', 'wpex' ),
                    'group'         => __( 'Image', 'wpex' ),
                    'dependency'    => array(
                        'element'   => 'image',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'CSS3 Image Hover', 'wpex' ),
                    'param_name'    => 'img_hover_style',
                    'value'         => vcex_image_hovers(),
                    'group'         => __( 'Image', 'wpex' ),
                    'dependency'    => array(
                        'element'   => 'image',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Filter', 'wpex' ),
                    'param_name'    => 'img_filter',
                    'value'         => vcex_image_filters(),
                    'group'         => __( 'Image', 'wpex' ),
                    'dependency'    => array(
                        'element'   => 'image',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Rendering', 'wpex' ),
                    'param_name'    => 'img_rendering',
                    'value'         => vcex_image_rendering(),
                    'group'         => __( 'Image', 'wpex' ),
                    'dependency'    => array(
                        'element'   => 'image',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),

                // Video
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Video link', 'wpex' ),
                    'param_name'    => 'video',
                    'description'   => __('Enter a URL that is compatible with WP\'s built-in oEmbed feature. ', 'wpex' ),
                    'group'         => __( 'Video', 'wpex' ),
                ),

                // Widths
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Content Width', 'wpex' ),
                    'param_name'    => 'content_width',
                    'value'         => '50%',
                    'group'         => __( 'Widths', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Image Width', 'wpex' ),
                    'param_name'    => 'media_width',
                    'value'         => '50%',
                    'group'         => __( 'Widths', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Tablet Widths', 'wpex' ),
                    'param_name'    => 'tablet_widths',
                    'value'         => array(
                        __( 'Inherit', 'wpex' )     => '',
                        __( 'Full-Width', 'wpex' )  => 'fullwidth',
                    ),
                    'group'         => __( 'Widths', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Phone Widths', 'wpex' ),
                    'param_name'    => 'phone_widths',
                    'value'         => array(
                        __( 'Inherit', 'wpex' )     => '',
                        __( 'Full-Width', 'wpex' )  => 'fullwidth',
                    ),
                    'group'         => __( 'Widths', 'wpex' ),
                ),

            )
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_feature_box_shortcode_vc_map' );
<?php
/**
 * Registers the Image Carousel shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_image_carousel extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_image_carousel.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_image_carousel_shortcode_vc_map' ) ) {
    function vcex_image_carousel_shortcode_vc_map() {
    $vc_img_rendering_url = 'https://developer.mozilla.org/en-US/docs/Web/CSS/image-rendering';
        vc_map( array(
            'name'                  => __( 'Image Carousel', 'wpex' ),
            'description'           => __( 'Image based jQuery carousel.', 'wpex' ),
            'base'                  => 'vcex_image_carousel',
            'category'              => WPEX_THEME_BRANDING,
            'icon'                  => 'vcex-image-carousel',
            'params'                => array(

                // Gallery
                array(
                    'type'          => 'attach_images',
                    'admin_label'   => true,
                    'heading'       => __( 'Attach Images', 'wpex' ),
                    'param_name'    => 'image_ids',
                    'group'         => __( 'Gallery', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'admin_label'   => true,
                    'heading'       => __( 'Randomize Images', 'wpex' ),
                    'param_name'    => 'randomize_images',
                    'value'         => array(
                        __( 'False', 'wpex' )   => '',
                        __( 'True', 'wpex' )    => 'true',
                    ),
                    'group'         => __( 'Gallery', 'wpex' ),
                ),

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
                    'heading'           => __( 'Style', 'wpex' ),
                    'param_name'        => 'style',
                    'value'             => array(
                        __( 'Default', 'wpex' )     => '',
                        __( 'No Margins', 'wpex' )  => 'no-margins',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Display Arrows?', 'wpex' ),
                    'param_name'        => 'arrows',
                    'value'             => array(
                        __( 'True', 'wpex' )    => 'true',
                        __( 'False', 'wpex' )   => 'false',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Items To Display', 'wpex' ),
                    'param_name'        => 'items',
                    'value'             => '4',
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Items To Scrollby', 'wpex' ),
                    'param_name'        => 'items_scroll',
                    'value'             => '',
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Margin Between Items', 'wpex' ),
                    'param_name'        => 'items_margin',
                    'value'             => '15',
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Auto Play', 'wpex' ),
                    'param_name'        => 'auto_play',
                    'value'             => array(
                        __( 'True', 'wpex' )    => 'true',
                        __( 'False', 'wpex' )   => 'false',
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Infinite Loop', 'wpex' ),
                    'param_name'        => 'infinite_loop',
                    'value'             => array(
                        __( 'True', 'wpex' )    => 'true',
                        __( 'False', 'wpex' )   => 'false',
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Center Item', 'wpex' ),
                    'param_name'        => 'center',
                    'value'             => array(
                        __( 'False', 'wpex' )   => 'false',
                        __( 'True', 'wpex' )    => 'true',
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Timeout Duration in milliseconds', 'wpex' ),
                    'param_name'    => 'timeout_duration',
                    'value'         => '5000',
                    'dependency'    => Array(
                        'element'   => 'auto_play',
                        'value'     => 'true'
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Tablet: Items To Display', 'wpex' ),
                    'param_name'    => 'tablet_items',
                    'value'         => '3',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Mobile Landscape: Items To Display', 'wpex' ),
                    'param_name'    => 'mobile_landscape_items',
                    'value'         => '2',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Mobile Portrait: Items To Display', 'wpex' ),
                    'param_name'    => 'mobile_portrait_items',
                    'value'         => '1',
                ),

                // Title
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Title?', 'wpex' ),
                    'param_name'    => 'title',
                    'value'         => Array(
                        __( 'False', 'wpex' )   => '',
                        __( 'True', 'wpex' )    => 'yes',
                    ),
                    'group'         => __( 'Title', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Title Based On Image', 'wpex' ),
                    'param_name'    => 'title_type',
                    'value'         => array(
                        __( 'Default', 'wpex' )     => '',
                        __( 'Title', 'wpex' )       => 'title',
                        __( 'Alt', 'wpex' )         => 'alt',
                    ),
                    'group'         => __( 'Title', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'title',
                        'value'     => array( 'yes' )
                    ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Title Text Color', 'wpex' ),
                    'param_name'    => 'content_heading_color',
                    'group'         => __( 'Title', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'title',
                        'value'     => array( 'yes' )
                    ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Title Font Weight', 'wpex' ),
                    'param_name'        => 'content_heading_weight',
                    'description'       => __( 'Note: Not all font families support every font weight.', 'wpex' ),
                    'std'           => '',
                    'value'         => vcex_font_weights(),
                    'group'             => __( 'Title', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'dependency'    => Array(
                        'element'   => 'title',
                        'value'     => array( 'yes' )
                    ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Title Text Transform', 'wpex' ),
                    'param_name'        => 'content_heading_transform',
                    'value'             => vcex_text_transforms(),
                    'group'             => __( 'Title', 'wpex' ),
                    'description'       => __( 'Select a custom text transform to override the default.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'dependency'    => Array(
                        'element'   => 'title',
                        'value'     => array( 'yes' )
                    ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Title Font Size', 'wpex' ),
                    'param_name'        => 'content_heading_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'             => __( 'Title', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'dependency'    => Array(
                        'element'   => 'title',
                        'value'     => array( 'yes' )
                    ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Title Margin', 'wpex' ),
                    'param_name'        => 'content_heading_margin',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'             => __( 'Title', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'dependency'    => Array(
                        'element'   => 'title',
                        'value'     => array( 'yes' )
                    ),
                ),

                // Caption
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Caption', 'wpex' ),
                    'param_name'    => 'caption',
                    'value'         => Array(
                        __( 'True', 'wpex' )    => 'yes',
                        __( 'False', 'wpex' )   => 'false',
                    ),
                    'group'         => __( 'Caption', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Caption Text Color', 'wpex' ),
                    'param_name'    => 'content_color',
                    'group'         => __( 'Caption', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Caption Font Size', 'wpex' ),
                    'param_name'    => 'content_font_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'         => __( 'Caption', 'wpex' ),
                ),

                // Links
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Link', 'wpex' ),
                    'param_name'    => 'thumbnail_link',
                    'value'         => array(
                        __( 'None', 'wpex' )            => 'none',
                        __( 'Lightbox', 'wpex' )        => 'lightbox',
                        __( 'Custom Links', 'wpex' )    => 'custom_link',
                    ),
                    'group'         => __( 'Links', 'wpex' ),
                ),
                /*array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Gallery Lightbox', 'wpex' ),
                    'param_name'    => 'gallery_lightbox',
                    'value'         => array(
                        __( 'False', 'wpex' )   => '',
                        __( 'True', 'wpex' )    => true,
                    ),
                    'dependency'    => Array(
                        'element'   => 'thumbnail_link',
                        'value'     => array( 'lightbox' )
                    ),
                    'group'         => __( 'Links', 'wpex' ),
                ),*/
                array(
                    'type'          => 'exploded_textarea',
                    'heading'       => __( 'Custom links', 'wpex' ),
                    'param_name'    => 'custom_links',
                    'description'   => __( 'Enter links for each slide here. Divide links with linebreaks (Enter). For images without a link enter a # symbol. And don\'t forget to include the http:// at the front.', 'wpex'),
                    'dependency'    => Array(
                        'element'   => 'thumbnail_link',
                        'value'     => array( 'custom_link' )
                    ),
                    'group'         => __( 'Links', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Custom link target', 'wpex' ),
                    'param_name'        => 'custom_links_target',
                    'description'       => __( 'Select where to open custom links.', 'wpex'),
                    'dependency'        => Array(
                        'element'   => 'thumbnail_link',
                        'value'     => 'custom_link',
                    ),
                    'value'             => array(
                            __( 'Same window', 'wpex' ) => '',
                            __( 'New window', 'wpex' )  => '_blank'
                        ),
                    'group'         => __( 'Links', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Lightbox Skin', 'wpex' ),
                    'param_name'    => 'lightbox_skin',
                    'std'           => wpex_ilightbox_skin(),
                    'value'         => vcex_ilightbox_skins(),
                    'group'         => __( 'Links', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'thumbnail_link',
                        'value'     => 'lightbox',
                    ),
                ),

                // Image
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
                    'heading'           => __( 'Image Crop Width', 'wpex' ),
                    'param_name'        => 'img_width',
                    'dependency'        => array(
                        'element'   => 'img_size',
                        'value'     => 'wpex_custom',
                    ),
                    'description'       => __( 'Enter a width in pixels.', 'wpex' ),
                    'group'             => __( 'Image', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Image Crop Height', 'wpex' ),
                    'param_name'        => 'img_height',
                    'dependency'        => array(
                        'element'   => 'img_size',
                        'value'     => 'wpex_custom',
                    ),
                    'description'       => __( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'wpex' ),
                    'group'             => __( 'Image', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Rounded Image?', 'wpex' ),
                    'param_name'        => 'rounded_image',
                    'value'             => Array(
                        __( 'No', 'wpex' )  => '',
                        __( 'Yes', 'wpex' ) => 'yes'
                    ),
                    'group'             => __( 'Image', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-3 vc_column clr',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Image Filter', 'wpex' ),
                    'param_name'        => 'img_filter',
                    'value'             => vcex_image_filters(),
                    'group'             => __( 'Image', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-3 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'CSS3 Image Hover', 'wpex' ),
                    'param_name'        => 'img_hover_style',
                    'value'             => vcex_image_hovers(),
                    'group'             => __( 'Image', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-3 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Image Rendering', 'wpex' ),
                    'param_name'        => 'img_rendering',
                    'value'             => vcex_image_rendering(),
                    'group'             => __( 'Image', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-3 vc_column',
                ),

                // Design
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Content Background', 'wpex' ),
                    'param_name'    => 'content_background',
                    'group'         => __( 'Design', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Content Alignment', 'wpex' ),
                    'param_name'    => 'content_alignment',
                    'value'         => array(
                        __( 'Default', 'wpex' ) => '',
                        __( 'Left', 'wpex' )    => 'left',
                        __( 'Right', 'wpex' )   => 'right',
                        __( 'Center', 'wpex')   => 'center',
                    ),
                    'group'         => __( 'Design', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Content Margin', 'wpex' ),
                    'param_name'        => 'content_margin',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'             => __( 'Design', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Content Padding', 'wpex' ),
                    'param_name'        => 'content_padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'             => __( 'Design', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Content Border', 'wpex' ),
                    'param_name'        => 'content_border',
                    'description'       => __( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'wpex' ),
                    'group'             => __( 'Design', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Content Opacity', 'wpex' ),
                    'param_name'        => 'content_opacity',
                    'group'             => __( 'Design', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'description'       => __( 'Enter a value between "0" and "1".', 'wpex' ),
                ),

            ),

        ) );
    }
}
add_action( 'vc_before_init', 'vcex_image_carousel_shortcode_vc_map' );
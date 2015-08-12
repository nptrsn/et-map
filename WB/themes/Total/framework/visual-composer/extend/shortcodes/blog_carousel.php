<?php
/**
 * Registers the blog carousel shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_blog_carousel extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_blog_carousel.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_blog_carousel_shortcode_vc_map' ) ) {
    function vcex_blog_carousel_shortcode_vc_map() {

        // Get list of taxonomies to narrow Query by
        $vc_taxonomies_types    = get_taxonomies( array( 'name' => 'category' ), 'objects' );
        $vc_taxonomies          = get_terms( array_keys( $vc_taxonomies_types ), array( 'hide_empty' => false ) );
        $taxonomies_list        = array();
        foreach ( $vc_taxonomies as $t ) {
            $taxonomies_list[] = array(
                'label' => $t->name,
                'value' => $t->term_id,
                'group' => __( 'Select', 'wpex' )
            );
        }

        // Add VC params
        vc_map( array(
            'name'          => __( 'Blog Carousel', 'wpex' ),
            'description'   => __( 'Recent blog posts carousel.', 'wpex' ),
            'base'          => 'vcex_blog_carousel',
            'category'      => WPEX_THEME_BRANDING,
            'icon'          => 'vcex-blog-carousel',
            'params'        => array(

                // General
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Unique Id', 'wpex' ),
                    'param_name'    => 'unique_id',
                    'description'   => __( 'Give your main element a unique ID.', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Custom Classes', 'wpex' ),
                    'param_name'    => 'classes',
                    'description'   => __( 'Add additonal classes to the main element.', 'wpex' ),
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
                    'type'              => 'textfield',
                    'heading'           => __( 'Items To Display', 'wpex' ),
                    'param_name'        => 'items',
                    'value'             => '4',
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Items To Scrollby', 'wpex' ),
                    'param_name'        => 'items_scroll',
                    'value'             => '1',
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
                    'type'          => 'dropdown',
                    'heading'       => __( 'Auto Play', 'wpex' ),
                    'param_name'    => 'auto_play',
                    'value'         => array(
                        __( 'False', 'wpex' )   => '',
                        __( 'True', 'wpex' )    => 'true',
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Infinite Loop', 'wpex' ),
                    'param_name'    => 'infinite_loop',
                    'value'         => array(
                        __( 'True', 'wpex' )    => '',
                        __( 'False', 'wpex' )   => 'false',
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Center Item', 'wpex' ),
                    'param_name'    => 'center',
                    'value'         => array(
                        __( 'False', 'wpex' )   => '',
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
                
                // Query
                array(
                    'type'                  => 'autocomplete',
                    'heading'               => __( 'Include Categories', 'wpex' ),
                    'param_name'            => 'include_categories',
                    'param_holder_class'    => 'vc_not-for-custom',
                    'admin_label'           => true,
                    'settings'              => array(
                        'multiple'          => true,
                        'min_length'        => 1,
                        'groups'            => true,
                        'unique_values'     => true,
                        'display_inline'    => true,
                        'delay'             => 0,
                        'auto_focus'        => true,
                        'values'            => $taxonomies_list,
                    ),
                    'group'                 => __( 'Query', 'wpex' ),
                ),
                array(
                    'type'          => 'autocomplete',
                    'heading'       => __( 'Exclude Categories', 'wpex' ),
                    'param_name'    => 'exclude_categories',
                    'param_holder_class'    => 'vc_not-for-custom',
                    'admin_label'           => true,
                    'settings'              => array(
                        'multiple'          => true,
                        'min_length'        => 1,
                        'groups'            => true,
                        'unique_values'     => true,
                        'display_inline'    => true,
                        'delay'             => 0,
                        'auto_focus'        => true,
                        'values'            => $taxonomies_list,
                    ),
                    'group'                 => __( 'Query', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Post Count', 'wpex' ),
                    'param_name'    => 'count',
                    'value'         => '8',
                    'group'         => __( 'Query', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Order', 'wpex' ),
                    'param_name'        => 'order',
                    'value'             => vcex_order_array(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                    'group'             => __( 'Query', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Order By', 'wpex' ),
                    'param_name'        => 'orderby',
                    'value'             => vcex_orderby_array(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                    'group'             => __( 'Query', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Ignore Sticky Posts', 'wpex' ),
                    'param_name'    => 'ignore_sticky_posts',
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                    'value'         => array(
                        __( 'False', 'wpex')    => '',
                        __( 'True', 'wpex' )    => 'true',
                    ),
                    'group'         => __( 'Query', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Orderby: Meta Key', 'wpex' ),
                    'param_name'    => 'orderby_meta_key',
                    'group'         => __( 'Query', 'wpex' ),
                    'dependency'    => array(
                        'element'   => 'orderby',
                        'value'     => array( 'meta_value_num', 'meta_value' ),
                    ),
                ),
                
                // Image
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Image', 'wpex' ),
                    'param_name'    => 'media',
                    'value'         => array(
                        __( 'Yes', 'wpex')  => '',
                        __( 'No', 'wpex' )  => 'false',
                    ),
                    'group'         => __( 'Image', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Links To', 'wpex' ),
                    'param_name'    => 'thumbnail_link',
                    'value'         => array(
                        __( 'Default', 'wpex')      => '',
                        __( 'Post', 'wpex')         => 'post',
                        __( 'Lightbox', 'wpex' )    => 'lightbox',
                        __( 'None', 'wpex' )        => 'none',
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
                    'type'          => 'textfield',
                    'heading'       => __( 'Image Crop Width', 'wpex' ),
                    'param_name'    => 'img_width',
                    'dependency'    => array(
                        'element'   => 'img_size',
                        'value'     => 'wpex_custom',
                    ),
                    'group'         => __( 'Image', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Image Crop Height', 'wpex' ),
                    'param_name'    => 'img_height',
                    'dependency'    => array(
                        'element'   => 'img_size',
                        'value'     => 'wpex_custom',
                    ),
                    'description'   => __( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'wpex' ),
                    'group'         => __( 'Image', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Image Overlay Style', 'wpex' ),
                    'param_name'        => 'overlay_style',
                    'value'             => vcex_image_overlays(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                    'group'             => __( 'Image', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'CSS3 Image Link Hover', 'wpex' ),
                    'param_name'        => 'img_hover_style',
                    'value'             => vcex_image_hovers(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                    'group'             => __( 'Image', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Image Rendering', 'wpex' ),
                    'param_name'        => 'img_rendering',
                    'value'             => vcex_image_rendering(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                    'group'             => __( 'Image', 'wpex' ),
                ),

                // Title
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Title', 'wpex' ),
                    'param_name'    => 'title',
                    'value'         => array(
                        __( 'Yes', 'wpex')  => '',
                        __( 'No', 'wpex' )  => 'false',
                    ),
                    'group'         => __( 'Title', 'wpex' ),
                ),
                array(
                    'type'              => 'colorpicker',
                    'heading'           => __( 'Title Text Color', 'wpex' ),
                    'param_name'        => 'content_heading_color',
                    'group'             => __( 'Title', 'wpex' ),
                    'description'       => __( 'Select a custom color to override the default.', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Title Font Size', 'wpex' ),
                    'param_name'    => 'content_heading_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'         => __( 'Title', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Title Margin', 'wpex' ),
                    'param_name'    => 'content_heading_margin',
                    'description'   => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'         => __( 'Title', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Title Line Height', 'wpex' ),
                    'param_name'    => 'content_heading_line_height',
                    'description'   => __( 'Enter a numerical, pixel or percentage value.', 'wpex' ),
                    'group'         => __( 'Title', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Title Font Weight', 'wpex' ),
                    'param_name'    => 'content_heading_weight',
                    'group'         => __( 'Title', 'wpex' ),
                    'description'   => __( 'Note: Not all font families support every font weight.', 'wpex' ),
                    'std'           => '',
                    'value'         => vcex_font_weights(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Title Text Transform', 'wpex' ),
                    'param_name'    => 'content_heading_transform',
                    'value'         => vcex_text_transforms(),
                    'group'         => __( 'Title', 'wpex' ),
                    'description'       => __( 'Select a custom text transform to override the default.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),

                // Date
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Date', 'wpex' ),
                    'param_name'    => 'date',
                    'value'         => array(
                        __( 'Yes', 'wpex' ) => '',
                        __( 'No', 'wpex' )  => 'false',
                    ),
                    'group'         => __( 'Date', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Date Color', 'wpex' ),
                    'param_name'    => 'date_color',
                    'group'         => __( 'Date', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Date Font Size', 'wpex' ),
                    'param_name'    => 'date_font_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'         => __( 'Date', 'wpex' ),
                ),

                // Excerpt
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Excerpt', 'wpex' ),
                    'param_name'    => 'excerpt',
                    'value'         => array(
                        __( 'Yes', 'wpex')  => '',
                        __( 'No', 'wpex' )  => 'false',
                    ),
                    'group'         => __( 'Excerpt', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Excerpt Length', 'wpex' ),
                    'param_name'    => 'excerpt_length',
                    'value'         => '30',
                    'description'   => __( 'Enter how many words to display for the excerpt. To display the full post content enter "-1". To display the full post content up to the "more" tag enter "9999".', 'wpex' ),
                    'group'         => __( 'Excerpt', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Excerpt Font Size', 'wpex' ),
                    'param_name'    => 'content_font_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'         => __( 'Excerpt', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Excerpt Text Color', 'wpex' ),
                    'param_name'    => 'content_color',
                    'group'         => __( 'Excerpt', 'wpex' ),
                ),

                // Design
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Style', 'wpex' ),
                    'param_name'    => 'style',
                    'value'         => array(
                        __( 'Default', 'wpex')      => '',
                        __( 'No Margins', 'wpex' )  => 'no-margins',
                    ),
                    'group'         => __( 'Design', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Arrows?', 'wpex' ),
                    'param_name'    => 'arrows',
                    'value'         => array(
                        __( 'True', 'wpex' )    => '',
                        __( 'False', 'wpex' )   => 'false',
                    ),
                    'group'         => __( 'Design', 'wpex' ),
                ),
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
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
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
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Content Opacity', 'wpex' ),
                    'param_name'        => 'content_opacity',
                    'description'       => __( 'Enter a value between "0" and "1".', 'wpex' ),
                    'group'             => __( 'Design', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),

                // Responsive Settings
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Tablet: Items To Display', 'wpex' ),
                    'param_name'    => 'tablet_items',
                    'value'         => '3',
                    'group'         => __( 'Mobile', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Mobile Landscape: Items To Display', 'wpex' ),
                    'param_name'    => 'mobile_landscape_items',
                    'value'         => '2',
                    'group'         => __( 'Mobile', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Mobile Portrait: Items To Display', 'wpex' ),
                    'param_name'    => 'mobile_portrait_items',
                    'value'         => '1',
                    'group'         => __( 'Mobile', 'wpex' ),
                ),

            ),
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_blog_carousel_shortcode_vc_map' );
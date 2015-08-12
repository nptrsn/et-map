<?php
/**
 * Registers the recent news shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_recent_news extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_recent_news.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_news_shortcode_vc_map' ) ) {
    function vcex_news_shortcode_vc_map() {

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

        // Add to VC
        vc_map( array(
            'name'                  => __( 'Recent News', 'wpex' ),
            'description'           => __( 'Recent blog posts.', 'wpex' ),
            'base'                  => 'vcex_recent_news',
            'category'              => WPEX_THEME_BRANDING,
            'icon'                  => 'vcex-recent-news',
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
                    'type'          => 'textfield',
                    'heading'       => __( 'Header', 'wpex' ),
                    'param_name'    => 'header',
                    'descrtiption'  => __( 'You can display a title above your recent posts.', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Columns', 'wpex' ),
                    'param_name'        => 'grid_columns',
                    'value'             => vcex_grid_columns(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Visibility', 'wpex' ),
                    'param_name'        => 'visibility',
                    'value'             => vcex_visibility(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Appear Animation', 'wpex'),
                    'param_name'        => 'css_animation',
                    'value'             => vcex_css_animations(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),

                // Query
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Post Count', 'wpex' ),
                    'param_name'    => 'count',
                    'value'         => '3',
                    'descrtiption'  => __( 'How many posts do you wish to show.', 'wpex' ),
                    'group'         => __( 'Query', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Get Posts From', 'wpex' ),
                    'param_name'    => 'get_posts',
                    'group'         => __( 'Query', 'wpex' ),
                    'value'         => array(
                        __( 'Standard Posts','wpex' )       => 'standard_post_types',
                        __( 'Custom Post types','wpex' )    => 'custom_post_types',
                    ),
                ),
                array(
                    'type'          => 'posttypes',
                    'heading'       => __( 'Post types', 'wpex' ),
                    'param_name'    => 'post_types',
                    'group'         => __( 'Query', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'get_posts',
                        'value'     => 'custom_post_types'
                    ),
                ),
                array(
                    'type'                  => 'autocomplete',
                    'heading'               => __( 'Include Categories', 'wpex' ),
                    'param_name'            => 'include_categories',
                    'param_holder_class'    => 'vc_not-for-custom',
                    'admin_label'           => true,
                    'settings'              => array(
                        'multiple'          => true,
                        'min_length'        => 1,
                        'groups'            => false,
                        'unique_values'     => true,
                        'display_inline'    => true,
                        'delay'             => 0,
                        'auto_focus'        => true,
                        'values'            => $taxonomies_list,
                    ),
                    'dependency'    => Array(
                        'element'   => 'get_posts',
                        'value'     => 'standard_post_types'
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
                        'groups'            => false,
                        'unique_values'     => true,
                        'display_inline'    => true,
                        'delay'             => 0,
                        'auto_focus'        => true,
                        'values'            => $taxonomies_list,
                    ),
                    'dependency'    => Array(
                        'element'   => 'get_posts',
                        'value'     => 'standard_post_types'
                    ),
                    'group'                 => __( 'Query', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Order', 'wpex' ),
                    'param_name'        => 'order',
                    'value'             => vcex_order_array(),
                    'group'             => __( 'Query', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Order By', 'wpex' ),
                    'param_name'        => 'orderby',
                    'value'             => vcex_orderby_array(),
                    'group'             => __( 'Query', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Ignore Sticky Posts', 'wpex' ),
                    'param_name'        => 'ignore_sticky_posts',
                    'value'             => array(
                        __( 'No', 'wpex' )  => '',
                        __( 'Yes', 'wpex' ) => 'true',
                    ),
                    'group'             => __( 'Query', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
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
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Pagination', 'wpex' ),
                    'param_name'    => 'pagination',
                    'value'         => array(
                        __( 'No', 'wpex' )  => '',
                        __( 'Yes', 'wpex' ) => 'true',
                    ),
                    'description'   => __( 'Important: Pagination will not work on your homepage due to how WordPress Queries function.', 'wpex' ),
                    'group'         => __( 'Query', 'wpex' ),
                ),

                // Media
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Featured Media?', 'wpex' ),
                    'param_name'    => 'featured_image',
                    'value'         => array(
                        __( 'No', 'wpex' )  => '',
                        __( 'Yes', 'wpex' ) => 'true',
                    ),
                    'group'         => __( 'Media', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Featured Videos?', 'wpex' ),
                    'param_name'    => 'featured_video',
                    'value'         => array(
                        __( 'Yes', 'wpex' ) => '',
                        __( 'No', 'wpex' )  => 'false',
                    ),
                    'dependency'    => Array(
                        'element'   => 'featured_image',
                        'value'     => 'true'
                    ),
                    'group'         => __( 'Media', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Size', 'wpex' ),
                    'param_name'    => 'img_size',
                    'std'           => 'wpex_custom',
                    'value'         => vcex_image_sizes(),
                    'group'         => __( 'Media', 'wpex' ),
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
                    'group'         => __( 'Media', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Image Crop Width', 'wpex' ),
                    'param_name'    => 'img_width',
                    'dependency'    => array(
                        'element'   => 'img_size',
                        'value'     => 'wpex_custom',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'description'   => __( 'Enter a width in pixels.', 'wpex' ),
                    'group'         => __( 'Media', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Image Crop Height', 'wpex' ),
                    'param_name'    => 'img_height',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'dependency'    => array(
                        'element'   => 'img_size',
                        'value'     => 'wpex_custom',
                    ),
                    'description'   => __( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'wpex' ),
                    'group'         => __( 'Media', 'wpex' ),
                ),

                // Content
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Title?', 'wpex' ),
                    'param_name'    => 'title',
                    'value'         => array(
                        __( 'Yes', 'wpex' ) => '',
                        __( 'No', 'wpex' )  => 'false',
                    ),
                    'group'         => __( 'Title', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Title Font Weight', 'wpex' ),
                    'param_name'        => 'title_weight',
                    'group'             => __( 'Title', 'wpex' ),
                    'description'       => __( 'Note: Not all font families support every font weight.', 'wpex' ),
                    'std'               => '',
                    'value'             => vcex_font_weights(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Title Text Transform', 'wpex' ),
                    'param_name'        => 'title_transform',
                    'group'             => __( 'Title', 'wpex' ),
                    'std'               => '',
                    'description'       => __( 'Select a custom text transform to override the default.', 'wpex' ),
                    'value'             => vcex_text_transforms(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Title Font Size', 'wpex' ),
                    'param_name'        => 'title_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'             => __( 'Title', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Title Line Height', 'wpex' ),
                    'param_name'        => 'title_line_height',
                    'description'       => __( 'Enter a numerical, pixel or percentage value.', 'wpex' ),
                    'group'             => __( 'Title', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Title Margin', 'wpex' ),
                    'param_name'        => 'title_margin',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'             => __( 'Title', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),

                // Date
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Date?', 'wpex' ),
                    'param_name'    => 'date',
                    'value'         => array(
                        __( 'True','wpex' )     => '',
                        __( 'False','wpex' )    => 'false',
                    ),
                    'group'         => __( 'Date', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Month Background', 'wpex' ),
                    'param_name'    => 'month_background',
                    'group'         => __( 'Date', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Month Color', 'wpex' ),
                    'param_name'    => 'month_color',
                    'group'         => __( 'Date', 'wpex' ),
                ),

                // Excerpt
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
                    'param_name'    => 'excerpt_font_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'         => __( 'Excerpt', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Excerpt Color', 'wpex' ),
                    'param_name'    => 'excerpt_color',
                    'group'         => __( 'Excerpt', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Read More', 'wpex' ),
                    'param_name'    => 'read_more',
                    'value'         => array(
                        __( 'Yes', 'wpex')  => '',
                        __( 'No', 'wpex' )  => 'false',
                    ),
                    'group'         => __( 'Excerpt', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Read More Text', 'wpex' ),
                    'param_name'    => 'read_more_text',
                    'group'         => __( 'Excerpt', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Read More Style', 'wpex' ),
                    'param_name'        => 'readmore_style',
                    'value'             => vcex_button_styles(),
                    'group'             => __( 'Excerpt', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Read More Color', 'wpex' ),
                    'param_name'        => 'readmore_style_color',
                    'std'               => '',
                    'value'             => vcex_button_colors(),
                    'group'             => __( 'Excerpt', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Read More Arrow', 'wpex' ),
                    'param_name'        => 'readmore_rarr',
                    'value'             => array(
                        __( 'No', 'wpex' )  => '',
                        __( 'Yes', 'wpex')  => 'true',
                    ),
                    'group'             => __( 'Excerpt', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Read More Font Size', 'wpex' ),
                    'param_name'        => 'readmore_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'             => __( 'Excerpt', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Read More Border Radius', 'wpex' ),
                    'param_name'        => 'readmore_border_radius',
                    'description'       => __( 'Please enter a px value.', 'wpex' ),
                    'group'             => __( 'Excerpt', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Read More Padding', 'wpex' ),
                    'param_name'        => 'readmore_padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'             => __( 'Excerpt', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Read More Margin', 'wpex' ),
                    'param_name'        => 'readmore_margin',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'             => __( 'Excerpt', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Read More Background', 'wpex' ),
                    'param_name'    => 'readmore_background',
                    'group'         => __( 'Excerpt', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Read More Color', 'wpex' ),
                    'param_name'    => 'readmore_color',
                    'group'         => __( 'Excerpt', 'wpex' ),
                ),

                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Read More Hover Background', 'wpex' ),
                    'param_name'    => 'readmore_hover_background',
                    'group'         => __( 'Excerpt', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Read More Hover Color', 'wpex' ),
                    'param_name'    => 'readmore_hover_color',
                    'group'         => __( 'Excerpt', 'wpex' ),
                ),

                // Design options
                array(
                    'type'          => 'css_editor',
                    'heading'       => __( 'CSS', 'wpex' ),
                    'param_name'    => 'css',
                    'description'   => __( 'If any of these are defined it will add a new wrapper around your icon box with the custom CSS applied to it.', 'wpex' ),
                    'group'         => __( 'Design options', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Article Bottom Border Color', 'wpex' ),
                    'param_name'    => 'entry_bottom_border_color',
                    'group'         => __( 'Design options', 'wpex' ),
                ),

            )
        ) );

    }
}
add_action( 'vc_before_init', 'vcex_news_shortcode_vc_map' );
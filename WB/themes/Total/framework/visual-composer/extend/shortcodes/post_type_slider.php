<?php
/**
 * Registers the post type slider shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_post_type_flexslider extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_post_type_flexslider.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_post_type_flexslider_vc_map' ) ) {
    function vcex_post_type_flexslider_vc_map() {


        // List of authors
        $users      = get_users( array( 'number' => '30' ) );
        $users_list = array();
        foreach ( $users as $user ) {
            $users_list[] = array(
                'label' => esc_html( $user->display_name ),
                'value' => $user->ID,
                'group' => __( 'Select', 'wpex' )
            );
        }

        // List of taxonomies
        $taxonomies         = get_taxonomies( array( 'public' => true ) );
        $taxonomies_list    = array();
        foreach ( $taxonomies as $taxonomy ) {
            $get_tax = get_taxonomy( $taxonomy );
            $taxonomies_list[] = array(
                'label' => $get_tax->labels->name,
                'value' => $taxonomy,
                'group' => __( 'Select', 'wpex' )
            );
        }

        // List of terms
        $vc_taxonomies_types    = get_taxonomies( array( 'public' => true ), 'objects' );
        $vc_taxonomies          = get_terms( array_keys( $vc_taxonomies_types ), array( 'hide_empty' => false ) );
        $terms_list             = array();
        foreach ( $vc_taxonomies as $taxonomy ) {
            $group = isset( $vc_taxonomies_types[$taxonomy->taxonomy]->labels ) ? $vc_taxonomies_types[$taxonomy->taxonomy]->labels->name : __( 'Taxonomies', 'wpex' );
            $terms_list[] = array(
                'label'     => $taxonomy->name,
                'value'     => $taxonomy->slug,
                'group_id'  => $taxonomy->taxonomy,
                'group'     => $group,
            );
        }

        // Add params
        vc_map( array(
            'name'                  => __( 'Post Types Slider', 'wpex' ),
            'description'           => __( 'Recent posts slider.', 'wpex' ),
            'base'                  => 'vcex_post_type_flexslider',
            'category'              => WPEX_THEME_BRANDING,
            'icon'                  => 'vcex-post-type-slider',
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
                    'type'          => 'dropdown',
                    'heading'       => __( 'Visibility', 'wpex' ),
                    'param_name'    => 'visibility',
                    'value'         => vcex_visibility(),
                    'group'         => __( 'General', 'wpex' ),
                ),

                // Slider Settings
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Randomize', 'wpex' ),
                    'param_name'    => 'randomize',
                    'value'         => array(
                        __( 'No', 'wpex' )  => '',
                        __( 'Yes', 'wpex' ) => 'true',
                    ),
                    'description'   => __( 'Randomize image order display on page load?', 'wpex' ),
                    'group'         => __( 'Slider Settings', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Animation', 'wpex' ),
                    'param_name'    => 'animation',
                    'value'         => array(
                        __( 'Fade', 'wpex' )    => 'fade_slides',
                        __( 'Slide', 'wpex' )   => 'slide',
                    ),
                    'group'         => __( 'Slider Settings', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Loop', 'wpex' ),
                    'param_name'    => 'loop',
                    'value'         => array(
                        __( 'No', 'wpex' )   => '',
                        __( 'Yes', 'wpex' )    => 'true',
                    ),
                    'group'         => __( 'Slider Settings', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Auto Height Animation', 'wpex' ),
                    'std'               => '500',
                    'param_name'        => 'height_animation',
                    'group'             => __( 'Slider Settings', 'wpex' ),
                    'description'       => __( 'You can enter "0.0" to disable the animation completely.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Animation Speed', 'wpex' ),
                    'param_name'        => 'animation_speed',
                    'std'               => '600',
                    'description'       => __( 'Enter a value in milliseconds.', 'wpex' ),
                    'group'             => __( 'Slider Settings', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Auto Play', 'wpex' ),
                    'param_name'        => 'slideshow',
                    'value'             => array(
                        __( 'Yes', 'wpex' ) => 'true',
                        __( 'No', 'wpex' )  => 'false',
                    ),
                    'description'       => __( 'Enable automatic slideshow? Disabled in front-end composer to prevent page "jumping".', 'wpex' ),
                    'group'             => __( 'Slider Settings', 'wpex' ),
                     'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Auto Play Delay', 'wpex' ),
                    'param_name'        => 'slideshow_speed',
                    'std'               => '5000',
                    'description'       => __( 'Enter a value in milliseconds.', 'wpex' ),
                    'group'             => __( 'Slider Settings', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Arrows', 'wpex' ),
                    'param_name'        => 'direction_nav',
                    'value'             => array(
                        __( 'Yes', 'wpex' ) => '',
                        __( 'No', 'wpex' )  => 'false',
                    ),
                    'group'             => __( 'Slider Settings', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Arrows on Hover', 'wpex' ),
                    'param_name'        => 'direction_nav_hover',
                    'value'             => array(
                        __( 'Yes', 'wpex' ) => '',
                        __( 'No', 'wpex' )  => 'false',
                    ),
                    'group'             => __( 'Slider Settings', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Dot Navigation', 'wpex' ),
                    'param_name'        => 'control_nav',
                    'value'             => array(
                        __( 'Yes', 'wpex' ) => '',
                        __( 'No', 'wpex' )  => 'false',
                    ),
                    'group'             => __( 'Slider Settings', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Thumbnails', 'wpex' ),
                    'param_name'        => 'control_thumbs',
                    'value'             => array(
                        __( 'Yes', 'wpex' ) => 'true',
                        __( 'No', 'wpex' )  => 'false',
                    ),
                    'group'             => __( 'Slider Settings', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Thumbnails Pointer', 'wpex' ),
                    'param_name'        => 'control_thumbs_pointer',
                    'value'             => array(
                        __( 'No', 'wpex' )  => '',
                        __( 'Yes', 'wpex' ) => 'true',
                    ),
                    'group'             => __( 'Slider Settings', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Navigation Thumbnails Height', 'wpex' ),
                    'param_name'        => 'control_thumbs_height',
                    'std'               => '70',
                    'dependency'        => Array(
                        'element'   => 'control_thumbs',
                        'value'     => array( 'true' )
                    ),
                    'group'             => __( 'Slider Settings', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Navigation Thumbnails Width', 'wpex' ),
                    'param_name'        => 'control_thumbs_width',
                    'std'               => '70',
                    'dependency'        => Array(
                        'element'   => 'control_thumbs',
                        'value'     => array( 'true' )
                    ),
                    'group'             => __( 'Slider Settings', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),

                // Query
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Posts Per Page', 'wpex' ),
                    'param_name'    => 'posts_per_page',
                    'value'         => '4',
                    'description'   => __( 'You can enter "-1" to display all posts.', 'wpex' ),
                    'group'         => __( 'Query', 'wpex' ),
                ),
                array(
                    'type'          => 'posttypes',
                    'heading'       => __( 'Post types', 'wpex' ),
                    'param_name'    => 'post_types',
                    'group'         => __( 'Query', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Limit By Post ID\'s', 'wpex' ),
                    'param_name'    => 'posts_in',
                    'group'         => __( 'Query', 'wpex' ),
                    'description'   => __( 'Seperate by a comma.', 'wpex' ),
                ),
                array(
                    'type'          => 'autocomplete',
                    'heading'       => __( 'Limit By Author', 'wpex' ),
                    'param_name'    => 'author_in',
                    'settings'              => array(
                        'multiple'          => true,
                        'min_length'        => 1,
                        'groups'            => false,
                        'unique_values'     => true,
                        'display_inline'    => true,
                        'delay'             => 0,
                        'auto_focus'        => true,
                        'values'            => $users_list,
                    ),
                    'group'         => __( 'Query', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Query by Taxonomy', 'wpex' ),
                    'param_name'    => 'tax_query',
                    'value'         => array(
                        __( 'No', 'wpex' )  => '',
                        __( 'Yes', 'wpex')  => 'true',
                    ),
                    'group'         => __( 'Query', 'wpex' ),
                ),
                array(
                    'type'          => 'autocomplete',
                    'heading'       => __( 'Taxonomy Name', 'wpex' ),
                    'param_name'    => 'tax_query_taxonomy',
                    'dependency'    => array(
                        'element'   => 'tax_query',
                        'value'     => 'true',
                    ),
                    'settings'              => array(
                        'multiple'          => false,
                        'min_length'        => 1,
                        'groups'            => false,
                        'unique_values'     => true,
                        'display_inline'    => true,
                        'delay'             => 0,
                        'auto_focus'        => true,
                        'values'            => $taxonomies_list,
                    ),
                    'group'         => __( 'Query', 'wpex' ),
                ),
                array(
                    'type'          => 'autocomplete',
                    'heading'       => __( 'Terms', 'wpex' ),
                    'param_name'    => 'tax_query_terms',
                    'dependency'    => array(
                        'element'   => 'tax_query',
                        'value'     => 'true',
                    ),
                    'settings'              => array(
                        'multiple'          => true,
                        'min_length'        => 1,
                        'groups'            => true,
                        'unique_values'     => true,
                        'display_inline'    => true,
                        'delay'             => 0,
                        'auto_focus'        => true,
                        'values'            => $terms_list,
                    ),
                    'group'         => __( 'Query', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Order', 'wpex' ),
                    'param_name'        => 'order',
                    'value'             => vcex_order_array(),
                    'group'             => __( 'Query', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Order By', 'wpex' ),
                    'param_name'        => 'orderby',
                    'value'             => vcex_orderby_array(),
                    'group'             => __( 'Query', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
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
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'description'       => __( 'Enter a width in pixels.', 'wpex' ),
                    'group'             => __( 'Image', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Image Crop Height', 'wpex' ),
                    'param_name'        => 'img_height',
                    'description'       => __( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'wpex' ),
                    'dependency'    => array(
                        'element'   => 'img_size',
                        'value'     => 'wpex_custom',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'Image', 'wpex' )
                ),

                // Caption
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Caption', 'wpex' ),
                    'param_name'    => 'caption',
                    'value'         => array(
                        __( 'Yes', 'wpex' ) => 'true',
                        __( 'No', 'wpex' )  => 'false',
                    ),
                    'group'         => __( 'Caption', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Caption Visibility', 'wpex' ),
                    'param_name'    => 'caption_visibility',
                    'value'         => vcex_visibility(),
                    'group'         => __( 'Caption', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Caption Location', 'wpex' ),
                    'param_name'    => 'caption_location',
                    'value'         => array(
                        __( 'Over Image', 'wpex' )  => 'over-image',
                        __( 'Under Image', 'wpex' ) => 'under-image',
                    ),
                    'group'         => __( 'Caption', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Title', 'wpex' ),
                    'param_name'    => 'title',
                    'value'         => array(
                        __( 'Yes', 'wpex' ) => 'true',
                        __( 'No', 'wpex' )  => 'false',
                    ),
                    'group'         => __( 'Caption', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Excerpt', 'wpex' ),
                    'param_name'    => 'excerpt',
                    'value'         => array(
                        __( 'Yes', 'wpex' ) => 'true',
                        __( 'No', 'wpex' )  => 'false',
                    ),
                    'group'         => __( 'Caption', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Excerpt Length', 'wpex' ),
                    'param_name'    => 'excerpt_length',
                    'value'         => '40',
                    'group'         => __( 'Caption', 'wpex' ),
                ),

                // Design
                array(
                    'type'          => 'css_editor',
                    'heading'       => __( 'CSS', 'wpex' ),
                    'param_name'    => 'css',
                    'description'   => __( 'If any of these are defined it will add a new wrapper around your icon box with the custom CSS applied to it.', 'wpex' ),
                    'group'         => __( 'Design', 'wpex' ),
                ),

            ),
            
        ) );
    }
}
add_action( 'init', 'vcex_post_type_flexslider_vc_map' );
<?php
/**
 * Registers the portfolio grid shortcode and adds it to the Visual Composer
 *
 * @package     Total
 * @subpackage  Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.4.1
 * @version     2.0.0
 */

// Return if post type is disabled
if ( ! WPEX_PORTFOLIO_IS_ACTIVE ) {
    return;
}

/**
 * Register shortcode with VC Composer
 *
 * @since Total 2.0.0
 */
class WPBakeryShortCode_vcex_portfolio_grid extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_portfolio_grid.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the portfolio grid shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_portfolio_grid_shortcode_vc_map' ) ) {
    function vcex_portfolio_grid_shortcode_vc_map() {

        // Get global object
        global $vcex_global;

        // Get list of taxonomies to narrow Query by
        $vc_taxonomies_types    = get_taxonomies( array( 'name' => 'portfolio_category' ), 'objects' );
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
            'name'                  => __( 'Portfolio Grid', 'wpex' ),
            'description'           => __( 'Recent portfolio posts grid.', 'wpex' ),
            'base'                  => 'vcex_portfolio_grid',
            'category'              => WPEX_THEME_BRANDING,
            'icon'                  => 'vcex-portfolio-grid',
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
                    'description'       => __( 'Choose when this module should display.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Appear Animation', 'wpex'),
                    'param_name'        => 'css_animation',
                    'value'             => vcex_css_animations(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'description'       => __( 'If the "filter" is enabled animations will be disabled to prevent bugs.', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Grid Style', 'wpex' ),
                    'param_name'        => 'grid_style',
                    'value'             => array(
                        __( 'Fit Columns', 'wpex' ) => 'fit_columns',
                        __( 'Masonry', 'wpex' )     => 'masonry',
                        __( 'No Margins', 'wpex' )  => 'no_margins',
                    ),
                     'edit_field_class'  => 'vc_col-sm-3 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Columns', 'wpex' ),
                    'param_name'        => 'columns',
                    'value'             => vcex_grid_columns(),
                    'std'               => '4',
                    'edit_field_class'  => 'vc_col-sm-3 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Gap', 'wpex' ),
                    'param_name'        => 'columns_gap',
                    'value'             => vcex_column_gaps(),
                    'edit_field_class'  => 'vc_col-sm-3 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Responsive', 'wpex' ),
                    'param_name'        => 'columns_responsive',
                    'value'             => array(
                        __( 'Yes', 'wpex' ) => '',
                        __( 'No', 'wpex' )  => 'false',
                    ),
                    'std'               => '',
                    'edit_field_class'  => 'vc_col-sm-3 vc_column',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( '1 Column Style', 'wpex' ),
                    'param_name'    => 'single_column_style',
                    'value'         => array(
                        __( 'Default', 'wpex')                      => '',
                        __( 'Left Image & Right Content', 'wpex' )  => 'left_thumbs',
                    ),
                    'dependency'    => array(
                        'element'   => 'columns',
                        'value'     => '1',
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Equal Heights?', 'wpex' ),
                    'param_name'    => 'equal_heights_grid',
                    'value'         => array(
                        __( 'No', 'wpex' )  => '',
                        __( 'Yes', 'wpex')  => 'true',
                    ),
                    'dependency'    => array(
                        'element'   => 'grid_style',
                        'value'     => 'fit_columns',
                    ),
                    'description'   => __( 'Adds equal heights for the entry content so "boxes" on the same row are the same height. You must have equal sized images for this to work efficiently.', 'wpex' ),
                ),

                // Query
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Posts Per Page', 'wpex' ),
                    'param_name'    => 'posts_per_page',
                    'value'         => '8',
                    'description'   => __( 'When pagination is disabled this is also used for the post count.', 'wpex' ),
                    'group'         => __( 'Query', 'wpex' ),
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
                    'group'                 => __( 'Query', 'wpex' ),
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
                        'values'            => $vcex_global->users_list,
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
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Pagination', 'wpex' ),
                    'param_name'    => 'pagination',
                    'value'         => array(
                        __( 'No', 'wpex')   => '',
                        __( 'Yes', 'wpex' ) => 'true',
                    ),
                    'description'   => __( 'Important: Pagination will not work on your homepage due to how WordPress Queries function.', 'wpex' ),
                    'group'         => __( 'Query', 'wpex' ),
                ),

                // Filter
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Category Filter', 'wpex' ),
                    'param_name'    => 'filter',
                    'value'         => array(
                        __( 'No', 'wpex' )  => '',
                        __( 'Yes', 'wpex' ) => 'true',
                    ),
                    'description'   => __( 'Enables a category filter to show and hide posts based on their categories. This does not load posts via AJAX, but rather filters items currently on the page.', 'wpex' ),
                    'group'         => __( 'Filter', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Layout Mode', 'wpex' ),
                    'param_name'    => 'masonry_layout_mode',
                    'value'         => array(
                        __( 'Masonry', 'wpex' )     => '',
                        __( 'Fit Rows', 'wpex' )    => 'fitRows',
                    ),
                    'dependency'    => array(
                        'element'   => 'filter',
                        'value'     => 'true',
                    ),
                    'group'         => __( 'Filter', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Custom Filter Speed', 'wpex' ),
                    'param_name'    => 'filter_speed',
                    'description'   => __( 'Default is "0.4" seconds. Enter "0.0" to disable.', 'wpex' ),
                    'dependency'    => array(
                        'element'   => 'filter',
                        'value'     => 'true',
                    ),
                    'group'         => __( 'Filter', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Center Filter Links', 'wpex' ),
                    'param_name'    => 'center_filter',
                    'value'         => array(
                        __( 'No', 'wpex' )  => '',
                        __( 'Yes', 'wpex' ) => 'yes',
                    ),
                    'dependency'    => array(
                        'element'   => 'filter',
                        'value'     => 'true',
                    ),
                    'group'         => __( 'Filter', 'wpex' ),
                ),
                array(
                    'type'      => 'textfield',
                    'heading'       => __( 'Custom Filter "All" Text', 'wpex' ),
                    'param_name'    => 'all_text',
                    'dependency'    => array(
                        'element'   => 'filter',
                        'value'     => 'true',
                    ),
                    'group'         => __( 'Filter', 'wpex' ),
                ),

                // Images
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Entry Media?', 'wpex' ),
                    'param_name'    => 'entry_media',
                    'value'         => array(
                        __( 'Yes', 'wpex')  => '',
                        __( 'No', 'wpex' )  => 'false',
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
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Overlay Style', 'wpex' ),
                    'param_name'    => 'overlay_style',
                    'value'         => vcex_image_overlays(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'group'         => __( 'Media', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'CSS3 Image Link Hover', 'wpex' ),
                    'param_name'        => 'img_hover_style',
                    'value'             => vcex_image_hovers(),
                    'group'             => __( 'Media', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Image Filter', 'wpex' ),
                    'param_name'        => 'img_filter',
                    'value'             => vcex_image_filters(),
                    'group'             => __( 'Media', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Image Rendering', 'wpex' ),
                    'param_name'        => 'img_rendering',
                    'value'             => vcex_image_rendering(),
                    'group'             => __( 'Media', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Links To', 'wpex' ),
                    'param_name'    => 'thumb_link',
                    'value'         => array(
                        __( 'Post', 'wpex')         => '',
                        __( 'Lightbox', 'wpex' )    => 'lightbox',
                        __( 'Nowhere', 'wpex' )     => 'nowhere',
                    ),
                    'group'         => __( 'Media', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Lightbox Skin', 'wpex' ),
                    'param_name'    => 'lightbox_skin',
                    'value'         => vcex_ilightbox_skins(),
                    'group'         => __( 'Media', 'wpex' ),
                    'dependency'    => array(
                        'element'   => 'thumb_link',
                        'value'     => 'lightbox',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Display Lightbox Gallery', 'wpex' ),
                    'param_name'        => 'thumb_lightbox_gallery',
                    'value'             => array(
                        __( 'No', 'wpex')   => '',
                        __( 'Yes', 'wpex' ) => 'true',
                    ),
                    'group'             => __( 'Media', 'wpex' ),
                    'dependency'        => array(
                        'element'   => 'thumb_link',
                        'value'     => 'lightbox',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Display Title In Lightbox', 'wpex' ),
                    'param_name'        => 'thumb_lightbox_title',
                    'value'             => array(
                        __( 'No', 'wpex')   => '',
                        __( 'Yes', 'wpex' ) => 'true',
                    ),
                    'group'             => __( 'Media', 'wpex' ),
                    'dependency'        => array(
                        'element'   => 'thumb_link',
                        'value'     => 'lightbox',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Display Excerpt In Lightbox', 'wpex' ),
                    'param_name'        => 'thumb_lightbox_caption',
                    'value'             => array(
                        __( 'No', 'wpex')   => '',
                        __( 'Yes', 'wpex' ) => 'true',
                    ),
                    'group'             => __( 'Media', 'wpex' ),
                    'dependency'        => array(
                        'element'   => 'thumb_link',
                        'value'     => 'lightbox',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),

                // Title
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Title', 'wpex' ),
                    'param_name'    => 'title',
                    'value'         => array(
                        __( 'Yes', 'wpex' ) => '',
                        __( 'No', 'wpex' )  => 'false',
                    ),
                    'group'         => __( 'Title', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Title Links To', 'wpex' ),
                    'param_name'    => 'title_link',
                    'value'         => array(
                        __( 'Post', 'wpex')     => '',
                        __( 'Lightbox', 'wpex') => 'lightbox',
                        __( 'Nowhere', 'wpex' ) => 'nowhere',
                    ),
                    'group'         => __( 'Title', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Title Text Color', 'wpex' ),
                    'param_name'    => 'content_heading_color',
                    'group'         => __( 'Title', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Title Font Size', 'wpex' ),
                    'param_name'        => 'content_heading_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'             => __( 'Title', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Title Line Height', 'wpex' ),
                    'param_name'        => 'content_heading_line_height',
                    'description'       => __( 'Enter a numerical, pixel or percentage value.', 'wpex' ),
                    'group'             => __( 'Title', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Title Margin', 'wpex' ),
                    'param_name'        => 'content_heading_margin',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'             => __( 'Title', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Title Font Weight', 'wpex' ),
                    'param_name'        => 'content_heading_weight',
                    'group'             => __( 'Title', 'wpex' ),
                    'description'       => __( 'Note: Not all font families support every font weight.', 'wpex' ),
                    'std'               => '',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'value'             => vcex_font_weights(),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Title Text Transform', 'wpex' ),
                    'param_name'        => 'content_heading_transform',
                    'group'             => __( 'Title', 'wpex' ),
                    'std'               => '',
                    'value'             => vcex_text_transforms(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Show Categories', 'wpex' ),
                    'param_name'    => 'show_categories',
                    'value'         => array(
                        __( 'No', 'wpex' )  => '',
                        __( 'Yes', 'wpex' ) => 'true',
                    ),
                    'group'         => __( 'Title', 'wpex' ),
                    'description'   => __( 'Because of how the output works categories their color can only be styled via custom CSS.', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Show Only The First Category', 'wpex' ),
                    'param_name'    => 'show_first_category_only',
                    'value'         => array(
                        __( 'No', 'wpex' )  => '',
                        __( 'Yes', 'wpex' ) => 'true',
                    ),
                    'dependency'    => array(
                        'element'   => 'show_categories',
                        'value'     => 'true',
                    ),
                    'group'         => __( 'Title', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Categories Font Size', 'wpex' ),
                    'param_name'        => 'categories_font_size',
                    'group'             => __( 'Title', 'wpex' ),
                    'dependency'        => array(
                        'element'   => 'show_categories',
                        'value'     => 'true',
                    ),
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Categories Margin', 'wpex' ),
                    'param_name'        => 'categories_margin',
                    'group'             => __( 'Title', 'wpex' ),
                    'dependency'        => array(
                        'element'   => 'show_categories',
                        'value'     => 'true',
                    ),
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),

                // Excerpt
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Excerpt', 'wpex' ),
                    'param_name'    => 'excerpt',
                    'value'         => array(
                        __( 'Yes', 'wpex')  => '',
                        __( 'No', 'wpex' )  => 'false',
                    ),
                    'group'         => __( 'Excerpt', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Custom Excerpt Length', 'wpex' ),
                    'param_name'    => 'excerpt_length',
                    'group'         => __( 'Excerpt', 'wpex' ),
                    'description'   => __( 'Enter how many words to display for the excerpt. To display the full post content enter "-1". To display the full post content up to the "more" tag enter "9999".', 'wpex' ),
                    'std'           => '30',
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Excerpt Text Color', 'wpex' ),
                    'param_name'    => 'content_color',
                    'group'         => __( 'Excerpt', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Excerpt Font Size', 'wpex' ),
                    'param_name'    => 'content_font_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'         => __( 'Excerpt', 'wpex' ),
                ),

                // Readmore
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
                    'description'       => __( 'Enter a value between "0" and "1".', 'wpex' ),
                    'group'             => __( 'Design', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),

            ),
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_portfolio_grid_shortcode_vc_map' );
<?php
/**
 * Registers the image grid shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_image_grid extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_image_grid.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_image_grid_shortcode_vc_map' ) ) {
    function vcex_image_grid_shortcode_vc_map() {

        vc_map( array(
            'name'                  => __( 'Image Grid', 'wpex' ),
            'description'           => __( 'Responsive image gallery', 'wpex' ),
            'base'                  => 'vcex_image_grid',
            'icon'                  => 'vcex-image-grid',
            'category'              => WPEX_THEME_BRANDING,
            'params'                => array(

                // Attach Images
                array(
                    'type'          => 'attach_images',
                    'admin_label'   => true,
                    'heading'       => __( 'Attach Images', 'wpex' ),
                    'param_name'    => 'image_ids',
                    'group'         => __( 'Images', 'wpex' ),
                    'description'   => __( 'Click the plus icon to add images to your gallery. Once images are added they can be drag and dropped for sorting.', 'wpex' ),
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
                    'type'          => 'dropdown',
                    'heading'       => __( 'Grid Style', 'wpex' ),
                    'param_name'    => 'grid_style',
                    'value'         => array(
                        __( 'Fit Rows', 'wpex' )    => 'default',
                        __( 'Masonry', 'wpex' )     => 'masonry',
                        __( 'No Margins', 'wpex' )  => 'no-margins',
                    ),
                    'edit_field_class'  => 'vc_col-sm-3 vc_column clear',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Columns', 'wpex' ),
                    'param_name'    => 'columns',
                    'std'           => '4',
                    'value'         => vcex_grid_columns(),
                    'edit_field_class'  => 'vc_col-sm-3 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Gap', 'wpex' ),
                    'param_name'        => 'columns_gap',
                    'value'             => vcex_column_gaps(),
                    'std'               => '',
                    'edit_field_class'  => 'vc_col-sm-3 vc_column',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Responsive', 'wpex' ),
                    'param_name'    => 'responsive_columns',
                    'std'           => '',
                    'value'         => array(
                        __( 'True', 'wpex' )    => '',
                        __( 'False', 'wpex' )   => 'false',
                    ),
                    'edit_field_class'  => 'vc_col-sm-3 vc_column',
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
                ),
                array(
                    'type'          => 'textfield',
                    'admin_label'   => true,
                    'heading'       => __( 'Images Per Page', 'wpex' ),
                    'param_name'    => 'posts_per_page',
                    'value'         => '-1',
                    'description'   => __( 'This will enable pagination for your gallery. Enter -1 or leave blank to display all images without pagination.', 'wpex' ),
                ),

                // Links
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Link', 'wpex' ),
                    'param_name'    => 'thumbnail_link',
                    'value'         => array(
                        __( 'None', 'wpex' )            => 'none',
                        __( 'Lightbox', 'wpex' )        => 'lightbox',
                        __( 'Attachment Page', 'wpex' ) => 'attachment_page',
                        __( 'Custom Links', 'wpex' )    => 'custom_link',
                    ),
                    'group'         => __( 'Links', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Lightbox Skin', 'wpex' ),
                    'param_name'    => 'lightbox_skin',
                    'std'           => '',
                    'value'         => vcex_ilightbox_skins(),
                    'group'         => __( 'Links', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'thumbnail_link',
                        'value'     => 'lightbox',
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Lightbox Thumbnails Placement', 'wpex' ),
                    'param_name'    => 'lightbox_path',
                    'value'         => array(
                        __( 'Horizontal', 'wpex' )  => '',
                        __( 'Vertical', 'wpex' )    => 'vertical',
                    ),
                    'group'         => __( 'Links', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'thumbnail_link',
                        'value'     => 'lightbox',
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Lightbox Title', 'wpex' ),
                    'param_name'    => 'lightbox_title',
                    'value'         => array(
                        __( 'Alt', 'wpex' )     => '',
                        __( 'Title', 'wpex' )   => 'title',
                        __( 'None', 'wpex' )    => 'false',
                    ),
                    'group'         => __( 'Links', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'thumbnail_link',
                        'value'     => 'lightbox',
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Lightbox Caption', 'wpex' ),
                    'param_name'    => 'lightbox_caption',
                    'value'         => array(
                        __( 'Enable', 'wpex' )      => 'true',
                        __( 'Disable', 'wpex' )     => 'false',
                    ),
                    'group'         => __( 'Links', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'thumbnail_link',
                        'value'     => 'lightbox',
                    ),
                ),
                array(
                    'type'          => 'exploded_textarea',
                    'heading'       => __( 'Custom links', 'wpex' ),
                    'param_name'    => 'custom_links',
                    'description'   => __( 'Enter links for each slide here. Divide links with linebreaks (Enter). For images without a link enter a # symbol. And don\'t forget to include the http:// at the front.', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'thumbnail_link',
                        'value'     => array( 'custom_link' )
                    ),
                    'group'         => __( 'Links', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Link Target', 'wpex' ),
                    'param_name'    => 'custom_links_target',
                    'group'         => __( 'Links', 'wpex' ),
                    'value'         => array(
                        __( 'Same window', 'wpex' ) => '_self',
                        __( 'New window', 'wpex' )  => '_blank'
                    ),
                    'dependency'    => Array(
                        'element'   => 'thumbnail_link',
                        'value'     => array( 'custom_link', 'attachment_page' ),
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
                    'group'             => __( 'Image', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'dependency'    => Array(
                        'element'   => 'img_size',
                        'value'     => 'wpex_custom',
                    ),
                    'description'       => __( 'Enter a width in pixels.', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Image Crop Height', 'wpex' ),
                    'param_name'    => 'img_height',
                    'description'   => __( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'wpex' ),
                    'group'         => __( 'Image', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'img_size',
                        'value'     => 'wpex_custom',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Rounded Image?', 'wpex' ),
                    'param_name'        => 'rounded_image',
                    'value'             => array(
                        __( 'No', 'wpex' )  => '',
                        __( 'Yes', 'wpex' ) => 'yes'
                    ),
                    'edit_field_class'  => 'vc_col-sm-3 vc_column clear',
                    'group'             => __( 'Image', 'wpex' ),
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

                // Title
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Title', 'wpex' ),
                    'param_name'    => 'title',
                    'std'           => '',
                    'value'         => array(
                        __( 'No', 'wpex' )  => '',
                        __( 'Yes', 'wpex' ) => 'yes'
                    ),
                    'group'         => __( 'Title', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Title Tag', 'wpex' ),
                    'param_name'        => 'title_tag',
                    'value'             => array(
                        __( 'Default', 'wpex' ) => '',
                        __( 'h2', 'wpex' )    => 'h2',
                        __( 'h3', 'wpex' )    => 'h3',
                        __( 'h4', 'wpex' )    => 'h4',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'dependency'        => Array(
                        'element'   => 'title',
                        'value'     => array( 'yes' )
                    ),
                    'group'             => __( 'Title', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Title Based On Image', 'wpex' ),
                    'param_name'        => 'title_type',
                    'value'             => array(
                        __( 'Default', 'wpex' )     => '',
                        __( 'Title', 'wpex' )       => 'title',
                        __( 'Alt', 'wpex' )         => 'alt',
                        __( 'Caption', 'wpex' )     => 'caption',
                        __( 'Description', 'wpex' ) => 'description',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'Title', 'wpex' ),
                    'dependency'        => Array(
                        'element'   => 'title',
                        'value'     => array( 'yes' )
                    ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Title Color', 'wpex' ),
                    'param_name'    => 'title_color',
                    'group'         => __( 'Title', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Title Font Size', 'wpex' ),
                    'param_name'        => 'title_size',
                    'group'             => __( 'Title', 'wpex' ),
                    'description'       => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
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
                    'group'             => __( 'Title', 'wpex' ),
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Title Font Weight', 'wpex' ),
                    'param_name'        => 'title_weight',
                    'group'             => __( 'Title', 'wpex' ),
                    'description'       => __( 'Note: Not all font families support every font weight.', 'wpex' ),
                    'std'               => '',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'value'             => vcex_font_weights(),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Title Text Transform', 'wpex' ),
                    'param_name'        => 'title_transform',
                    'group'             => __( 'Title', 'wpex' ),
                    'std'               => '',
                    'description'       => __( 'Select a custom text transform to override the default.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'value'             => vcex_text_transforms(),
                ),

                // Design Options
                array(
                    'type'          => 'css_editor',
                    'heading'       => __( 'CSS', 'wpex' ),
                    'param_name'    => 'css',
                    'description'   => __( 'These settings are applied to the main wrapper and they will override any other styling options.', 'wpex' ),
                    'group'         => __( 'Design options', 'wpex' ),
                ),

            )
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_image_grid_shortcode_vc_map' );
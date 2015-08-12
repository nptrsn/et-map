<?php
/**
 * Registers the image gallery slider shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_image_galleryslider extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_image_galleryslider.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_image_galleryslider_shortcode_vc_map' ) ) {
    function vcex_image_galleryslider_shortcode_vc_map() {
        vc_map( array(
            'name'                  => __( 'Gallery Slider', 'wpex' ),
            'description'           => __( 'Image slider with thumbnail navigation', 'wpex' ),
            'base'                  => 'vcex_image_galleryslider',
            'category'              => WPEX_THEME_BRANDING,
            'icon'                  => 'vcex-image-gallery-slider',
            'params'                => array(

                // Images
                array(
                    'type'          => 'attach_images',
                    'admin_label'   => true,
                    'heading'       => __( 'Attach Images', 'wpex' ),
                    'param_name'    => 'image_ids',
                    'description'   => __( 'You can display captions by giving your images a caption and you can also display videos by adding an image that has a Video URL defined for it.', 'wpex' ),
                    'group'         => __( 'Images', 'wpex' ),
                ),

                // General
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Visibility', 'wpex' ),
                    'param_name'    => 'visibility',
                    'value'         => vcex_visibility(),
                    'group'         => __( 'General', 'wpex' ),
                ),
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
                    'heading'       => __( 'Animation', 'wpex' ),
                    'param_name'    => 'animation',
                    'value'         => array(
                        __( 'Slide', 'wpex' )   => 'slide',
                        __( 'Fade', 'wpex' )    => 'fade_slides',
                    ),
                    'group'         => __( 'General', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Loop', 'wpex' ),
                    'param_name'    => 'loop',
                    'value'         => array(
                        __( 'No', 'wpex' )   => '',
                        __( 'Yes', 'wpex' )    => 'true',
                    ),
                    'group'         => __( 'General', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Auto Height Animation', 'wpex' ),
                    'std'               => '500',
                    'param_name'        => 'height_animation',
                    'group'             => __( 'General', 'wpex' ),
                    'description'       => __( 'You can enter "0.0" to disable the animation completely.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Animation Speed', 'wpex' ),
                    'param_name'        => 'animation_speed',
                    'std'               => '600',
                    'description'       => __( 'Enter a value in milliseconds.', 'wpex' ),
                    'group'             => __( 'General', 'wpex' ),
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
                    'group'             => __( 'General', 'wpex' ),
                     'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Auto Play Delay', 'wpex' ),
                    'param_name'        => 'slideshow_speed',
                    'std'               => '5000',
                    'description'       => __( 'Enter a value in milliseconds.', 'wpex' ),
                    'group'             => __( 'General', 'wpex' ),
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
                    'group'             => __( 'General', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Arrows on Hover', 'wpex' ),
                    'param_name'        => 'direction_nav_hover',
                    'value'             => array(
                        __( 'Yes', 'wpex' ) => '',
                        __( 'No', 'wpex' )  => 'false',
                    ),
                    'group'             => __( 'General', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Dot Navigation', 'wpex' ),
                    'param_name'        => 'control_nav',
                    'value'             => array(
                        __( 'Yes', 'wpex' ) => '',
                        __( 'No', 'wpex' )  => 'false',
                    ),
                    'group'             => __( 'General', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
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

                // Thumbnails
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Columns', 'wpex' ),
                    'param_name'    => 'thumbnails_columns',
                    'std'           => '',
                    'description'   => __( 'This specific slider displays the thumbnails in "rows" if you want your thumbnails displayed under the slider as a carousel, use the "Image Slider" module instead.', 'wpex' ),
                    'group'         => __( 'Thumbnails', 'wpex' ),
                    'value'         => array(
                        __( 'Default', 'wpex' ) => '',
                        '6'                     => 6,
                        '5'                     => 5,
                        '4'                     => 4,
                        '3'                     => 3,
                        '2'                     => 2,
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Image Crop Width', 'wpex' ),
                    'param_name'    => 'img_thumb_width',
                    'value'         => '',
                    'description'   => __( 'Enter a width in pixels for your thumbnail image width. This won\'t increase the grid, its only used so you can alter the cropping to your preferred proportions.', 'wpex' ),
                    'group'         => __( 'Thumbnails', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Image Crop Height', 'wpex' ),
                    'param_name'    => 'img_thumb_height',
                    'value'         => '',
                    'description'   => __( 'Enter a width in pixels for your thumbnail image height.', 'wpex' ),
                    'group'         => __( 'Thumbnails', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),

                // Caption
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Caption', 'wpex' ),
                    'param_name'    => 'caption',
                    'value'         => array(
                        __( 'Yes', 'wpex' ) => 'true',
                        __( 'No', 'wpex' )  => 'false',
                    ),
                    'group'         => __( 'Caption', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Caption Based On Image', 'wpex' ),
                    'param_name'        => 'caption_type',
                    'value'             => array(
                        __( 'Title', 'wpex' )       => 'title',
                        __( 'Caption', 'wpex' )     => 'caption',
                        __( 'Description', 'wpex' ) => 'description',
                        __( 'Alt', 'wpex' )         => 'alt',
                    ),
                    'dependency'    => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'group'             => __( 'Caption', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Caption Visibility', 'wpex' ),
                    'param_name'        => 'caption_visibility',
                    'value'             => vcex_visibility(),
                    'dependency'    => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'Caption', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Caption Style', 'wpex' ),
                    'param_name'    => 'caption_style',
                    'value'         => array(
                        __( 'Black', 'wpex' )   => 'black',
                        __( 'White', 'wpex' )   => 'white',
                    ),
                    'dependency'    => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'group'         => __( 'Caption', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Rounded Caption', 'wpex' ),
                    'param_name'    => 'caption_rounded',
                    'value'         => array(
                        __( 'No', 'wpex' )  => '',
                        __( 'Yes', 'wpex' ) => 'true',
                    ),
                    'dependency'    => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'group'         => __( 'Caption', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Caption Position', 'wpex' ),
                    'param_name'    => 'caption_position',
                    'std'           => 'up',
                    'value'         => array(
                        __( 'Bottom Center', 'wpex' )   => 'bottomCenter',
                        __( 'Bottom Left', 'wpex' )     => 'bottomLeft',
                        __( 'Bottom Right', 'wpex' )    => 'bottomRight',
                        __( 'Top Center', 'wpex' )      => 'topCenter',
                        __( 'Top Left', 'wpex' )        => 'topLeft',
                        __( 'Top Right', 'wpex' )       => 'topRight',
                        __( 'Center Center', 'wpex' )   => 'centerCenter',
                        __( 'Center Left', 'wpex' )     => 'centerLeft',
                        __( 'Center Right', 'wpex' )    => 'centerRight',
                    ),
                    'dependency'    => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'group'         => __( 'Caption', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Caption Show Transition', 'wpex' ),
                    'param_name'    => 'caption_show_transition',
                    'std'           => 'up',
                    'value'         => array(
                        __( 'None', 'wpex' )    => 'false',
                        __( 'Up', 'wpex' )      => 'up',
                        __( 'Down', 'wpex' )    => 'down',
                        __( 'Left', 'wpex' )    => 'left',
                        __( 'Right', 'wpex' )   => 'right',
                    ),
                    'dependency'    => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'group'         => __( 'Caption', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Caption Hide Transition', 'wpex' ),
                    'param_name'    => 'caption_hide_transition',
                    'std'           => 'down',
                    'value'         => array(
                        __( 'None', 'wpex' )    => 'false',
                        __( 'Up', 'wpex' )      => 'up',
                        __( 'Down', 'wpex' )    => 'down',
                        __( 'Left', 'wpex' )    => 'left',
                        __( 'Right', 'wpex' )   => 'right',
                    ),
                    'dependency'    => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'group'         => __( 'Caption', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Caption Width', 'wpex' ),
                    'param_name'        => 'caption_width',
                    'dependency'        => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'value'             => '100%',
                    'description'       => __( 'Enter a pixel or percentage value. You can also enter "auto" for content dependent width.', 'wpex' ),
                    'group'             => __( 'Caption', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Caption Font-Size', 'wpex' ),
                    'param_name'        => 'caption_font_size',
                    'dependency'        => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'description'       => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'             => __( 'Caption', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Caption Padding', 'wpex' ),
                    'param_name'        => 'caption_padding',
                    'dependency'        => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'             => __( 'Caption', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Caption Horizontal Offset', 'wpex' ),
                    'param_name'        => 'caption_horizontal',
                    'dependency'        => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'group'             => __( 'Caption', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                    'description'       => __( 'Please enter a px value.', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Caption Vertical Offset', 'wpex' ),
                    'param_name'        => 'caption_vertical',
                    'dependency'        => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'group'             => __( 'Caption', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                    'description'       => __( 'Please enter a px value.', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Caption Delay', 'wpex' ),
                    'param_name'        => 'caption_delay',
                    'std'               => '500',
                    'dependency'    => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'group'         => __( 'Caption', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                    'description'       => __( 'Enter a value in milliseconds.', 'wpex' ),
                ),

                // Links
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Link', 'wpex' ),
                    'param_name'    => 'thumbnail_link',
                    'value'         => array(
                        __( 'None', 'wpex' )            => '',
                        __( 'Lightbox', 'wpex' )        => 'lightbox',
                        __( 'Custom Links', 'wpex' )    => 'custom_link',
                    ),
                    'group'         => __( 'Links', 'wpex' ),
                ),
                array(
                    'type'          => 'exploded_textarea',
                    'heading'       => __( 'Custom links', 'wpex' ),
                    'param_name'    => 'custom_links',
                    'description'   => __( 'Enter links for each slide here. Divide links with linebreaks (Enter). For images without a link enter a # symbol.', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'thumbnail_link',
                        'value'     => array( 'custom_link' )
                    ),
                    'group'         => __( 'Links', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __('Custom link target', 'wpex' ),
                    'param_name'    => 'custom_links_target',
                    'dependency'    => Array(
                        'element'   => 'thumbnail_link',
                        'value'     => 'custom_link',
                    ),
                    'value'         => array(
                        __( 'Same window', 'wpex' ) => '',
                        __( 'New window', 'wpex' )  => '_blank'
                    ),
                    'group'         => __( 'Links', 'wpex' ),
                ),
                                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Lightbox Skin', 'wpex' ),
                    'param_name'    => 'lightbox_skin',
                    'value'         => vcex_ilightbox_skins(),
                    'group'         => __( 'Links', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'thumbnail_link',
                        'value'     => array( 'lightbox' ),
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
                        'value'     => array( 'lightbox' ),
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Lightbox Title', 'wpex' ),
                    'param_name'    => 'lightbox_title',
                    'value'         => array(
                        __( 'None', 'wpex' )    => '',
                        __( 'Alt', 'wpex' )     => 'alt',
                        __( 'Title', 'wpex' )   => 'title',
                    ),
                    'group'         => __( 'Links', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'thumbnail_link',
                        'value'     => array( 'lightbox' ),
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Lightbox Caption', 'wpex' ),
                    'param_name'    => 'lightbox_caption',
                    'value'         => array(
                        __( 'Enable', 'wpex' )      => '',
                        __( 'Disable', 'wpex' )     => 'false',
                    ),
                    'group'         => __( 'Links', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'thumbnail_link',
                        'value'     => array( 'lightbox' ),
                    ),
                ),

                // Design options
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
add_action( 'vc_before_init', 'vcex_image_galleryslider_shortcode_vc_map' );
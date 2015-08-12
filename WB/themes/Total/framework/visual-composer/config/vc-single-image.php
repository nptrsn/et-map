<?php
/**
 * Visual Composer Single Image Configuration
 *
 * @package     Total
 * @subpackage  Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 2.0.1
 * @version     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Start Class
if ( ! class_exists( 'WPEX_VC_Single_Image_Config' ) ) {
    
    class WPEX_VC_Single_Image_Config {

        /**
         * Main constructor
         *
         * @since Total 2.0.0
         */
        function __construct() {
            add_filter( 'admin_init', array( &$this, 'add_params' ) );
        }

        /**
         * Adds new params for the VC Single_Images
         *
         * @since Total 2.0.0
         */
        public static function add_params() {

            vc_add_param( 'vc_single_image', array(
                'type'          => 'dropdown',
                'heading'       => __( 'Image alignment', 'wpex' ),
                'param_name'    => 'alignment',
                'value'         => vcex_alignments(),
                'description'   => __( 'Select image alignment.', 'wpex' )
            ) );

            if ( function_exists( 'vcex_image_hovers' ) ) {
                vc_add_param( 'vc_single_image', array(
                    'type'          => 'dropdown',

                    'heading'       => __( 'CSS3 Image Link Hover', 'wpex' ),
                    'param_name'    => 'img_hover',
                    'value'         => vcex_image_hovers(),
                    'description'   => __( 'Select your preferred image hover effect. Please note this will only work if the image links to a URL or a large version of itself. Please note these effects may not work in all browsers.', 'wpex' ),
                ) );
            }

            if ( function_exists( 'vcex_image_filters' ) ) {
                vc_add_param( 'vc_single_image', array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Filter', 'wpex' ),
                    'param_name'    => 'img_filter',
                    'value'         => vcex_image_filters(),
                    'description'   => __( 'Select an image filter style.', 'wpex' ),
                ) );
            }

            vc_add_param( 'vc_single_image', array(
                'type'          => 'checkbox',
                'heading'       => __( 'Rounded Image?', 'wpex' ),
                'param_name'    => 'rounded_image',
                'value'         => Array(
                    __( 'Yes please.', 'wpex' ) => 'yes'
                ),
                'description'   => __( 'For truely rounded images make sure your images are cropped to the same width and height.', 'wpex' ),
            ) );

            vc_add_param( 'vc_single_image', array(
                'type'          => 'textfield',
                'heading'       => __( 'Image Link Caption', 'wpex' ),
                'param_name'    => 'img_caption',
                'description'   => __( 'Use this field to add a caption to any single image with a link.', 'wpex' ),
            ) );

            vc_add_param( 'vc_single_image', array(
                'type'          => 'textfield',
                'heading'       => __( 'Video, SWF, Flash, URL Lightbox', 'wpex' ),
                'param_name'    => 'lightbox_video',
                'description'   => __( 'Enter the URL to a video, SWF file, flash file or a website URL to open in lightbox.', 'wpex' ),
                'group'         => __( 'Custom Lightbox', 'wpex' ),
            ) );

            vc_add_param( 'vc_single_image', array(
                'type'          => 'dropdown',
                'heading'       => __( 'Lightbox Type', 'wpex' ),
                'param_name'    => 'lightbox_iframe_type',
                'value'         => array(
                    __( 'Auto Detect', 'wpex' )                     => '',
                    __( 'URL', 'wpex' )                             => 'url',
                    __( 'Youtube, Vimeo, Embed or Iframe', 'wpex' ) => 'video_embed',
                    __( 'HTML5', 'wpex' )                           => 'html5',
                    __( 'Quicktime', 'wpex' )                       => 'quicktime',
                ),
                'description'   => __( 'Auto detect depends on the iLightbox API, so by choosing your type it speeds things up and you also allows for HTTPS support.', 'wpex' ),
                'group'         => __( 'Custom Lightbox', 'wpex' ),
                'dependency'    => Array(
                    'element'   => 'lightbox_video',
                    'not_empty' => true,
                ),
            ) );

            vc_add_param( 'vc_single_image', array(
                'type'          => 'textfield',
                'heading'       => __( 'HTML5 Webm URL', 'wpex' ),
                'param_name'    => 'lightbox_video_html5_webm',
                'description'   => __( 'Enter the URL to a video, SWF file, flash file or a website URL to open in lightbox.', 'wpex' ),
                'group'         => __( 'Custom Lightbox', 'wpex' ),
                'dependency'    => Array(
                    'element'   => 'lightbox_iframe_type',
                    'value'     => 'html5',
                ),
            ) );

            vc_add_param( 'vc_single_image', array(
                'type'          => 'textfield',
                'heading'       => __( 'Lightbox Dimensions', 'wpex' ),
                'param_name'    => 'lightbox_dimensions',
                'description'   => __( 'Enter a custom width and height for your lightbox pop-up window. Use format widthxheight. Example: 900x600.', 'wpex' ),
                'group'         => __( 'Custom Lightbox', 'wpex' ),
            ) );

            vc_add_param( 'vc_single_image', array(
                'type'          => 'attach_image',
                'admin_label'   => false,
                'heading'       => __( 'Custom Image Lightbox', 'wpex' ),
                'param_name'    => 'lightbox_custom_img',
                'description'   => __( 'Select a custom image to open in lightbox format', 'wpex' ),
                'group'         => __( 'Custom Lightbox', 'wpex' ),
            ) );

            vc_add_param( 'vc_single_image', array(
                'type'          => 'attach_images',
                'admin_label'   => false,
                'heading'       => __( 'Gallery Lightbox', 'wpex' ),
                'param_name'    => 'lightbox_gallery',
                'description'   => __( 'Select images to create a lightbox Gallery.', 'wpex' ),
                'group'         => __( 'Custom Lightbox', 'wpex' ),
            ) );

        }

    }

}
new WPEX_VC_Single_Image_Config();
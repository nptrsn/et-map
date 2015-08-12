<?php
/**
 * Registers the image swap shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_image_swap extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_image_swap.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_image_swap_shortcode_vc_map' ) ) {
    function vcex_image_swap_shortcode_vc_map() {
        $vc_img_rendering_url = 'https://developer.mozilla.org/en-US/docs/Web/CSS/image-rendering';
        vc_map( array(
            'name'                  => __( 'Image Swap', 'wpex' ),
            'description'           => __( 'Double Image Hover Effect', 'wpex' ),
            'base'                  => 'vcex_image_swap',
            'icon'                  => 'vcex-image-swap',
            'category'              => WPEX_THEME_BRANDING,
            'params'                => array(

                // General
                array(
                    'type'              => 'attach_image',
                    'heading'           => __( 'Primary Image', 'wpex' ),
                    'param_name'        => 'primary_image',
                ),
                array(
                    'type'              => 'attach_image',
                    'heading'           => __( 'Secondary Image', 'wpex' ),
                    'param_name'        => 'secondary_image',
                ),
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
                    'type'          => 'dropdown',
                    'heading'       => __( 'Appear Animation', 'wpex'),
                    'param_name'    => 'css_animation',
                    'value'         => vcex_css_animations(),
                    'description'   => __( 'If the "filter" is enabled animations will be disabled to prevent bugs.', 'wpex' ),
                ),
                
                // Image Cropping
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Container Width', 'wpex' ),
                    'param_name'    => 'container_width',
                    'group'         => __( 'Image', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Border Radius', 'wpex' ),
                    'param_name'    => 'border_radius',
                    'description'   => __( 'Please enter a px value.', 'wpex' ),
                    'group'         => __( 'Image', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Image Crop Width', 'wpex' ),
                    'param_name'    => 'img_width',
                    'description'   => __( 'Enter a width in pixels.', 'wpex' ),
                    'group'         => __( 'Image', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Image Crop Height', 'wpex' ),
                    'param_name'    => 'img_height',
                    'description'   => __( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'wpex' ),
                    'group'         => __( 'Image', 'wpex' ),
                ),

                // Link
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Link', 'wpex' ),
                    'param_name'    => 'link',
                    'group'         => __( 'Link', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Link Title', 'wpex' ),
                    'param_name'    => 'link_title',
                    'group'         => __( 'Link', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Link Target', 'wpex' ),
                    'param_name'    => 'link_target',
                    'value'         => array(
                        __( 'Same window', 'wpex' ) => '',
                        __( 'New window', 'wpex' )  => '_blank'
                    ),
                    'group'         => __( 'Link', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Enable Tooltip?', 'wpex' ),
                    'param_name'    => 'link_tooltip',
                    'value'         => array(
                        __( 'No', 'wpex' )  => '',
                        __( 'Yes', 'wpex' ) => 'true'
                    ),
                    'group'         => __( 'Link', 'wpex' ),
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
add_action( 'vc_before_init', 'vcex_image_swap_shortcode_vc_map' );
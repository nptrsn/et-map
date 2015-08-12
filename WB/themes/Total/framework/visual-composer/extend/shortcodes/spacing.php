<?php
/**
 * Registers the skillbar shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_spacing extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_spacing.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_spacing_shortcode_vc_map' ) ) {
    function vcex_spacing_shortcode_vc_map() {
        vc_map( array(
            'name'                  => __( 'Spacing', 'wpex' ),
            'description'           => __( 'Adds spacing anywhere you need it.', 'wpex' ),
            'base'                  => 'vcex_spacing',
            'category'              => WPEX_THEME_BRANDING,
            'icon'                  => 'vcex-spacing',
            'params'                => array(
                array(
                    'type'          => 'textfield',
                    'admin_label'   => true,
                    'heading'       => __( 'Spacing', 'wpex' ),
                    'param_name'    => 'size',
                    'value'         => '30px',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Custom Classes', 'wpex' ),
                    'param_name'    => 'class',
                    'description'   => __( 'Add additonal classes to the main element.', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Visibility', 'wpex' ),
                    'param_name'    => 'visibility',
                    'value'         => vcex_visibility(),
                ),
            )
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_spacing_shortcode_vc_map' );
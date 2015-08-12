<?php
/**
 * Registers the social links shortcode and adds it to the Visual Composer
 *
 * @package     Total
 * @subpackage  Framework/Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 2.0.0
 * @version     1.0.0
 */

/**
 * Register shortcode with VC Composer
 *
 * @since Total 2.0.0
 */
class WPBakeryShortCode_vcex_social_links extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_social_links.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 2.0.0
 */
if ( ! function_exists( 'vcex_social_links_shortcode_vc_map' ) ) {
    function vcex_social_links_shortcode_vc_map() {

        // Define params var
        $params = array(
            array(
                'type'          => 'textfield',
                'heading'       => __( 'Unique Id', 'wpex' ),
                'description'   => __( 'Give your main element a unique ID.', 'wpex' ),
                'param_name'    => 'unique_id',
            ),
            array(
                'type'          => 'textfield',
                'heading'       => __( 'Classes', 'wpex' ),
                'param_name'    => 'classes',
                'description'   => __( 'Add extra classnames to the wrapper.', 'wpex' ),
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
        );

        // Get array of social links to loop through
        $social_links = vcex_social_links_profiles();

        // Loop through social links and add to params
        foreach ( $social_links as $key => $val ) {

            $desc = ( 'email' == $key ) ? __( 'Format: mailto:email@site.com', 'wpex' ) : '';

            $params[] = array(
                'type'          => 'textfield',
                'heading'       => $val['label'],
                'param_name'    => $key,
                'group'         => __( 'Profiles', 'wpex' ),
                'description'   => $desc,
            );

        }

        // Add CSS option
        $params[] = array(
            'type'          => 'css_editor',
            'heading'       => __( 'CSS', 'wpex' ),
            'param_name'    => 'css',
            'group'         => __( 'Design', 'wpex' ),
        );

        $params[] = array(
            'type'          => 'dropdown',
            'heading'       => __( 'Align', 'wpex' ),
            'param_name'    => 'align',
            'value'         => vcex_alignments(),
            'group'         => __( 'Design', 'wpex' ),
        );

        $params[] = array(
            'type'          => 'textfield',
            'heading'       => __( 'Size', 'wpex' ),
            'param_name'    => 'size',
            'group'         => __( 'Design', 'wpex' ),
            'description'   => __( 'You can use em or px values, but you must define them.', 'wpex' ),
        );

         $params[] = array(
            'type'          => 'textfield',
            'heading'       => __( 'Border Radius', 'wpex' ),
            'param_name'    => 'border_radius',
            'group'         => __( 'Design', 'wpex' ),
            'description'   => __( 'Please enter a px value.', 'wpex' ),
        );

        $params[] = array(
            'type'          => 'colorpicker',
            'heading'       => __( 'Color', 'wpex' ),
            'param_name'    => 'color',
            'group'         => __( 'Design', 'wpex' ),
        );

        $params[] = array(
            'type'          => 'colorpicker',
            'heading'       => __( 'Hover Background', 'wpex' ),
            'param_name'    => 'hover_bg',
            'group'         => __( 'Design', 'wpex' ),
        );

        $params[] = array(
            'type'          => 'colorpicker',
            'heading'       => __( 'Hover Color', 'wpex' ),
            'param_name'    => 'hover_color',
            'group'         => __( 'Design', 'wpex' ),
        );

        // Add to VC
        vc_map( array(
            'name'                  => __( 'Social Links', 'wpex' ),
            'description'           => __( 'Display social links using icon fonts.', 'wpex' ),
            'base'                  => 'vcex_social_links',
            'category'              => WPEX_THEME_BRANDING,
            'icon'                  => 'vcex-social-links',
            'params'                => $params,
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_social_links_shortcode_vc_map' );
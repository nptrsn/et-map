<?php
/**
 * Registers the callout shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_callout extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_callout.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_callout_shortcode_vc_map' ) ) {
    function vcex_callout_shortcode_vc_map() {
        vc_map( array(
            'name'          => __( 'Callout', 'wpex' ),
            'description'   => __( 'Call to action section with or without button.', 'wpex' ),
            'base'          => 'vcex_callout',
            'icon'          => 'vcex-callout',
            'category'      => WPEX_THEME_BRANDING,
            'params'        => array(
                array(
                    'type'          => 'textfield',
                    'admin_label'   => true,
                    'heading'       => __( 'Unique Id', 'wpex' ),
                    'description'   => __( 'Give your main element a unique ID.', 'wpex' ),
                    'param_name'    => 'unique_id',
                ),
                array(
                    'type'          => 'textfield',
                    'admin_label'   => true,
                    'heading'       => __( 'Classes', 'wpex' ),
                    'description'   => __( 'Add additonal classes to the main element.', 'wpex' ),
                    'param_name'    => 'classes',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Visibility', 'wpex' ),
                    'param_name'        => 'visibility',
                    'value'             => vcex_visibility(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Appear Animation', 'wpex' ),
                    'param_name'        => 'css_animation',
                    'value'             => vcex_css_animations(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),

                // Content
                array(
                    'type'          => 'textarea_html',
                    'holder'        => 'div',
                    'class'         => 'vcex-callout',
                    'heading'       => __( 'Callout Content', 'wpex' ),
                    'param_name'    => 'content',
                    'value'         => __( 'Enter your content here.', 'wpex' ),
                    'group'         => __( 'Content', 'wpex' ),
                ),

                // Button
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Button: URL', 'wpex' ),
                    'param_name'    => 'button_url',
                    'group'         => __( 'Button', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Button: Text', 'wpex' ),
                    'param_name'    => 'button_text',
                    'group'         => __( 'Button', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Button Style', 'wpex' ),
                    'param_name'        => 'button_style',
                    'value'             => vcex_button_styles(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'Button', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Button: Color', 'wpex' ),
                    'param_name'        => 'button_color',
                    'std'               => 'blue',
                    'value'             => vcex_button_colors(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'Button', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Button: Border Radius', 'wpex' ),
                    'param_name'    => 'button_border_radius',
                    'description'   => __( 'Please enter a px value.', 'wpex' ),
                    'group'         => __( 'Button', 'wpex' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Button: Link Target', 'wpex' ),
                    'param_name'        => 'button_target',
                    'value'             => array(
                        __( 'Self', 'wpex' )    => '',
                        __( 'Blank', 'wpex' )   => 'blank',
                    ),
                    'group'             => __( 'Button', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Button: Rel', 'wpex' ),
                    'param_name'        => 'button_rel',
                    'value'             => array(
                        __( 'None', 'wpex' )        => 'none',
                        __( 'Nofollow', 'wpex' )    => 'nofollow',
                    ),
                    'group'             => __( 'Button', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Button: Icon Left', 'wpex' ),
                    'param_name'        => 'button_icon_left',
                    'value'             => wpex_get_awesome_icons(),
                    'group'             => __( 'Button', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Button: Icon Right', 'wpex' ),
                    'param_name'        => 'button_icon_right',
                    'value'             => wpex_get_awesome_icons(),
                    'group'             => __( 'Button', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'css_editor',
                    'heading'       => __( 'CSS', 'wpex' ),
                    'param_name'    => 'css',
                    'group'         => __( 'Design options', 'wpex' ),
                ),
            )
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_callout_shortcode_vc_map' );
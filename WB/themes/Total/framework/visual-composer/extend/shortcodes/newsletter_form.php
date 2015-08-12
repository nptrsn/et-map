<?php
/**
 * Registers the newsletter form shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_newsletter_form extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_newsletter_form.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_newsletter_form_shortcode_vc_map' ) ) {
    function vcex_newsletter_form_shortcode_vc_map() {

        // VC Map
        vc_map( array(
            'name'                  => __( 'Mailchimp Form', 'wpex' ),
            'description'           => __( 'Newsletter subscription form', 'wpex' ),
            'base'                  => 'vcex_newsletter_form',
            'category'              => WPEX_THEME_BRANDING,
            'icon'                  => 'vcex-newsletter',
            'params'                => array(

                // General
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
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'CSS Animation', 'wpex' ),
                    'param_name'        => 'css_animation',
                    'value'             => vcex_css_animations(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Mailchimp Form Action', 'wpex' ),
                    'param_name'    => 'mailchimp_form_action',
                    'value'         => 'http://domain.us1.list-manage.com/subscribe/post?u=numbers_go_here',
                    'description'   => __( 'Enter the MailChimp form action URL.', 'wpex' ) .' <a href="http://docs.shopify.com/support/configuration/store-customization/where-do-i-get-my-mailchimp-form-action?ref=wpexplorer" target="_blank">'. __( 'Learn More', 'wpex' ) .' &rarr;</a>',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Placeholder Text', 'wpex' ),
                    'param_name'    => 'placeholder_text',
                    'std'           => __( 'Enter your email address','wpex'),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Submit Button Text', 'wpex' ),
                    'param_name'    => 'submit_text',
                    'std'           => __( 'Go', 'wpex' ),
                ),

                // Input
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Background', 'wpex' ),
                    'param_name'    => 'input_bg',
                    'dependency'    => Array(
                        'element'   => 'mailchimp_form_action',
                        'not_empty' => true
                    ),
                    'group'         => __( 'Input', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Color', 'wpex' ),
                    'param_name'    => 'input_color',
                    'group'         => __( 'Input', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Width', 'wpex' ),
                    'param_name'        => 'input_width',
                    'description'       => __( 'Enter a pixel or percentage value.', 'wpex' ),
                    'group'             => __( 'Input', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Height', 'wpex' ),
                    'param_name'        => 'input_height',
                    'description'       => __( 'Please enter a px value.', 'wpex' ),
                    'group'             => __( 'Input', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Padding', 'wpex' ),
                    'param_name'        => 'input_padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'             => __( 'Input', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Border', 'wpex' ),
                    'param_name'        => 'input_border',
                    'description'       => __( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'wpex' ),
                    'group'             => __( 'Input', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Border Radius', 'wpex' ),
                    'param_name'        => 'input_border_radius',
                    'description'       => __( 'Please enter a px value.', 'wpex' ),
                    'group'             => __( 'Input', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Font Size', 'wpex' ),
                    'param_name'        => 'input_font_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'             => __( 'Input', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Letter Spacing', 'wpex' ),
                    'param_name'        => 'input_letter_spacing',
                    'description'       => __( 'Please enter a px value.', 'wpex' ),
                    'group'             => __( 'Input', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Font Weight', 'wpex' ),
                    'param_name'        => 'input_weight',
                    'group'             => __( 'Input', 'wpex' ),
                    'std'               => '',
                    'description'       => __( 'Note: Not all font families support every font weight.', 'wpex' ),
                    'value'             => vcex_font_weights(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Text Transform', 'wpex' ),
                    'param_name'        => 'input_transform',
                    'group'             => __( 'Input', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'value'             => vcex_text_transforms(),
                ),

                // Submit
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Background', 'wpex' ),
                    'param_name'    => 'submit_bg',
                    'group'         => __( 'Submit', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Background: Hover', 'wpex' ),
                    'param_name'    => 'submit_hover_bg',
                    'group'         => __( 'Submit', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Color', 'wpex' ),
                    'param_name'    => 'submit_color',
                    'group'         => __( 'Submit', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Color: Hover', 'wpex' ),
                    'param_name'    => 'submit_hover_color',
                    'group'         => __( 'Submit', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Position Right', 'wpex' ),
                    'param_name'        => 'submit_position_right',
                    'std'               => '20px',
                    'group'             => __( 'Submit', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Height', 'wpex' ),
                    'param_name'        => 'submit_height',
                    'std'               => '30px',
                    'group'             => __( 'Submit', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Padding', 'wpex' ),
                    'param_name'        => 'submit_padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'             => __( 'Submit', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Border', 'wpex' ),
                    'param_name'        => 'submit_border',
                    'description'       => __( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'wpex' ),
                    'group'             => __( 'Submit', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Border Radius', 'wpex' ),
                    'param_name'        => 'submit_border_radius',
                    'description'       => __( 'Please enter a px value.', 'wpex' ),
                    'group'             => __( 'Submit', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Font Size', 'wpex' ),
                    'param_name'        => 'submit_font_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'             => __( 'Submit', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Letter Spacing', 'wpex' ),
                    'param_name'        => 'submit_letter_spacing',
                    'description'       => __( 'Please enter a px value.', 'wpex' ),
                    'group'             => __( 'Submit', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Font Weight', 'wpex' ),
                    'param_name'        => 'submit_weight',
                    'group'             => __( 'Submit', 'wpex' ),
                    'std'               => '',
                    'description'       => __( 'Note: Not all font families support every font weight.', 'wpex' ),
                    'value'             => vcex_font_weights(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Text Transform', 'wpex' ),
                    'param_name'        => 'submit_transform',
                    'group'             => __( 'Submit', 'wpex' ),
                    'std'               => '',
                    'value'             => vcex_text_transforms(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
            )

        ) );
    }
}
add_action( 'vc_before_init', 'vcex_newsletter_form_shortcode_vc_map' );
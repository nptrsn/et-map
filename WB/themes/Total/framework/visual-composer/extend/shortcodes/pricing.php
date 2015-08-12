<?php
/**
 * Registers the pricing shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_pricing extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_pricing.php' ) );
        return ob_get_clean();
    }
}

/**
 * Parse shortcode attributes and set correct values
 *
 * @since Total 2.0.0
 */
function parse_vcex_pricing_atts( $atts ) {

    // Convert textfield link to vc_link
    if ( ! empty( $atts['button_url'] ) && false === strpos( $atts['button_url'], 'url:' ) ) {
        $url                = 'url:'. $atts['button_url'] .'|';
        $atts['button_url'] = $url;
    }

    // Return $atts
    return $atts;
}
add_filter( 'vc_edit_form_fields_attributes_vcex_pricing', 'parse_vcex_pricing_atts' );

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_pricing_shortcode_vc_map' ) ) {
    function vcex_pricing_shortcode_vc_map() {

        vc_map( array(
            'name'                  => __( 'Pricing Table', 'wpex' ),
            'description'           => __( 'Insert a pricing column', 'wpex' ),
            'base'                  => 'vcex_pricing',
            'category'              => WPEX_THEME_BRANDING,
            'icon'                  => 'vcex-pricing',
            'admin_enqueue_css'     => wpex_font_awesome_css_url(),
            'front_enqueue_css'     => wpex_font_awesome_css_url(),
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
                    'heading'       => __( 'Classes', 'wpex' ),
                    'param_name'    => 'el_class',
                    'description'   => __( 'Add additonal classes to the main element.', 'wpex' ),
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

                // Plan
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Featured', 'wpex' ),
                    'param_name'    => 'featured',
                    'value'         => array(
                        __( 'No', 'wpex' )  => 'no',
                        __( 'Yes', 'wpex')  => 'yes',
                    ),
                    'group'         => __( 'Plan', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Plan', 'wpex' ),
                    'param_name'    => 'plan',
                    'group'         => __( 'Plan', 'wpex' ),
                    'std'           => __( 'Basic', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Plan Background Color', 'wpex' ),
                    'param_name'    => 'plan_background',
                    'group'         => __( 'Plan', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'plan',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Plan Font Color', 'wpex' ),
                    'param_name'    => 'plan_color',
                    'group'         => __( 'Plan', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'plan',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Plan Font Weight', 'wpex' ),
                    'param_name'    => 'plan_weight',
                    'description'   => __( 'Note: Not all font families support every font weight.', 'wpex' ),
                    'std'           => '',
                    'value'         => vcex_font_weights(),
                    'group'         => __( 'Plan', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'plan',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Plan Text Transform', 'wpex' ),
                    'param_name'    => 'plan_text_transform',
                    'std'           => '',
                    'value'         => vcex_text_transforms(),
                    'group'         => __( 'Plan', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'plan',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Plan Font Size', 'wpex' ),
                    'param_name'        => 'plan_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'             => __( 'Plan', 'wpex' ),
                    'dependency'        => Array(
                        'element'   => 'plan',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Plan Letter Spacing', 'wpex' ),
                    'param_name'        => 'plan_letter_spacing',
                    'group'             => __( 'Plan', 'wpex' ),
                    'dependency'        => Array(
                        'element'   => 'plan',
                        'not_empty' => true,
                    ),
                    'description'       => __( 'Please enter a px value.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Plan Padding', 'wpex' ),
                    'param_name'        => 'plan_padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'             => __( 'Plan', 'wpex' ),
                    'dependency'        => Array(
                        'element'   => 'plan',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Plan Margin', 'wpex' ),
                    'param_name'    => 'plan_margin',
                    'description'   => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'         => __( 'Plan', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'plan',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Plan Border', 'wpex' ),
                    'param_name'    => 'plan_border',
                    'description'   => __( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'wpex' ),
                    'group'         => __( 'Plan', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'plan',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),

                // Cost
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Cost', 'wpex' ),
                    'param_name'    => 'cost',
                    'group'         => __( 'Cost', 'wpex' ),
                    'std'           => '$20',
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Cost Background Color', 'wpex' ),
                    'param_name'    => 'cost_background',
                    'group'         => __( 'Cost', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'cost',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Cost Font Color', 'wpex' ),
                    'param_name'    => 'cost_color',
                    'group'         => __( 'Cost', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'cost',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Cost Font Weight', 'wpex' ),
                    'param_name'    => 'cost_weight',
                    'description'   => __( 'Note: Not all font families support every font weight.', 'wpex' ),
                    'std'           => '',
                    'value'         => vcex_font_weights(),
                    'group'         => __( 'Cost', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'cost',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Cost Font Size', 'wpex' ),
                    'param_name'    => 'cost_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'         => __( 'Cost', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'cost',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Cost Padding', 'wpex' ),
                    'param_name'        => 'cost_padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'             => __( 'Cost', 'wpex' ),
                    'dependency'        => Array(
                        'element'   => 'cost',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Cost Border', 'wpex' ),
                    'param_name'        => 'cost_border',
                    'description'       => __( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'wpex' ),
                    'group'             => __( 'Cost', 'wpex' ),
                    'dependency'        => Array(
                        'element'   => 'cost',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),

                // Per
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Per', 'wpex' ),
                    'param_name'    => 'per',
                    'group'         => __( 'Per', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Per Display', 'wpex' ),
                    'param_name'    => 'per_display',
                    'value'         => array(
                        __( 'Default', 'wpex' )         => '',
                        __( 'Inline', 'wpex' )          => 'inline',
                        __( 'Block', 'wpex' )           => 'block',
                        __( 'Inline-Block', 'wpex' )    => 'inline-block',
                    ),
                    'group'         => __( 'Per', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'per',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Per Font Color', 'wpex' ),
                    'param_name'    => 'per_color',
                    'group'         => __( 'Per', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'per',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Per Font Weight', 'wpex' ),
                    'param_name'        => 'per_weight',
                    'description'       => __( 'Note: Not all font families support every font weight.', 'wpex' ),
                    'std'               => '',
                    'value'             => vcex_font_weights(),
                    'group'             => __( 'Per', 'wpex' ),
                    'dependency'        => Array(
                        'element'   => 'per',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Per Text Transform', 'wpex' ),
                    'param_name'        => 'per_transform',
                    'group'             => __( 'Per', 'wpex' ),
                    'value'             => vcex_text_transforms(),
                    'dependency'        => Array(
                        'element'   => 'per',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Per Font Size', 'wpex' ),
                    'param_name'    => 'per_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'         => __( 'Per', 'wpex' ),
                    'dependency'    => Array(
                        'element'   => 'per',
                        'not_empty' => true,
                    ),
                ),

                // Features
                array(
                    'type'          => 'textarea_html',
                    'heading'       => __( 'Features', 'wpex' ),
                    'param_name'    => 'content',
                    'value'         => '<ul>
                                            <li>30GB Storage</li>
                                            <li>512MB Ram</li>
                                            <li>10 databases</li>
                                            <li>1,000 Emails</li>
                                            <li>25GB Bandwidth</li>
                                        </ul>',
                    'description'   => __('Enter your pricing content. You can use a UL list as shown by default but anything would really work!','wpex'),
                    'group'         => __( 'Features', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Features Font Color', 'wpex' ),
                    'param_name'    => 'font_color',
                    'group'         => __( 'Features', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Features Background', 'wpex' ),
                    'param_name'    => 'features_bg',
                    'group'         => __( 'Features', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Features Font Size', 'wpex' ),
                    'param_name'        => 'font_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'             => __( 'Features', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Features Padding', 'wpex' ),
                    'param_name'        => 'features_padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'             => __( 'Features', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Features Border', 'wpex' ),
                    'param_name'        => 'features_border',
                    'description'       => __( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'wpex' ),
                    'group'             => __( 'Features', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),

                // Button
                array(
                    'type'          => 'vc_link',
                    'heading'       => __( 'Button URL', 'wpex' ),
                    'param_name'    => 'button_url',
                    'group'         => __( 'Button', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Button Text', 'wpex' ),
                    'param_name'        => 'button_text',
                    'group'             => __( 'Button', 'wpex' ),
                ),
                array(
                    'type'              => 'colorpicker',
                    'heading'           => __( 'Button Area Background', 'wpex' ),
                    'param_name'        => 'button_wrap_bg',
                    'group'             => __( 'Button', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Button Area Padding', 'wpex' ),
                    'param_name'        => 'button_wrap_padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'             => __( 'Button', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Button Area Border', 'wpex' ),
                    'param_name'        => 'button_wrap_border',
                    'description'       => __( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'wpex' ),
                    'group'             => __( 'Button', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Button Style', 'wpex' ),
                    'param_name'        => 'button_style',
                    'value'             => vcex_button_styles(),
                    'group'             => __( 'Button', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Button Color', 'wpex' ),
                    'param_name'        => 'button_style_color',
                    'value'             => vcex_button_colors(),
                    'group'             => __( 'Button', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'colorpicker',
                    'heading'           => __( 'Button Background Color', 'wpex' ),
                    'param_name'        => 'button_bg_color',
                    'group'             => __( 'Button', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Button Background Hover Color', 'wpex' ),
                    'param_name'    => 'button_hover_bg_color',
                    'group'         => __( 'Button', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Button Text Color', 'wpex' ),
                    'param_name'    => 'button_color',
                    'group'         => __( 'Button', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Button Text Hover Color', 'wpex' ),
                    'param_name'    => 'button_hover_color',
                    'group'         => __( 'Button', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Button Text Size', 'wpex' ),
                    'param_name'        => 'button_size',
                    'group'             => __( 'Button', 'wpex' ),
                    'description'       => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Button Border Radius', 'wpex' ),
                    'param_name'        => 'button_border_radius',
                    'group'             => __( 'Button', 'wpex' ),
                    'description'       => __( 'Please enter a px value.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Button Letter Spacing', 'wpex' ),
                    'param_name'        => 'button_letter_spacing',
                    'group'             => __( 'Button', 'wpex' ),
                    'description'       => __( 'Please enter a px value.', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Button Padding', 'wpex' ),
                    'param_name'        => 'button_padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'wpex' ),
                    'group'             => __( 'Button', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Button Font Weight', 'wpex' ),
                    'param_name'        => 'button_weight',
                    'description'       => __( 'Note: Not all font families support every font weight.', 'wpex' ),
                    'std'               => '',
                    'value'             => vcex_font_weights(),
                    'group'             => __( 'Button', 'wpex' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Button Text Transform', 'wpex' ),
                    'param_name'        => 'button_transform',
                    'group'             => __( 'Button', 'wpex' ),
                    'value'             => vcex_text_transforms(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'textarea_raw_html',
                    'heading'       => __( 'Custom Button HTML', 'wpex' ),
                    'param_name'    => 'custom_button',
                    'description'   => __( 'Enter your custom button HTML, such as your paypal button code.', 'wpex' ),
                    'group'         => __( 'Button', 'wpex' ),
                ),

                //Icons
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Icon library', 'wpex' ),
                    'param_name'    => 'icon_type',
                    'description'   => __( 'Select icon library.', 'wpex' ),
                    'std'           => 'fontawesome',
                    'value'         => array(
                        __( 'Font Awesome', 'wpex' ) => 'fontawesome',
                        __( 'Open Iconic', 'wpex' )  => 'openiconic',
                        __( 'Typicons', 'wpex' )     => 'typicons',
                        __( 'Entypo', 'wpex' )       => 'entypo',
                        __( 'Linecons', 'wpex' )     => 'linecons',
                        __( 'Pixel', 'wpex' )        => 'pixelicons',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),

                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'wpex' ),
                    'param_name'    => 'button_icon_left',
                    'admin_label'   => true,
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'fontawesome',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'wpex' ),
                    'param_name'    => 'button_icon_left_openiconic',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'openiconic',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'openiconic',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'wpex' ),
                    'param_name'    => 'button_icon_left_typicons',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'typicons',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'typicons',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'wpex' ),
                    'param_name'    => 'button_icon_left_entypo',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'entypo',
                        'iconsPerPage'  => 300,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'entypo',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'wpex' ),
                    'param_name'    => 'button_icon_left_linecons',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'linecons',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'linecons',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'wpex' ),
                    'param_name'    => 'button_icon_left_pixelicons',
                    'settings'      => array(
                        'emptyIcon' => false,
                        'type'      => 'pixelicons',
                        'source'    => vcex_pixel_icons(),
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'pixelicons',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'wpex' ),
                    'param_name'    => 'button_icon_right',
                    'admin_label'   => true,
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'fontawesome',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'wpex' ),
                    'param_name'    => 'button_icon_right_openiconic',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'openiconic',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'openiconic',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'wpex' ),
                    'param_name'    => 'button_icon_right_typicons',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'typicons',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'typicons',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'wpex' ),
                    'param_name'    => 'button_icon_right_entypo',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'entypo',
                        'iconsPerPage'  => 300,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'entypo',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'wpex' ),
                    'param_name'    => 'button_icon_right_linecons',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'linecons',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'linecons',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'wpex' ),
                    'param_name'    => 'button_icon_right_pixelicons',
                    'settings'      => array(
                        'emptyIcon' => false,
                        'type'      => 'pixelicons',
                        'source'    => vcex_pixel_icons(),
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'pixelicons',
                    ),
                    'group'         => __( 'Icons', 'wpex' ),
                ),
            )
        ) );

    }
}
add_action( 'vc_before_init', 'vcex_pricing_shortcode_vc_map' );
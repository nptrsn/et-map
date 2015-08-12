<?php
/**
 * Registers the Milestone shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_milestone extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_milestone.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_milestone_shortcode_vc_map' ) ) {
    function vcex_milestone_shortcode_vc_map() {
        vc_map( array(
            'name'                  => __( 'Milestone', 'wpex' ),
            'description'           => __( 'Animated counter', 'wpex' ),
            'base'                  => 'vcex_milestone',
            'icon'                  => 'vcex-milestone',
            'category'              => WPEX_THEME_BRANDING,
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
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                    'value'             => vcex_visibility(),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Appear Animation', 'wpex' ),
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
                    'type'              => 'textfield',
                    'class'             => 'vcex-animated-counter-number',
                    'heading'           => __( 'Speed', 'wpex' ),
                    'param_name'        => 'speed',
                    'value'             => '2500',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'description'       => __('The number of milliseconds it should take to finish counting.','wpex'),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Refresh Interval', 'wpex' ),
                    'param_name'        => 'interval',
                    'value'             => '50',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'description'       => __('The number of milliseconds to wait between refreshing the counter.','wpex'),
                ),

                // Number
                array(
                    'type'          => 'textfield',
                    'admin_label'   => true,
                    'class'         => 'vcex-animated-counter-number',
                    'heading'       => __( 'Number', 'wpex' ),
                    'param_name'    => 'number',
                    'value'         => '45',
                    'description'   => __( 'Your Milestone.', 'wpex' ),
                    'group'         => __( 'Number', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Number Before', 'wpex' ),
                    'param_name'        => 'before',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'group'             => __( 'Number', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Number After', 'wpex' ),
                    'param_name'        => 'after',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'Number', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Number Color', 'wpex' ),
                    'param_name'    => 'number_color',
                    'group'         => __( 'Number', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Number Font Size', 'wpex' ),
                    'param_name'    => 'number_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'         => __( 'Number', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Number Font Weight', 'wpex' ),
                    'param_name'    => 'number_weight',
                    'value'         => vcex_font_weights(),
                    'std'           => '',
                    'description'   => __( 'Note: Not all font families support every font weight.', 'wpex' ),
                    'group'         => __( 'Number', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Number Bottom Margin', 'wpex' ),
                    'param_name'    => 'number_bottom_margin',
                    'description'   => __( 'Please enter a px value.', 'wpex' ),
                    'group'         => __( 'Number', 'wpex' ),
                ),

                // caption
                array(
                    'type'          => 'textfield',
                    'class'         => 'vcex-animated-counter-caption',
                    'heading'       => __( 'Caption', 'wpex' ),
                    'param_name'    => 'caption',
                    'value'         => 'Awards Won',
                    'admin_label'   => true,
                    'description'   => __('Your milestone caption displays underneath the number.','wpex'),
                    'group'         => __( 'Caption', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Caption Color', 'wpex' ),
                    'param_name'    => 'caption_color',
                    'group'         => __( 'Caption', 'wpex' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Caption Font Size', 'wpex' ),
                    'param_name'    => 'caption_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'wpex' ),
                    'group'         => __( 'Caption', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Caption Font Weight', 'wpex' ),
                    'param_name'    => 'caption_font',
                    'value'         => vcex_font_weights(),
                    'std'           => '',
                    'description'   => __( 'Note: Not all font families support every font weight.', 'wpex' ),
                    'group'         => __( 'Caption', 'wpex' ),
                ),

                // Link
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'URL', 'wpex' ),
                    'param_name'    => 'url',
                    'group'         => __( 'Link', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'URL Target', 'wpex' ),
                    'param_name'    => 'url_target',
                    'value'         => array(
                        __( 'Self', 'wpex')     => '',
                        __( 'Blank', 'wpex' )   => 'blank',
                    ),
                    'dependency'    => Array(
                        'element'   => 'url',
                        'not_empty' => true
                    ),
                    'group'         => __( 'Link', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'URl Rel', 'wpex' ),
                    'param_name'    => 'url_rel',
                    'value'         => array(
                        __( 'None', 'wpex')         => '',
                        __( 'Nofollow', 'wpex' )    => 'nofollow',
                    ),
                    'dependency'    => Array(
                        'element'   => 'url',
                        'not_empty' => true
                    ),
                    'group'         => __( 'Link', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Link Container Wrap', 'wpex' ),
                    'param_name'    => 'url_wrap',
                    'value'         => array(
                        __( 'Default', 'wpex' ) => '',
                        __( 'False', 'wpex' )   => 'false',
                        __( 'True', 'wpex' )    => 'true',
                    ),
                    'group'         => __( 'Link', 'wpex' ),
                    'description'   => __( 'Apply the link to the entire wrapper?', 'wpex' ),
                ),
                
                // CSS
                array(
                    'type'          => 'css_editor',
                    'heading'       => __( 'Design', 'wpex' ),
                    'param_name'    => 'css',
                    'group'         => __( 'Design options', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Width', 'wpex' ),
                    'param_name'        => 'width',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'group'             => __( 'Design options', 'wpex' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Border Radius', 'wpex' ),
                    'param_name'        => 'border_radius',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'Design options', 'wpex' ),
                ),
            )
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_milestone_shortcode_vc_map' );
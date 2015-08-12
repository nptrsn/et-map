<?php
/**
 * Registers the navbar shortcode and adds it to the Visual Composer
 *
 * @package     Total
 * @subpackage  Framework/Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.5.3
 * @version     2.0.0
 */

/**
 * Register shortcode with VC Composer
 *
 * @since Total 2.0.0
 */
class WPBakeryShortCode_vcex_navbar extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_navbar.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_navbar_shortcode_vc_map' ) ) {
    function vcex_navbar_shortcode_vc_map() {

        // Create an array of menu items
        $menus_array = array();
        $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
        foreach ( $menus as $menu) {
            $menus_array[$menu->name] = $menu->term_id;
        }

        // Add new shortcode to the Visual Composer
        vc_map( array(
            'name'                  => __( 'Navigation Bar', 'wpex' ),
            'description'           => __( 'Custom menu navigation bar', 'wpex' ),
            'base'                  => 'vcex_navbar',
            'icon'                  => 'vcex-navbar',
            'category'              => WPEX_THEME_BRANDING,
            'params'                => array(

                // General
                array(
                    'type'          => 'dropdown',
                    'admin_label'   => true,
                    'heading'       => __( 'Menu', 'wpex' ),
                    'param_name'    => 'menu',
                    'value'         => $menus_array,
                ),
                array(
                    'type'          => 'dropdown',
                    'admin_label'   => true,
                    'heading'       => __( 'Style', 'wpex' ),
                    'param_name'    => 'style',
                    'value'         => array(
                        __( 'Default', 'wpex' ) => '',
                        __( 'Buttons', 'wpex' ) => 'buttons',
                        __( 'Simple', 'wpex' )  => 'simple',
                    ),
                ),
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
                    'type'          => 'dropdown',
                    'heading'       => __( 'Visibility', 'wpex' ),
                    'param_name'    => 'visibility',
                    'value'         => vcex_visibility(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Appear Animation', 'wpex'),
                    'param_name'        => 'css_animation',
                    'value'             => vcex_css_animations(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Hover Animation', 'wpex'),
                    'param_name'        => 'hover_animation',
                    'value'             => vcex_hover_animations(),
                    'std'               => '',
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),

                // Design Options
                array(
                    'type'          => 'css_editor',
                    'heading'       => __( 'CSS', 'wpex' ),
                    'param_name'    => 'css',
                    'group'         => __( 'Design', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Style', 'wpex' ),
                    'param_name'    => 'link_color',
                    'value'         => array(
                        __( 'Default', 'wpex' ) => '',
                        __( 'Black', 'wpex' )   => 'black',
                        __( 'White', 'wpex' )   => 'white',
                    ),
                    'group'         => __( 'Design', 'wpex' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Border Radius', 'wpex' ),
                    'param_name'    => 'border_radius',
                    'description'   => __( 'Please enter a px value.', 'wpex' ),
                    'group'         => __( 'Design', 'wpex' ),
                    'value'         => vcex_border_radius(),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Hover: background', 'wpex' ),
                    'param_name'    => 'hover_bg',
                    'group'         => __( 'Design', 'wpex' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Hover: Color', 'wpex' ),
                    'param_name'    => 'hover_color',
                    'group'         => __( 'Design', 'wpex' ),
                ),
            )
        ) );

    }
}
add_action( 'vc_before_init', 'vcex_navbar_shortcode_vc_map' );
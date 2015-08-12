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
class WPBakeryShortCode_vcex_skillbar extends WPBakeryShortCode {
	protected function content( $atts, $content = null ) {
		ob_start();
		include( locate_template( 'vcex_templates/vcex_skillbar.php' ) );
		return ob_get_clean();
	}
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_skillbar_shortcode_vc_map' ) ) {
	function vcex_skillbar_shortcode_vc_map() {
		vc_map( array(
			'name'                  => __( 'Skill Bar', 'wpex' ),
			'description'           => __( 'Animated skill bar', 'wpex' ),
			'base'                  => 'vcex_skillbar',
			'category'              => WPEX_THEME_BRANDING,
			'icon'                  => 'vcex-skill-bar',
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
					'heading'       => __( 'Custom Classes', 'wpex' ),
					'description'   => __( 'Add additonal classes to the main element.', 'wpex' ),
					'param_name'    => 'classes',
				),
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'CSS Animation', 'wpex' ),
					'param_name'    => 'css_animation',
					'value'         => array(
						__( 'No', 'wpex' )                   => '',
						__( 'Top to bottom', 'wpex' )       => 'top-to-bottom',
						__( 'Bottom to top', 'wpex' )       => 'bottom-to-top',
						__( 'Left to right', 'wpex' )       => 'left-to-right',
						__( 'Right to left', 'wpex' )       => 'right-to-left',
						__( 'Appear from center', 'wpex' )  => 'appear' ),
				),
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Visibility', 'wpex' ),
					'param_name'    => 'visibility',
					'value'         => vcex_visibility(),
				),
				array(
					'type'          => 'textfield',
					'heading'       => __( 'Title', 'wpex' ),
					'param_name'    => 'title',
					'admin_label'   => true,
					'value'         => 'Web Design',
				),
				array(
					'type'          => 'textfield',
					'heading'       => __( 'Percentage', 'wpex' ),
					'param_name'    => 'percentage',
					'value'         => '70',
				),
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Display % Number', 'wpex' ),
					'param_name'    => 'show_percent',
					'value'         => array(
						__( 'Yes', 'wpex' )	=> '',
						__( 'No', 'wpex' )	=> 'false',
					),
				),

				// Icon
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Display Icon', 'wpex' ),
					'param_name'    => 'show_icon',
					'value'         => array(
						__( 'Yes', 'wpex' )	=> '',
						__( 'No', 'wpex' )	=> 'false',
					),
					'group'			=> __( 'Icon', 'wpex' ),
				),
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Icon library', 'wpex' ),
					'param_name'    => 'icon_type',
					'description'   => __( 'Select icon library.', 'wpex' ),
					'value'         => array(
						__( 'Font Awesome', 'wpex' ) => 'fontawesome',
						__( 'Open Iconic', 'wpex' )  => 'openiconic',
						__( 'Typicons', 'wpex' )     => 'typicons',
						__( 'Entypo', 'wpex' )       => 'entypo',
						__( 'Linecons', 'wpex' )     => 'linecons',
						__( 'Pixel', 'wpex' )        => 'pixelicons',
					),
					'group'			=> __( 'Icon', 'wpex' ),
				),
				array(
					'type'          => 'iconpicker',
					'heading'       => __( 'Icon', 'wpex' ),
					'param_name'    => 'icon',
					'settings'      => array(
						'emptyIcon'		=> true,
						'iconsPerPage'	=> 200,
					),
					'dependency'    => array(
						'element'   => 'icon_type',
						'value'     => 'fontawesome',
					),
					'group'			=> __( 'Icon', 'wpex' ),
				),
				array(
					'type'          => 'iconpicker',
					'heading'       => __( 'Icon', 'wpex' ),
					'param_name'    => 'icon_openiconic',
					'settings'      => array(
						'emptyIcon'		=> true,
						'iconsPerPage'	=> 200,
						'type'			=> 'openiconic',
					),
					'dependency'    => array(
						'element'   => 'icon_type',
						'value'     => 'openiconic',
					),
					'group'			=> __( 'Icon', 'wpex' ),
				),
				array(
					'type'          => 'iconpicker',
					'heading'       => __( 'Icon', 'wpex' ),
					'param_name'    => 'icon_typicons',
					'settings'      => array(
						'emptyIcon'		=> true,
						'iconsPerPage'	=> 200,
						'type'          => 'typicons',
					),
					'dependency'    => array(
						'element'   => 'icon_type',
						'value'     => 'typicons',
					),
					'group'			=> __( 'Icon', 'wpex' ),
				),
				array(
					'type'          => 'iconpicker',
					'heading'       => __( 'Icon', 'wpex' ),
					'param_name'    => 'icon_entypo',
					'settings'      => array(
						'emptyIcon'     => false,
						'type'          => 'entypo',
						'iconsPerPage'  => 300,
					),
					'dependency'    => array(
						'element'   => 'icon_type',
						'value'     => 'entypo',
					),
					'group'			=> __( 'Icon', 'wpex' ),
				),
				array(
					'type'          => 'iconpicker',
					'heading'       => __( 'Icon', 'wpex' ),
					'param_name'    => 'icon_linecons',
					'settings'      => array(
						'emptyIcon'		=> true,
						'iconsPerPage'	=> 200,
						'type'          => 'linecons',
					),
					'dependency'    => array(
						'element'   => 'icon_type',
						'value'     => 'linecons',
					),
					'group'			=> __( 'Icon', 'wpex' ),
				),
				array(
					'type'          => 'iconpicker',
					'heading'       => __( 'Icon', 'wpex' ),
					'param_name'    => 'icon_pixelicons',
					'settings'      => array(
						'emptyIcon'		=> true,
						'iconsPerPage'	=> 200,
						'type'      	=> 'pixelicons',
						'source'    	=> vcex_pixel_icons(),
					),
					'dependency'    => array(
						'element'   => 'icon_type',
						'value'     => 'pixelicons',
					),
					'group'			=> __( 'Icon', 'wpex' ),
				),

				// Design
					array(
					'type'			=> 'colorpicker',
					'heading'		=> __( 'Container Background', 'wpex' ),
					'param_name'	=> 'background',
					'group'			=> __( 'Design', 'wpex' ),
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> __( 'Container Inset Shadow', 'wpex' ),
					'param_name'	=> 'box_shadow',
					'value'			=> array(
						__( 'Yes', 'wpex' )	=> '',
						__( 'No', 'wpex' )	=> 'false',
					),
					'group'			=> __( 'Design', 'wpex' ),
				),
				array(
					'type'			=> 'colorpicker',
					'heading'		=> __( 'Skill Bar Color', 'wpex' ),
					'param_name'	=> 'color',
					'group'			=> __( 'Design', 'wpex' ),
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> __( 'Container Height', 'wpex' ),
					'param_name'	=> 'container_height',
					'description'	=> __( 'Please enter a px value.', 'wpex' ),
					'group'			=> __( 'Design', 'wpex' ),
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> __( 'Font Size', 'wpex' ),
					'param_name'	=> 'font_size',
					'description'	=> __( 'You can use em or px values, but you must define them.', 'wpex' ),
					'group'			=> __( 'Design', 'wpex' ),
				),

			)
		) );
	}
}
add_action( 'vc_before_init', 'vcex_skillbar_shortcode_vc_map' );
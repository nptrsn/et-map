<?php
/**
 * Topbar Panel
 *
 * @package		Total
 * @subpackage	Framework/Customizer
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.6.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*-----------------------------------------------------------------------------------*/
/*	- General
/*-----------------------------------------------------------------------------------*/

// Define Section
$wp_customize->add_section( 'wpex_topbar_general' , array(
	'title'			=> __( 'General', 'wpex' ),
	'priority'		=> 1,
	'panel'			=> 'wpex_topbar',
) );

// Enable Toggle bar
$wp_customize->add_setting( 'top_bar', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'top_bar', array(
	'label'		=> __( 'Enable', 'wpex' ),
	'section'	=> 'wpex_topbar_general',
	'settings'	=> 'top_bar',
	'priority'	=> 1,
	'type'		=> 'checkbox',
) );

// Style
$wp_customize->add_setting( 'top_bar_style', array(
	'type'		=> 'theme_mod',
	'default'	=> 'one',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'top_bar_style', array(
	'label'		=> __( 'Style', 'wpex' ),
	'section'	=> 'wpex_topbar_general',
	'settings'	=> 'top_bar_style',
	'priority'	=> 2,
	'type'		=> 'select',
	'choices'	=> array(
		'one'	=> __( 'Left Content & Right Social', 'wpex' ),
		'two'	=> __( 'Left Social & Right Content', 'wpex' ),
		'three'	=> __( 'Centered Content & Social', 'wpex' ),
	),
) );

// Visibility
$wp_customize->add_setting( 'top_bar_visibility', array(
	'type'		=> 'theme_mod',
	'default'	=> 'always-visible',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'top_bar_visibility', array(
	'label'		=> __( 'Visibility', 'wpex' ),
	'section'	=> 'wpex_topbar_general',
	'settings'	=> 'top_bar_visibility',
	'priority'	=> 2,
	'type'		=> 'select',
	'choices'	=> wpex_visibility(),
) );

// Content
$wp_customize->add_setting( 'top_bar_content', array(
	'type'		=> 'theme_mod',
	'default'	=> '[font_awesome icon="phone" margin_right="5px" color="#000"] 1-800-987-654 [font_awesome icon="envelope" margin_right="5px" margin_left="20px" color="#000"] admin@total.com [font_awesome icon="user" margin_right="5px" margin_left="20px" color="#000"] [wp_login_url text="User Login" logout_text="Logout"]',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'top_bar_content', array(
	'label'		=> __( 'Content', 'wpex' ),
	'section'	=> 'wpex_topbar_general',
	'settings'	=> 'top_bar_content',
	'priority'	=> 2,
	'type'		=> 'textarea',
) );


/*-----------------------------------------------------------------------------------*/
/*	- Social
/*-----------------------------------------------------------------------------------*/

// Get social options
$social_options = wpex_topbar_social_options();

// Display social options only if the array isn't empty
if ( ! empty( $social_options ) ) {

	// Define Section
	$wp_customize->add_section( 'wpex_topbar_social' , array(
		'title'			=> __( 'Social', 'wpex' ),
		'priority'		=> 2,
		'panel'			=> 'wpex_topbar',
	) );

	// Enable Social
	$wp_customize->add_setting( 'top_bar_social', array(
		'type'		=> 'theme_mod',
		'default'	=> '1',
		'sanitize_callback' => false,
	) );
	$wp_customize->add_control( 'top_bar_social', array(
		'label'		=> __( 'Social', 'wpex' ),
		'section'	=> 'wpex_topbar_social',
		'settings'	=> 'top_bar_social',
		'priority'	=> 1,
		'type'		=> 'checkbox',
	) );

	// Social Alternative
	$wp_customize->add_setting( 'top_bar_social_alt', array(
		'type'		=> 'theme_mod',
		'sanitize_callback' => false,
	) );
	$wp_customize->add_control( 'top_bar_social_alt', array(
		'label'			=> __( 'Social Alternative', 'wpex' ),
		'section'		=> 'wpex_topbar_social',
		'settings'		=> 'top_bar_social_alt',
		'priority'		=> 2,
		'type'			=> 'textarea',
	) );

	// Link Target
	$wp_customize->add_setting( 'top_bar_social_target', array(
		'type'		=> 'theme_mod',
		'default'	=> 'blank',
		'sanitize_callback' => false,
	) );
	$wp_customize->add_control( 'top_bar_social_target', array(
		'label'			=> __( 'Social Link Target', 'wpex' ),
		'section'		=> 'wpex_topbar_social',
		'settings'		=> 'top_bar_social_target',
		'priority'		=> 3,
		'type'			=> 'select',
		'choices'		=> array (
			'blank'	=> __( 'New Window', 'wpex' ),
			'self'	=> __( 'Same Window', 'wpex' ),
		),
	) );

	// Top Social Style
	$wp_customize->add_setting( 'top_bar_social_style', array(
		'type'		=> 'theme_mod',
		'default'	=> 'font_icons',
		'sanitize_callback' => false,
	) );
	$wp_customize->add_control( 'top_bar_social_style', array(
		'label'			=> __( 'Social Style', 'wpex' ),
		'section'		=> 'wpex_topbar_social',
		'settings'		=> 'top_bar_social_style',
		'priority'		=> 3,
		'type'			=> 'select',
		'choices'		=> array (
			'font_icons'	=> __( 'Font Icons', 'wpex' ),
			'colored-icons'	=> __( 'Colored Image Icons', 'wpex' )
		),
	) );

	// Social Options
	$social_count = '4';
	foreach ( $social_options as $key => $val ) {
		$social_count++;
		if ( in_array( $key, array( 'twitter', 'facebook', 'pinterest', 'linkedin', 'instagram', 'googleplus', 'rss' ) ) ) {
			$default = '#';
		} else {
			$default = '';
		}
		$wp_customize->add_setting( 'top_bar_social_profiles[' . $key .']', array(
			'type'		=> 'theme_mod',
			'default'	=> $default,
			'sanitize_callback' => false,
		) );
		$wp_customize->add_control( 'top_bar_social_profiles[' . $key .']', array(
			'label'			=> __( $val['label'], 'wpex' ),
			'section'		=> 'wpex_topbar_social',
			'settings'		=> 'top_bar_social_profiles[' . $key .']',
			'priority'		=> $social_count,
			'type'			=> 'text',
		) );
	}

}
<?php
/**
 * Toggle Bar Panel
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
$wp_customize->add_section( 'wpex_togglebar_general' , array(
	'title'			=> __( 'General', 'wpex' ),
	'priority'		=> 1,
	'panel'			=> 'wpex_togglebar',
) );

// Enable Toggle bar
$wp_customize->add_setting( 'toggle_bar', array(
	'type'		=> 'theme_mod',
	'default'	=> '',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'toggle_bar', array(
	'label'		=> __( 'Enable', 'wpex' ),
	'section'	=> 'wpex_togglebar_general',
	'settings'	=> 'toggle_bar',
	'priority'	=> 1,
	'type'		=> 'checkbox',
) );

// Toggle bar content
$wp_customize->add_setting( 'toggle_bar_page', array(
	'type'		=> 'theme_mod',
	'default'	=> '',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'toggle_bar_page', array(
	'label'		=> __( 'Content', 'wpex' ),
	'section'	=> 'wpex_togglebar_general',
	'settings'	=> 'toggle_bar_page',
	'priority'	=> 2,
	'type'		=> 'dropdown-pages',
) );

// Visibility
$wp_customize->add_setting( 'toggle_bar_visibility', array(
	'type'		=> 'theme_mod',
	'default'	=> 'hidden-phone',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'toggle_bar_visibility', array(
	'label'		=> __( 'Visibility', 'wpex' ),
	'section'	=> 'wpex_togglebar_general',
	'settings'	=> 'toggle_bar_visibility',
	'priority'	=> 3,
	'type'		=> 'select',
	'choices'	=> wpex_visibility(),
) );

// Animation
$wp_customize->add_setting( 'toggle_bar_animation', array(
	'type'		=> 'theme_mod',
	'default'	=> 'fade',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'toggle_bar_animation', array(
	'label'		=> __( 'Toggle Bar Animation', 'wpex' ),
	'section'	=> 'wpex_togglebar_general',
	'settings'	=> 'toggle_bar_animation',
	'priority'	=> 4,
	'type'		=> 'select',
	'choices'	=> array(
		'fade'			=> __( 'Fade', 'wpex' ),
		'fade-slide'	=> __( 'Fade & Slide Down', 'wpex' ),
	)
) );
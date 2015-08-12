<?php
/**
 * Testimonials Customizer Options
 *
 * @package		Total
 * @subpackage	Customizer
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.6.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if testimonials post type isn't enabled
if ( ! WPEX_TESTIMONIALS_IS_ACTIVE ) {
	return;
}

/*-----------------------------------------------------------------------------------*/
/*	- General
/*-----------------------------------------------------------------------------------*/
$wp_customize->add_section( 'wpex_testimonials_general' , array(
	'title'		=> __( 'General', 'wpex' ),
	'priority'	=> 1,
	'panel'		=> 'wpex_testimonials',
) );

$wp_customize->add_setting( 'testimonials_page', array(
	'type'				=> 'theme_mod',
	'default'			=> '',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'testimonials_page', array(
	'label'			=> __( 'Testimonials Page', 'wpex' ),
	'section'		=> 'wpex_testimonials_general',
	'settings'		=> 'testimonials_page',
	'priority'		=> 2,
	'type'			=> 'dropdown-pages',
	'description'	=> __( 'Used for breadcrumbs.', 'wpex' ),
) );

$wp_customize->add_setting( 'testimonials_custom_sidebar', array(
	'type'		=> 'theme_mod',
	'default'	=> 'on',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'testimonials_custom_sidebar', array(
	'label'			=> __( 'Custom Post Type Sidebar', 'wpex' ),
	'section'		=> 'wpex_testimonials_general',
	'settings'		=> 'testimonials_custom_sidebar',
	'priority'		=> 3,
	'type'			=> 'checkbox',
) );

$wp_customize->add_setting( 'breadcrumbs_testimonials_cat', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'breadcrumbs_testimonials_cat', array(
	'label'			=> __( 'Display Category In Breadcrumbs', 'wpex' ),
	'section'		=> 'wpex_testimonials_general',
	'settings'		=> 'breadcrumbs_testimonials_cat',
	'priority'		=> 4,
	'type'			=> 'checkbox',
) );

$wp_customize->add_setting( 'testimonials_search', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'testimonials_search', array(
	'label'			=> __( 'Include In Search', 'wpex' ),
	'section'		=> 'wpex_testimonials_general',
	'settings'		=> 'testimonials_search',
	'priority'		=> 5,
	'type'			=> 'checkbox',
) );

/*-----------------------------------------------------------------------------------*/
/*	- Archives
/*-----------------------------------------------------------------------------------*/
$wp_customize->add_section( 'wpex_testimonials_archives' , array(
	'title'		=> __( 'Archives', 'wpex' ),
	'priority'	=> 2,
	'panel'		=> 'wpex_testimonials',
) );

$wp_customize->add_setting( 'testimonials_archive_layout', array(
	'type'		=> 'theme_mod',
	'default'	=> 'full-width',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'testimonials_archive_layout', array(
	'label'		=> __( 'Layout', 'wpex' ),
	'section'	=> 'wpex_testimonials_archives',
	'settings'	=> 'testimonials_archive_layout',
	'priority'	=> 1,
	'type'		=> 'select',
	'choices'	=> array(
		'right-sidebar'	=> __( 'Right Sidebar','wpex' ),
		'left-sidebar'	=> __( 'Left Sidebar','wpex' ),
		'full-width'	=> __( 'No Sidebar','wpex' ),
	),
) );

$wp_customize->add_setting( 'testimonials_entry_columns', array(
	'type'		=> 'theme_mod',
	'default'	=> '4',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'testimonials_entry_columns', array(
	'label'		=> __( 'Columns', 'wpex' ), 
	'section'	=> 'wpex_testimonials_archives',
	'settings'	=> 'testimonials_entry_columns',
	'priority'	=> 4,
	'type'		=> 'select',
	'choices'	=> wpex_grid_columns(),
) );

$wp_customize->add_setting( 'testimonials_archive_posts_per_page', array(
	'type'		=> 'theme_mod',
	'default'	=> '12',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'testimonials_archive_posts_per_page', array(
	'label'		=> __( 'Posts Per Page', 'wpex' ), 
	'section'	=> 'wpex_testimonials_archives',
	'settings'	=> 'testimonials_archive_posts_per_page',
	'priority'	=> 5,
	'type'		=> 'text'
) );


/*-----------------------------------------------------------------------------------*/
/*	- Single
/*-----------------------------------------------------------------------------------*/
$wp_customize->add_section( 'wpex_testimonials_single' , array(
	'title'		=> __( 'Single', 'wpex' ),
	'priority'	=> 3,
	'panel'		=> 'wpex_testimonials',
) );

$wp_customize->add_setting( 'testimonial_post_style', array(
	'type'		=> 'theme_mod',
	'default'	=> 'blockquote',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'testimonial_post_style', array(
	'label'		=> __( 'Post Style', 'wpex' ), 
	'section'	=> 'wpex_testimonials_single',
	'settings'	=> 'testimonial_post_style',
	'priority'	=> 1,
	'type'		=> 'select',
	'choices'	=> array(
		'blockquote'	=> __( 'Blockquote', 'wpex' ),
		'standard'		=> __( 'Standard', 'wpex' ),
	),
) );

$wp_customize->add_setting( 'testimonials_single_layout', array(
	'type'		=> 'theme_mod',
	'default'	=> 'full-width',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'testimonials_single_layout', array(
	'label'		=> __( 'Layout', 'wpex' ), 
	'section'	=> 'wpex_testimonials_single',
	'settings'	=> 'testimonials_single_layout',
	'priority'	=> 1,
	'type'		=> 'select',
	'choices'	=> array(
		'right-sidebar'	=> __( 'Right Sidebar','wpex' ),
		'left-sidebar'	=> __( 'Left Sidebar','wpex' ),
		'full-width'	=> __( 'No Sidebar','wpex' ),
	),
) );

$wp_customize->add_setting( 'testimonials_comments', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'testimonials_comments', array(
	'label'		=> __( 'Comments', 'wpex' ), 
	'section'	=> 'wpex_testimonials_single',
	'settings'	=> 'testimonials_comments',
	'priority'	=> 2,
	'type'		=> 'checkbox',
) );

$wp_customize->add_setting( 'testimonials_next_prev', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'testimonials_next_prev', array(
	'label'		=> __( 'Next & Previous Links', 'wpex' ),
	'section'	=> 'wpex_testimonials_single',
	'settings'	=> 'testimonials_next_prev',
	'priority'	=> 3,
	'type'		=> 'checkbox',
) );
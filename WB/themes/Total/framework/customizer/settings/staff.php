<?php
/**
 * Staff Customizer Options
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

// Return if post type is disabled
if ( ! WPEX_STAFF_IS_ACTIVE ) {
	return;
}

/*-----------------------------------------------------------------------------------*/
/*	- General
/*-----------------------------------------------------------------------------------*/
$wp_customize->add_section( 'wpex_staff_general' , array(
	'title'		=> __( 'General', 'wpex' ),
	'priority'	=> 1,
	'panel'		=> 'wpex_staff',
) );

$wp_customize->add_setting( 'staff_page', array(
	'type'		=> 'theme_mod',
	'default'	=> '',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_page', array(
	'label'			=> __( 'Main Page', 'wpex' ),
	'section'		=> 'wpex_staff_general',
	'settings'		=> 'staff_page',
	'priority'		=> 2,
	'type'			=> 'dropdown-pages',
	'description'	=> __( 'Used for breadcrumbs.', 'wpex' ),
) );

$wp_customize->add_setting( 'staff_custom_sidebar', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_custom_sidebar', array(
	'label'			=> __( 'Custom Post Type Sidebar', 'wpex' ),
	'section'		=> 'wpex_staff_general',
	'settings'		=> 'staff_custom_sidebar',
	'priority'		=> 3,
	'type'			=> 'checkbox',
) );

$wp_customize->add_setting( 'breadcrumbs_staff_cat', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'breadcrumbs_staff_cat', array(
	'label'			=> __( 'Display Category In Breadcrumbs', 'wpex' ),
	'section'		=> 'wpex_staff_general',
	'settings'		=> 'breadcrumbs_staff_cat',
	'priority'		=> 4,
	'type'			=> 'checkbox',
) );

$wp_customize->add_setting( 'staff_search', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_search', array(
	'label'			=> __( 'Include In Search', 'wpex' ),
	'section'		=> 'wpex_staff_general',
	'settings'		=> 'staff_search',
	'priority'		=> 5,
	'type'			=> 'checkbox',
) );

/*-----------------------------------------------------------------------------------*/
/*	- Archives
/*-----------------------------------------------------------------------------------*/
$wp_customize->add_section( 'wpex_staff_archives' , array(
	'title'			=> __( 'Archives', 'wpex' ),
	'priority'		=> 2,
	'panel'			=> 'wpex_staff',
	'description'	=> __( 'The following options are for the post type category and tag archives.', 'wpex' ),
) );

$wp_customize->add_setting( 'staff_archive_layout', array(
	'type'		=> 'theme_mod',
	'default'	=> 'full-width',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_archive_layout', array(
	'label'		=> __( 'Layout', 'wpex' ),
	'section'	=> 'wpex_staff_archives',
	'settings'	=> 'staff_archive_layout',
	'priority'	=> 1,
	'type'		=> 'select',
	'choices'	=> array(
		'right-sidebar'	=> __( 'Right Sidebar','wpex' ),
		'left-sidebar'	=> __( 'Left Sidebar','wpex' ),
		'full-width'	=> __( 'No Sidebar','wpex' ),
	),
) );

$wp_customize->add_setting( 'staff_archive_grid_style', array(
	'type'		=> 'theme_mod',
	'default'	=> 'fit-rows',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_archive_grid_style', array(
	'label'		=> __( 'Grid Style', 'wpex' ),
	'section'	=> 'wpex_staff_archives',
	'settings'	=> 'staff_archive_grid_style',
	'priority'	=> 2,
	'type'		=> 'select',
	'choices'	=> array(
		'fit-rows'		=> __( 'Fit Rows','wpex' ),
		'masonry'		=> __( 'Masonry','wpex' ),
		'no-margins'	=> __( 'No Margins','wpex' )
	),
) );

$wp_customize->add_setting( 'staff_archive_grid_equal_heights', array(
	'type'		=> 'theme_mod',
	'default'	=> '',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_archive_grid_equal_heights', array(
	'label'		=> __( 'Equal Heights', 'wpex' ),
	'section'	=> 'wpex_staff_archives',
	'settings'	=> 'staff_archive_grid_equal_heights',
	'priority'	=> 3,
	'description'   => __( 'Displays the content containers (with the title and excerpt) in equal heights. Will NOT work with the "Masonry" layouts.', 'wpex' ),
) );

$wp_customize->add_setting( 'staff_entry_columns', array(
	'type'		=> 'theme_mod',
	'default'	=> '3',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_entry_columns', array(
	'label'		=> __( 'Columns', 'wpex' ), 
	'section'	=> 'wpex_staff_archives',
	'settings'	=> 'staff_entry_columns',
	'priority'	=> 4,
	'type'		=> 'select',
	'choices'	=> wpex_grid_columns(),
) );

$wp_customize->add_setting( 'staff_archive_posts_per_page', array(
	'type'		=> 'theme_mod',
	'default'	=> '12',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_archive_posts_per_page', array(
	'label'		=> __( 'Posts Per Page', 'wpex' ), 
	'section'	=> 'wpex_staff_archives',
	'settings'	=> 'staff_archive_posts_per_page',
	'priority'	=> 5,
	'type'		=> 'text'
) );

$wp_customize->add_setting( 'staff_entry_overlay_style', array(
	'type'		=> 'theme_mod',
	'default'	=> 'none',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_entry_overlay_style', array(
	'label'		=> __( 'Archives Entry: Overlay Style', 'wpex' ), 
	'section'	=> 'wpex_staff_archives',
	'settings'	=> 'staff_entry_overlay_style',
	'priority'	=> 6,
	'type'		=> 'select',
	'choices'	=> wpex_overlay_styles_array()
) );

$wp_customize->add_setting( 'staff_entry_details', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_entry_details', array(
	'label'		=> __( 'Archives Entry: Details', 'wpex' ), 
	'section'	=> 'wpex_staff_archives',
	'settings'	=> 'staff_entry_details',
	'priority'	=> 7,
	'type'		=> 'checkbox',
) );

$wp_customize->add_setting( 'staff_entry_position', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_entry_position', array(
	'label'		=> __( 'Archives Entry: Position', 'wpex' ), 
	'section'	=> 'wpex_staff_archives',
	'settings'	=> 'staff_entry_position',
	'priority'	=> 8,
	'type'		=> 'checkbox',
) );

$wp_customize->add_setting( 'staff_entry_excerpt_length', array(
	'type'		=> 'theme_mod',
	'default'	=> '20',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_entry_excerpt_length', array(
	'label'			=> __( 'Archives Entry: Excerpt Length', 'wpex' ), 
	'section'		=> 'wpex_staff_archives',
	'settings'		=> 'staff_entry_excerpt_length',	 
	'priority'		=> 9,
	'type'			=> 'text',
	'description'	=> __( 'Enter 0 or leave blank to disable', 'wpex' ),
) );

$wp_customize->add_setting( 'staff_entry_social', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_entry_social', array(
	'label'		=> __( 'Archives Entry: Social Links', 'wpex' ), 
	'section'	=> 'wpex_staff_archives',
	'settings'	=> 'staff_entry_social',
	'priority'	=> 10,
	'type'		=> 'checkbox',
) );


/*-----------------------------------------------------------------------------------*/
/*	- Single
/*-----------------------------------------------------------------------------------*/
$wp_customize->add_section( 'wpex_staff_single' , array(
	'title'		=> __( 'Single', 'wpex' ),
	'priority'	=> 3,
	'panel'		=> 'wpex_staff',
) );

$wp_customize->add_setting( 'staff_single_layout', array(
	'type'		=> 'theme_mod',
	'default'	=> 'right-sidebar',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_single_layout', array(
	'label'		=> __( 'Layout', 'wpex' ), 
	'section'	=> 'wpex_staff_single',
	'settings'	=> 'staff_single_layout',
	'priority'	=> 1,
	'type'		=> 'select',
	'choices'	=> array(
		'right-sidebar'	=> __( 'Right Sidebar','wpex' ),
		'left-sidebar'	=> __( 'Left Sidebar','wpex' ),
		'full-width'	=> __( 'No Sidebar','wpex' ),
	),
) );

$wp_customize->add_setting( 'staff_single_media', array(
	'type'		=> 'theme_mod',
	'default'	=> '',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_single_media', array(
	'label'			=> __( 'Auto Post Media', 'wpex' ), 
	'section'		=> 'wpex_staff_single',
	'settings'		=> 'staff_single_media',
	'priority'		=> 1,
	'type'			=> 'checkbox',
	'description'	=> __( 'Enable if you want to automatically display your featured image or media at the top of posts.', 'wpex' )
) );

$wp_customize->add_setting( 'staff_comments', array(
	'type'		=> 'theme_mod',
	'default'	=> '',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_comments', array(
	'label'		=> __( 'Comments', 'wpex' ), 
	'section'	=> 'wpex_staff_single',
	'settings'	=> 'staff_comments',
	'priority'	=> 2,
	'type'		=> 'checkbox',
) );

$wp_customize->add_setting( 'staff_next_prev', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_next_prev', array(
	'label'		=> __( 'Next & Previous Links', 'wpex' ),
	'section'	=> 'wpex_staff_single',
	'settings'	=> 'staff_next_prev',
	'priority'	=> 3,
	'type'		=> 'checkbox',
) );

$wp_customize->add_setting( 'staff_related', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_related', array(
	'label'		=> __( 'Related Posts', 'wpex' ),
	'section'	=> 'wpex_staff_single',
	'settings'	=> 'staff_related',
	'priority'	=> 4,
	'type'		=> 'checkbox',
) );

$wp_customize->add_setting( 'staff_related_title', array(
	'type'		=> 'theme_mod',
	'default'	=> '',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_related_title', array(
	'label'		=> __( 'Related Posts Title', 'wpex' ),
	'section'	=> 'wpex_staff_single',
	'settings'	=> 'staff_related_title',
	'priority'	=> 5,
	'type'		=> 'text',
) );

$wp_customize->add_setting( 'staff_related_count', array(
	'type'		=> 'theme_mod',
	'default'	=> '4',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_related_count', array(
	'label'		=> __( 'Related Posts Count', 'wpex' ),
	'section'	=> 'wpex_staff_single',
	'settings'	=> 'staff_related_count',
	'priority'	=> 6,
	'type'		=> 'text',
) );

$wp_customize->add_setting( 'staff_related_columns', array(
	'type'		=> 'theme_mod',
	'default'	=> '3',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_related_columns', array(
	'label'		=> __( 'Related Posts Columns', 'wpex' ), 
	'section'	=> 'wpex_staff_single',
	'settings'	=> 'staff_related_columns',
	'priority'	=> 7,
	'type'		=> 'select',
	'choices'	=> wpex_grid_columns(),
) );

$wp_customize->add_setting( 'staff_related_excerpts', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_related_excerpts', array(
	'label'		=> __( 'Related Posts Content', 'wpex' ),
	'section'	=> 'wpex_staff_single',
	'settings'	=> 'staff_related_excerpts',
	'priority'	=> 8,
	'type'		=> 'checkbox',
) );

/*-----------------------------------------------------------------------------------*/
/*	- Extras - These options hook into other sections
/*-----------------------------------------------------------------------------------*/

// Social Sharing
$wp_customize->add_setting( 'social_share_staff', array(
	'type'		=> 'theme_mod',
	'default'	=> false,
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'social_share_staff', array(
	'label'		=>  __( 'Staff: Social Share', 'wpex' ),
	'section'	=> 'wpex_social_sharing',
	'settings'	=> 'social_share_staff',
	'priority'	=> 9,
	'type'		=> 'checkbox',
) );
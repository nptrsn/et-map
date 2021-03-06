<?php
/**
 * Blog Customizer Options
 *
 * @package     Total
 * @subpackage  Customizer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.6.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*-----------------------------------------------------------------------------------*/
/*  - Useful vars
/*-----------------------------------------------------------------------------------*/
$entry_meta_defaults    = array( 'date', 'author', 'categories', 'comments' );
$entry_meta_choices     = array(
	'date'          => __( 'Date', 'wpex' ),
	'author'        => __( 'Author', 'wpex' ),
	'categories'    => __( 'Categories', 'wpex' ),
	'comments'      => __( 'Comments', 'wpex' ),
);

/*-----------------------------------------------------------------------------------*/
/*  - General
/*-----------------------------------------------------------------------------------*/
$this->sections['wpex_blog_general'] = array(
	'title'     => __( 'General', 'wpex' ),
	'panel'     => 'wpex_blog',
	'settings'  => array(
		array(
			'id'        => 'blog_page',
			'control'   => array (
				'label' => __( 'Main Page', 'wpex' ),
				'type'  => 'dropdown-pages',
			),
		),
		array(
			'id'        => 'blog_cats_exclude',
			'control'   => array (
				'label' => __( 'Exclude Categories From Blog', 'wpex' ),
				'type'  => 'text',
				'desc'  => __( 'Enter the ID\'s of categories to exclude from the blog template or homepage blog seperated by a comma (no spaces).' ),
			),
		),
	),
);

/*-----------------------------------------------------------------------------------*/
/*  - Archives
/*-----------------------------------------------------------------------------------*/
$this->sections['wpex_blog_archives'] = array(
	'title'     => __( 'Archives & Entries', 'wpex' ),
	'panel'     => 'wpex_blog',
	'settings'  => array(
		array(
			'id'            => 'blog_archives_layout',
			'default'       => 'right-sidebar',
			'control'       => array (
				'label'     => __( 'Layout', 'wpex' ),
				'type'      => 'select',
				'choices'   => array(
					'right-sidebar' => __( 'Right Sidebar','wpex' ),
					'left-sidebar'  => __( 'Left Sidebar','wpex' ),
					'full-width'    => __( 'No Sidebar','wpex' ),
				),
			),
		),
		array(
			'id'            => 'blog_style',
			'default'       => 'large-image-entry-style',
			'control'       => array (
				'label'     => __( 'Style', 'wpex' ),
				'type'      => 'select',
				'choices'   => array(
					'large-image-entry-style'   => __( 'Large Image','wpex' ),
					'thumbnail-entry-style'     => __( 'Left Thumbnail','wpex' ),
					'grid-entry-style'          => __( 'Grid','wpex' ),
				),
			),
		),
		array(
			'id'            => 'blog_grid_columns',
			'default'       => '3',
			'control'       => array (
				'label'     => __( 'Grid Columns', 'wpex' ),
				'type'      => 'select',
				'choices'   => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				),
			),
		),
		array(
			'id'            => 'blog_grid_style',
			'default'       => 'fit-rows',
			'control'       => array (
				'label'     => __( 'Grid Style', 'wpex' ),
				'type'      => 'select',
				'choices'   => array(
					'fit-rows'  => __( 'Fit Rows', 'wpex' ),
					'masonry'   => __( 'Masonry', 'wpex' ),
				),
			),
		),
		array(
			'id'            => 'blog_archive_grid_equal_heights',
			'control'       => array (
				'label'     => __( 'Equal Heights', 'wpex' ),
				'type'      => 'checkbox',
				'desc'      => __( 'Displays the content containers (with the title and excerpt) in equal heights. Will NOT work with the "Masonry" layouts.', 'wpex' ),
			),
		),
		array(
			'id'            => 'blog_pagination_style',
			'default'       => 'standard',
			'control'       => array (
				'label'     => __( 'Pagination Style', 'wpex' ),
				'type'      => 'select',
				'choices'   => array(
					'standard'          => __( 'Standard', 'wpex' ),
					'infinite_scroll'   => __( 'Infinite Scroll', 'wpex' ),
					'next_prev'         => __( 'Next/Prev', 'wpex' )
				),
			),
		),
		array(
			'id'        => 'category_descriptions',
			'default'   => 'on',
			'control'   => array (
				'label' => __( 'Category Descriptions', 'wpex' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'category_description_position',
			'default'   => 'under_title',
			'control'   => array (
				'label' => __( 'Category Description Position', 'wpex' ),
				'type'      => 'select',
				'choices'   => array(
					'under_title'   => __( 'Under Title', 'wpex' ),
					'above_loop'    => __( 'Above Loop', 'wpex' ),
				),
			),
		),
		array(
			'id'        => 'blog_entry_image_lightbox',
			'control'   => array (
				'label' => __( 'Image Lightbox', 'wpex' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'            => 'blog_entry_image_hover_animation',
			'control'       => array (
				'label'     => __( 'Image Hover Animation', 'wpex' ),
				'type'      => 'select',
				'choices'   => wpex_image_hovers(),
			),
		),
		array(
			'id'        => 'blog_exceprt',
			'default'   => 'on',
			'control'   => array (
				'label' => __( 'Auto Excerpts', 'wpex' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'blog_excerpt_length',
			'default'   => '40',
			'control'   => array (
				'label' => __( 'Excerpt length', 'wpex' ),
				'type'  => 'text',
			),
		),
		array(
			'id'        => 'blog_entry_readmore_text',
			'default'   => __( 'Read More', 'wpex' ),
			'control'   => array (
				'label' => __( 'Read More Button Text', 'wpex' ),
				'type'  => 'text',
			),
		),
		array(
			'id'        => 'blog_entry_author_avatar',
			'control'   => array (
				'label' => __( 'Author Avatar', 'wpex' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'blog_entry_meta',
			'default'   => 'on',
			'control'   => array (
				'label' => __( 'Meta', 'wpex' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'            => 'blog_entry_meta_sections',
			'default'       => $entry_meta_defaults,
			'control'       => array (
				'label'     => __( 'Entry Meta', 'wpex' ),
				'type'      => 'multiple-select',
				'object'    => 'WPEX_Customize_Multicheck_Control',
				'choices'   => $entry_meta_choices
			),
		),
	),
);

/*-----------------------------------------------------------------------------------*/
/*  - Entry Order
/*-----------------------------------------------------------------------------------*/
$blocks = array (
	'featured_media'    => __( 'Media', 'wpex' ),
	'title_meta'        => __( 'Title & Meta', 'wpex' ),
	'excerpt_content'   => __( 'Excerpt', 'wpex' ),
	'readmore'          => __( 'Read More', 'wpex' ),
);
$blocks = apply_filters( 'wpex_blog_entry_blocks', $blocks );
$this->sections['wpex_blog_entry_composer'] = array(
	'title'     => __( 'Entry Builder', 'wpex' ),
	'panel'     => 'wpex_blog',
	'settings'  => array(
		array(
			'id'            => 'blog_entry_composer',
			'default'       => 'featured_media,title_meta,excerpt_content,readmore',
			'control'       => array (
				'label'     => __( 'Entry Layout Elements', 'wpex' ),
				'type'      => 'wpex-sortable',
				'object'    => 'WPEX_Customize_Control_Sorter',
				'choices'   => $blocks,
				'desc'  => __( 'Click and drag and drop elements to re-order them. Click the "x" to disable any element. You can not disable all elements, if you do so it will display them all', 'wpex' ),
			),
		),
	),
);

/*-----------------------------------------------------------------------------------*/
/*  - Single
/*-----------------------------------------------------------------------------------*/
$this->sections['wpex_blog_single'] = array(
	'title'     => __( 'Single', 'wpex' ),
	'panel'     => 'wpex_blog',
	'settings'  => array(
		array(
			'id'        => 'blog_single_layout',
			'default'   => 'right-sidebar',
			'control'   => array (
				'label'     => __( 'Layout', 'wpex' ),
				'type'      => 'select',
				'choices'   => array(
					'right-sidebar' => __( 'Right Sidebar','wpex' ),
					'left-sidebar'  => __( 'Left Sidebar','wpex' ),
					'full-width'    => __( 'No Sidebar','wpex' ),
				),
			),
		),
		array(
			'id'        => 'blog_single_header',
			'default'   => 'custom_text',
			'control'   => array (
				'label'     => __( 'Header Displays', 'wpex' ),
				'type'      => 'select',
				'choices'   => array(
					'custom_text'   => __( 'Custom Text','wpex' ),
					'post_title'    => __( 'Post Title','wpex' ),
				),
			),
		),
		array(
			'id'        => 'blog_single_header_custom_text',
			'default'   => __( 'Blog', 'wpex' ),
			'control'   => array (
				'label' => __( 'Header Custom Text', 'wpex' ),
				'type'  => 'text',
			),
		),
		array(
			'id'        => 'blog_post_image_lightbox',
			'control'   => array (
				'label' => __( 'Featured Image Lightbox', 'wpex' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'blog_thumbnail_caption',
			'control'   => array (
				'label' => __( 'Featured Image Caption', 'wpex' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'breadcrumbs_blog_cat',
			'default'   => 'on',
			'control'   => array (
				'label' => __( 'Category In Breadcrumbs', 'wpex' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'blog_post_meta',
			'default'   => 'on',
			'control'   => array (
				'label' => __( 'Meta', 'wpex' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'            => 'blog_post_meta_sections',
			'default'       => $entry_meta_defaults,
			'control'       => array (
				'label'     => __( 'Entry Meta', 'wpex' ),
				'type'      => 'multiple-select',
				'object'    => 'WPEX_Customize_Multicheck_Control',
				'choices'   => $entry_meta_choices
			),
		),
	),
);

/*-----------------------------------------------------------------------------------*/
/*  - Single Order
/*-----------------------------------------------------------------------------------*/
$blocks = array (
	'featured_media'    => __( 'Featured Media','wpex' ),
	'title_meta'        => __( 'Title & Meta','wpex' ),
	'post_series'       => __( 'Post Series','wpex' ),
	'the_content'       => __( 'Content','wpex' ),
	'post_tags'         => __( 'Post Tags','wpex' ),
	'social_share'      => __( 'Social Share','wpex' ),
	'author_bio'        => __( 'Author Bio','wpex' ),
	'related_posts'     => __( 'Related Posts','wpex' ),
	'comments'          => __( 'Comments','wpex' ),
);
$blocks = apply_filters( 'wpex_blog_single_blocks', $blocks );
$this->sections['wpex_blog_single_builder'] = array(
	'title'     => __( 'Single Builder', 'wpex' ),
	'panel'     => 'wpex_blog',
	'settings'  => array(
		array(
			'id'        => 'blog_single_composer',
			'default'   => 'featured_media,title_meta,post_series,the_content,post_tags,social_share,author_bio,related_posts,comments',
			'control'   => array (
				'label'     => __( 'Blog Entry Element\'s Order', 'wpex' ),
				'type'      => 'wpex-sortable',
				'object'    => 'WPEX_Customize_Control_Sorter',
				'choices'   => $blocks,
				'desc'      => __( 'Click and drag and drop elements to re-order them. Click the "x" to disable any element. You can not disable all elements, if you do so it will display them all', 'wpex' ),
			),
		),
	),
);

/*-----------------------------------------------------------------------------------*/
/*  - Related
/*-----------------------------------------------------------------------------------*/
$this->sections['wpex_blog_related'] = array(
	'title'     => __( 'Related Posts', 'wpex' ),
	'panel'     => 'wpex_blog',
	'settings'  => array(
		array(
			'id'        => 'blog_related_title',
			'control'   => array (
				'label'     => __( 'Title', 'wpex' ),
				'type'      => 'text',
			),
		),
		array(
			'id'        => 'blog_related_columns',
			'default'   => '3',
			'control'   => array (
				'label'     => __( 'Columns', 'wpex' ),
				'type'      => 'select',
				'choices'   => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				),
			),
		),
		array(
			'id'        => 'blog_related_count',
			'default'   => '3',
			'control'   => array (
				'label' => __( 'Count', 'wpex' ),
				'type'  => 'text',
			),
		),
		array(
			'id'        => 'blog_related_excerpt',
			'default'   => 'on',
			'control'   => array (
				'label' => __( 'Excerpt', 'wpex' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'blog_related_excerpt_length',
			'default'   => '15',
			'control'   => array (
				'label' => __( 'Excerpt Length', 'wpex' ),
				'type'  => 'text',
			),
		),
	),
);

// Clear vars from memory
$blocks = $entry_meta_defaults = $entry_meta_choices = null;
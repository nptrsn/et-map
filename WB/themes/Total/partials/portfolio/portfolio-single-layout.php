<?php
/**
 * Portfolio single layout
 *
 * @package		Total
 * @subpackage	Partials/Portfolio
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 2.0.0
 * @version		2.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Single layout blocks
$blocks = array(
	'media',
	'content',
	'share',
	'comments',
	'related',
);

// Apply filters
$blocks = apply_filters( 'wpex_portfolio_single_blocks', $blocks );

// Loop through blocks and get template part
foreach ( $blocks as $block ) {
	get_template_part( 'partials/portfolio/portfolio-single-'. $block );
}

// Clear vars from memory
$blocks = $block = null;
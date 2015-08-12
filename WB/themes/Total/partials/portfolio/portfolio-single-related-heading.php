<?php
/**
 * Portfolio single post related heading
 *
 * @package		Total
 * @subpackage	Partials/Portfolio
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 2.0.0
 * @version		1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get heading
$heading = wpex_portfolio_related_heading();

// Output heading
wpex_heading( array(
	'content'		=> $heading,
	'tag'			=> 'h2',
	'classes'		=> array( 'related-portfolio-posts-heading' ),
	'apply_filters'	=> 'portfolio_related',
) );
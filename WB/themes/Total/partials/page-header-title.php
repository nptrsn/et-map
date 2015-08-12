<?php
/**
 * Returns the post title
 *
 * @package		Total
 * @subpackage	Partials
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.6.0
 * @version		1.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get the title
$title = wpex_title();

// Return if there isn't a title
if ( ! $title ) {
	return;
}

// Default heading tag is an h1
$heading_tag = 'h1';

// Alter the heading for single blog posts and product posts to a span
if ( ( is_singular( 'post' ) && 'custom_text' == get_theme_mod( 'blog_single_header', 'custom_text' ) ) || is_singular( 'product' ) ) {
	$heading_tag = 'span';
} ?>

<<?php echo $heading_tag; ?> class="page-header-title">
	<?php echo $title; ?>
</<?php echo $heading_tag; ?>>
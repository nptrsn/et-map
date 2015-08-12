<?php
/**
 * The Scroll-Top / Back-To-Top Scrolling Button
 *
 * @package		Total
 * @subpackage	Partials
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

// Return if disabled
if ( ! get_theme_mod( 'scroll_top', true ) ) {
	return;
} ?>

<a href="#" id="site-scroll-top"><span class="fa fa-chevron-up"></span></a>
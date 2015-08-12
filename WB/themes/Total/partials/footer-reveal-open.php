<?php
/**
 * Open the footer reveal container
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

// Get global theme object
global $wpex_theme;

// Return if disabled
if ( ! $wpex_theme->has_footer_reveal ) {
    return;
} ?>

<div class="footer-reveal clr">
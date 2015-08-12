<?php
/**
 * Page subheading output
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

// Get global object
global $wpex_theme;

// Return if disabled
if ( ! $wpex_theme->has_page_header_subheading ) {
	return;
}

// Get subheading
$subheading = wpex_get_page_subheading( $wpex_theme->post_id );

// If subheading exists display it
if ( $subheading ) : ?>
	<div class="clr page-subheading">
		<?php echo do_shortcode( $subheading ); ?>
	</div>
<?php endif; ?>
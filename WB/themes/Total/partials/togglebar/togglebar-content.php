<?php
/**
 * Togglebar content output
 *
 * @package		Total
 * @subpackage	Partials/Togglebar
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.6.0
 * @version		1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get global object
global $wpex_theme;

// Get togglebar content ID
$id = $wpex_theme->toggle_bar_content_id;

if ( $id) : ?>

	<div class="entry clr">
		<?php echo apply_filters( 'the_content', get_post_field( 'post_content', $id ) ); ?>		
	</div><!-- .entry -->

<?php endif; ?>
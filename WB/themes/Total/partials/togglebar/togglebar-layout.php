<?php
/**
 * Togglebar output
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
} ?>

<?php if ( $id ) : ?>
	<div id="toggle-bar-wrap" class="<?php echo wpex_toggle_bar_classes(); ?>">
		<div id="toggle-bar" class="clr container">
			<?php get_template_part( 'partials/togglebar/togglebar', 'content' ); ?>
		</div><!-- #toggle-bar -->
	</div><!-- #toggle-bar-wrap -->
<?php endif; ?>
<?php
/**
 * Main sidebar area containing your defined widgets.
 * You shouldn't have to edit this file ever since things are added via hooks.
 *
 * @package		Total
 * @subpackage	Templates
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.0.0
 * @version		2.0.0
 */

// Don't display sidebar for full-screen and full-width layouts
if ( in_array( wpex_get_post_layout(), array( 'full-screen', 'full-width' ) ) ) {
	return;
} ?>

<?php wpex_hook_sidebar_before(); ?>

<aside id="sidebar" class="sidebar-container sidebar-primary" role="complementary">

	<?php wpex_hook_sidebar_top(); ?>

	<div id="sidebar-inner" class="clr">

		<?php wpex_hook_sidebar_inner(); ?>

	</div><!-- #sidebar-inner -->

	<?php wpex_hook_sidebar_bottom(); ?>

</aside><!-- #sidebar -->

<?php wpex_hook_sidebar_after(); ?>
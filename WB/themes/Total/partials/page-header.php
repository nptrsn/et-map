<?php
/**
 * The page header displays at the top of all single pages, posts and archives.
 * See framework/page-header.php for all page header related functions.
 * See framework/hooks/actions.php for all functions attached to the header hooks.
 *
 * @package		Total
 * @subpackage	Partials
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.6.0
 * @version		1.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<?php wpex_hook_page_header_before(); ?>
<header class="<?php echo wpex_page_header_classes(); ?>">
	<?php wpex_hook_page_header_top(); ?>
	<div class="container clr page-header-inner">
		<?php wpex_hook_page_header_inner(); // All default content added via this hook ?>
	</div><!-- .page-header-inner -->
	<?php wpex_hook_page_header_bottom(); ?>
</header><!-- .page-header -->
<?php wpex_hook_page_header_after(); ?>
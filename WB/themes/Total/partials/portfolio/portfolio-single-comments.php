<?php
/**
 * Portfolio single comments
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
} ?>

<?php if ( get_theme_mod( 'portfolio_comments' ) && comments_open() ) : ?>

	<div id="portfolio-post-comments" class="clr">
		<?php comments_template(); ?>
	</div><!-- #portfolio-post-comments -->

<?php endif ?>
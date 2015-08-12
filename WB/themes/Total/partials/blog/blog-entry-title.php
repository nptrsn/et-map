<?php
/**
 * Blog entry avatar
 *
 * @package		Total
 * @subpackage	Partials/Blog
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

<h2 class="blog-entry-title entry-title">
	<a href="<?php wpex_permalink(); ?>" title="<?php wpex_esc_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
</h2><!-- .blog-entry-title -->
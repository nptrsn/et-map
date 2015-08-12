<?php
/**
 * Search entry header
 *
 * @package		Total
 * @subpackage	Partials/Search
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

<header class="search-entry-header clr">
	<h2><a href="<?php echo the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
</header><!-- .search-entry-header -->
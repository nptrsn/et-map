<?php
/**
 * Portfolio entry content template part
 *
 * @package		Total
 * @subpackage	Partials/Portfolio
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.6.0
 * @version		1.0.1
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if disabled for standard entries
if ( ! is_singular( 'portfolio' ) && ! get_theme_mod( 'portfolio_entry_details', true ) ) {
		return;
}

// Return if disabled for related entries
if ( is_singular( 'portfolio' ) && ! get_theme_mod( 'portfolio_related_excerpts', true ) ) {
	return;
}

// Entry content classes
$classes = 'portfolio-entry-details clr';
if ( wpex_portfolio_match_height() ) {
	$classes .= ' match-height-content';
} ?>

<div class="<?php echo $classes; ?>">
	<?php get_template_part( 'partials/portfolio/portfolio-entry', 'title' ); ?>
	<?php get_template_part( 'partials/portfolio/portfolio-entry', 'excerpt' ); ?>
</div><!-- .portfolio-entry-details -->
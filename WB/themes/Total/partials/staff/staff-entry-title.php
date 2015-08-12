<?php
/**
 * Staff entry title template part
 *
 * @package		Total
 * @subpackage	Partials/Staff
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

<h2 class="staff-entry-title entry-title">

	<?php
	// Display staff title with links
	if ( get_theme_mod( 'staff_links_enable', true ) ) : ?>

		<a href="<?php wpex_permalink(); ?>" title="<?php wpex_esc_title(); ?>"><?php the_title(); ?></a>

	<?php
	// Display simple title without links
	else : ?>

		<?php the_title(); ?>

	<?php endif; ?>

</h2><!-- .staff-entry-title -->
<?php
/**
 * Template for the Lightbox + View Butttons overlay style
 *
 * @package		Total
 * @subpackage	Partials/Overlays
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.6.0
 * @version		2.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Only used for outside position
if ( 'outside_link' != $position ) {
	return;
} ?>

<div class="overlay-view-lightbox-buttons">
	<div class="overlay-view-lightbox-buttons-inner clr">
		<div class="overlay-view-lightbox-buttons-buttons clr">
			<a href="<?php wpex_lightbox_image(); ?>" class="wpex-lightbox" title="<?php wpex_esc_title(); ?>"><span class="fa fa-search"></span></a>
			<a href="<?php the_permalink(); ?>" class="view-post" title="<?php wpex_esc_title(); ?>"><span class="fa fa-arrow-right"></span></a>
		</div><!-- .overlay-view-lightbox-buttons-buttons -->
	</div><!-- .overlay-view-lightbox-buttons-inner -->
</div><!-- .overlay-view-lightbox-buttons -->
<?php
/**
 * Term descriptions
 *
 * @package     Total
 * @subpackage  Partials
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 2.0.0
 * @version     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Return if it shouldn't display
if ( ! wpex_has_term_description_above_loop() ) {
	return;
}

// Get term description
$description = term_description();

// Return if there isn't any description
if ( ! $description ) {
	return;
} ?>

<div class="term-description clr">
    <?php echo term_description(); ?>
</div><!-- #term-description -->
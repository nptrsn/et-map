<?php
/**
 * Outputs the portfolio entry title
 *
 * @package     Total
 * @subpackage  Partials/Portfolio
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.0
 * @version     2.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<h2 class="portfolio-entry-title entry-title">
    <a href="<?php wpex_permalink(); ?>" title="<?php wpex_esc_title(); ?>"><?php the_title(); ?></a>
</h2><!-- .portfolio-entry-title -->
<?php
/**
 * Search entry excerpt
 *
 * @package     Total
 * @subpackage  Partials/Search
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 2.0.0
 * @version     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<div class="search-entry-excerpt clr">
    <?php wpex_excerpt( array(
        'length'                => '30',
        'readmore'              => false,
        'ignore_more_tag'       => true,
    ) ); ?>
</div><!-- .search-entry-excerpt -->
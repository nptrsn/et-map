<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package     Total
 * @subpackage  Templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 2.0.0
 * @version     2.0.0
 */

get_header(); ?>

    <div id="content-wrap" class="container clr">

        <?php wpex_hook_primary_before(); ?>

        <div id="primary" class="content-area clr">

            <?php wpex_hook_content_before(); ?>

            <main id="content" class="clr site-content" role="main">

                <?php wpex_hook_content_top(); ?>

                <article class="entry-content entry clr">
                    <?php
                    // Output WooCommerce content
                    woocommerce_content(); ?>
                </article><!-- #post -->

                <?php wpex_hook_content_bottom(); ?>

            </main><!-- #content -->

            <?php wpex_hook_content_after(); ?>

        </div><!-- #primary -->

        <?php wpex_hook_primary_after(); ?>

    </div><!-- #content-wrap -->

<?php get_footer(); ?>
<?php
/**
 * The template used for single portfolio posts.
 *
 * @package     Total
 * @subpackage  Templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.0.0
 * @version     2.0.0
 */

get_header(); ?>

    <div id="content-wrap" class="container clr">

        <?php wpex_hook_primary_before(); ?>

        <div id="primary" class="content-area clr">

            <?php wpex_hook_content_before(); ?>

            <main id="content" class="site-content clr" role="main">

                <?php wpex_hook_content_top(); ?>

                    <?php
                    // Primary loop
                    while ( have_posts() ) : the_post(); ?>

                        <?php
                        // Get portfolio single layout
                        get_template_part( 'partials/portfolio/portfolio', 'single-layout' ); ?>

                    <?php endwhile; ?>

                <?php wpex_hook_content_bottom(); ?>

            </main><!-- #content -->

            <?php wpex_hook_content_after(); ?>

        </div><!-- #primary -->

        <?php wpex_hook_primary_after(); ?>

    </div><!-- .container -->

<?php get_footer();?>
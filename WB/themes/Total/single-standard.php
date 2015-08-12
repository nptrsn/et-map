<?php
/**
 * The Template for displaying standard post type content
 *
 * @package     Total
 * @subpackage  Templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.4.0
 * @version     2.0.0
 */ ?>

<div id="content-wrap" class="container clr">

    <?php wpex_hook_primary_before(); ?>

    <div id="primary" class="content-area clr">

        <?php wpex_hook_content_before(); ?>

        <main id="content" class="site-content clr" role="main">

            <?php wpex_hook_content_top(); ?>

            <?php while ( have_posts() ) : the_post(); ?>

                <article class="single-blog-article clr">

                    <?php
                    // Get single blog post layout template part
                    get_template_part( 'partials/blog/blog', 'single-layout' ); ?>

                </article><!-- .entry -->

            <?php endwhile; ?>

            <?php wpex_hook_content_bottom(); ?>

        </main><!-- #content -->

        <?php wpex_hook_content_after(); ?>

    </div><!-- #primary -->

    <?php wpex_hook_primary_after(); ?>

</div><!-- .container -->
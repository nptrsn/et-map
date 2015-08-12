<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package     Total
 * @subpackage  Templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.0.0
 * @version     2.0.0
 */

// Get site header
get_header(); ?>

    <div class="container clr">

        <?php wpex_hook_primary_before(); ?>

        <div id="primary" class="content-area clr">

            <?php wpex_hook_content_before(); ?>

            <div id="content" class="site-content" role="main">

                <?php wpex_hook_content_top(); ?>

                <?php
                // Check if there are search results
                if ( have_posts() ) : ?>

                    <div id="search-entries" class="clr">

                        <?php
                        // Display blog style search results
                        if ( 'blog' == wpex_search_results_style() ) : ?>

                            <div id="blog-entries" class="clr <?php wpex_blog_wrap_classes(); ?>">

                                <?php $wpex_count = 0; ?>

                                <?php while ( have_posts() ) : the_post(); ?>

                                    <?php $wpex_count++; ?>

                                    <?php get_template_part( 'partials/blog/blog-entry', 'layout' ); ?>

                                    <?php if ( wpex_blog_entry_columns() == $wpex_count ) $wpex_count=0; ?>

                                <?php endwhile; ?>

                            </div><!-- #blog-entries -->

                        <?php
                        // Display custom style for search entries
                        else : ?>

                            <?php while ( have_posts() ) : the_post(); ?>

                                <?php get_template_part( 'partials/search/search', 'entry' ); ?>

                            <?php endwhile; ?>

                        <?php endif; ?>

                    </div><!-- #search-entries -->

                    <?php
                    // Display pagination
                    wpex_pagination(); ?>

                <?php
                // No search results found
                else : ?>

                    <article id="search-no-results" class="clr">

                        <?php _e( 'Sorry, no results were found for this query.', 'wpex' ); ?>

                    </article><!-- #search-no-results -->

                <?php endif; ?>

                <?php wpex_hook_content_bottom(); ?>

            </div><!-- #content -->

            <?php wpex_hook_content_after(); ?>

        </div><!-- #primary -->

        <?php wpex_hook_primary_after(); ?>

    </div><!-- .container -->

<?php
// Get site footer
get_footer(); ?>
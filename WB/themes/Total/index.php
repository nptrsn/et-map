<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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

            <main id="content" class="site-content" role="main">

                <?php wpex_hook_content_top(); ?>

                <?php
                // Display posts if there are in fact posts to display
                if ( have_posts() ) :
                    
                    /*-----------------------------------------------------------------------------------*/
                    /*  - Standard Post Type Posts (BLOG)
                    /*  - See framework/conditionals.php
                    /*  - Blog entries use partials/blog/blog-entry.php for their output
                    /*-----------------------------------------------------------------------------------*/
                    if ( wpex_is_blog_query() ) : ?>

                        <div id="blog-entries" class="clr <?php wpex_blog_wrap_classes(); ?>">

                            <?php $wpex_count = 0; ?>

                            <?php while ( have_posts() ) : the_post(); ?>

                                <?php $wpex_count++; ?>

                                <?php get_template_part( 'partials/blog/blog-entry', 'layout' ); ?>

                                <?php if ( wpex_blog_entry_columns() == $wpex_count ) $wpex_count=0; ?>

                            <?php endwhile; ?>

                        </div><!-- #blog-entries -->

                        <?php wpex_blog_pagination(); ?>

                    <?php
                    /*-----------------------------------------------------------------------------------*/
                    /*  - Custom post type archives display
                    /*  - All non standard post type entries use content-other.php for their output
                    /*-----------------------------------------------------------------------------------*/
                    else : ?>

                        <?php while ( have_posts() ) : the_post(); ?>

                            <?php get_template_part( 'partials/post-type/post-type-entry', get_post_type() ); ?>

                            <?php endwhile; ?>

                        <?php wpex_pagination(); ?>

                    <?php endif; ?>

                <?php
                // Show message because there aren't any posts
                else : ?>

                    <article class="clr"><?php _e( 'No Posts found.', 'wpex' ); ?></article>

                <?php endif; ?>

                 <?php wpex_hook_content_bottom(); ?>

            </main><!-- #content -->

        <?php wpex_hook_content_after(); ?>

        </div><!-- #primary -->

        <?php wpex_hook_primary_after(); ?>

    </div><!-- .container -->
    
<?php get_footer(); ?>
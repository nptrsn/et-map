<?php
/**
 * The template used for single testimonial posts.
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

            <main id="content" class="clr site-content" role="main">

                <?php wpex_hook_content_top(); ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <article class="clr">

                        <div class="entry-content entry clr">

                            <?php if ( 'blockquote' == get_theme_mod( 'testimonial_post_style', 'blockquote' ) ) : ?>

                                <?php get_template_part( 'partials/testimonials/testimonials', 'entry' ); ?>

                            <?php else : ?>

                                <?php the_content(); ?>

                            <?php endif; ?>

                        </div><!-- .entry-content -->

                    </article><!-- #post -->

                    <?php
                    // Displays comments if enabled
                    if ( get_theme_mod( 'testimonials_comments' ) && comments_open() ) : ?>

                        <section id="testimonials-post-comments" class="clr">
                            <?php comments_template(); ?>
                        </section><!-- #testimonials-post-comments -->

                    <?php endif; ?>

                <?php endwhile; ?>

                <?php wpex_hook_content_bottom(); ?>

            </main><!-- #content -->

            <?php wpex_hook_content_after(); ?>

        </div><!-- #primary -->

        <?php wpex_hook_primary_after(); ?>

    </div><!-- .container -->

<?php get_footer();?>
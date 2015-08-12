<?php
/**
 * The template for displaying Staff Tag Archives
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package		Total
 * @subpackage	Templates
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.0.0
 * @version		2.0.0
 */

get_header(); ?>

    <div id="content-wrap" class="container clr">

        <?php wpex_hook_primary_before(); ?>

            <div id="primary" class="content-area clr">

                <?php wpex_hook_content_before(); ?>

                <main id="content" class="site-content clr" role="main">

                    <?php wpex_hook_content_top(); ?>

                    <?php if ( have_posts( ) ) : ?>

                        <div id="staff-entries" class="<?php echo wpex_get_staff_wrap_classes(); ?>">

                            <?php $wpex_count = 0; ?>

                            <?php while ( have_posts() ) : the_post(); ?>

                                <?php $wpex_count++; ?>

                                <?php get_template_part( 'partials/staff/staff', 'entry' ); ?>

                                <?php if ( $wpex_count == wpex_staff_archive_columns() ) $wpex_count=0; ?>

                            <?php endwhile; ?>

                        </div><!-- #staff-entries -->

                        <?php wpex_pagination(); ?>

                    <?php else : ?>

                        <article class="clr"><?php _e( 'No Posts found.', 'wpex' ); ?></article>

                    <?php endif; ?>

                    <?php wpex_hook_content_bottom(); ?>

                </main><!-- #content -->

                <?php wpex_hook_content_after(); ?>

            </div><!-- #primary -->

            <?php wpex_hook_primary_after(); ?>

    </div><!-- #content-wrap -->

<?php get_footer(); ?>
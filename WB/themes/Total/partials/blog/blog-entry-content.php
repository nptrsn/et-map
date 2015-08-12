<?php
/**
 * Blog entry layout
 *
 * @package     Total
 * @subpackage  Partials/Blog
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.6.0
 * @version     2.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<div class="blog-entry-excerpt entry">

    <?php
    // Display excerpt if auto excerpts are enabled in the admin
    if ( get_theme_mod( 'blog_exceprt', true ) ) :

        // Check if the post tag is using the "more" tag
        if ( strpos( get_the_content(), 'more-link' ) ) :

            // Display the content up to the more tag
            the_content( '', '&hellip;' );

        // Otherwise display custom excerpt
        else :

            // Display custom excerpt
            wpex_excerpt( array(
                'length' => wpex_excerpt_length(),
            ) );

        endif;

    // If excerpts are disabled, display full content
    else :

        the_content( '', '&hellip;' );

    endif; ?>

</div><!-- .blog-entry-excerpt -->
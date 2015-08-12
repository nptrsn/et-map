<?php
/**
 * Custom excerpt functions
 * 
 * http://codex.wordpress.org/Function_Reference/wp_trim_words
 *
 * @package     Total
 * @subpackage  functions
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.0.0
 * @version     2.0.0
 */

/**
 * Get or generate excerpts
 *
 * @since Total 1.0.0
 */
function wpex_excerpt( $args ) {
    echo wpex_get_excerpt( $args );
}

/**
 * Get or generate excerpts
 *
 * @since Total 2.0.0
 */
function wpex_get_excerpt( $args = array() ) {

    // Fallback for old method
    if ( ! is_array( $args ) ) {
        $args = array(
            'length' => $args,
        );
    }

    // Setup default arguments
    $defaults = array(
        'output'        => '',
        'length'        => '30',
        'readmore'      => false,
        'readmore_link' => '',
        'more'          => '&hellip;',
    );

    // Parse arguments
    $args = wp_parse_args( $args, $defaults );

    // Filter args
    $args = apply_filters( 'wpex_excerpt_args', $args );

    // Extract args
    extract( $args );

    // Sanitize data
    $excerpt = intval( $length );

    // If length is empty or zero return
    if ( empty( $length ) || '0' == $length ) {
        return;
    }

    // Get global post
    $post = get_post();

    // Display password protected notice
    if ( $post->post_password ) :

        $output = __( 'This is a password protected post.', 'wpex' );
        $output = apply_filters( 'wpex_password_protected_excerpt', $output );
        $output = '<p>'. $output .'</p>';
        return $output;

    endif;

    // Get post data
    $post_id        = $post->ID;
    $post_content   = $post->post_content;
    $post_excerpt   = $post->post_excerpt;

    // Get post excerpt
    if ( $post_excerpt ) {

        $post_excerpt = apply_filters( 'the_content', $post_excerpt );
    }

    // If has custom excerpt
    if ( $post_excerpt ) :

        // Display custom excerpt
        $output = $post_excerpt;

    // Create Excerpt
    else :

        // Return the content including more tag
        if ( '9999' == $length ) {
            return apply_filters( 'the_content', get_the_content( '', '&hellip;' ) );
        }

        // Return the content excluding more tag
        if ( '-1' == $length ) {
            return apply_filters( 'the_content', $post_content );
        }

        // Check for text shortcode in post
        if ( strpos( $post_content, '[vc_column_text]' ) ) {
            $pattern = '{\[vc_column_text\](.*?)\[/vc_column_text\]}is';
            preg_match( $pattern, $post_content, $match );
            if ( isset( $match[1] ) ) {
                $excerpt = wp_trim_words( $match[1], $length, $more );
            } else {
                $content = strip_shortcodes( $post_content );
                $excerpt = wp_trim_words( $content, $length, $more );
            }
        }

        // No text shortcode so lets strip out shortcodes and return the content
        else {
            $content = strip_shortcodes( $post_content );
            $excerpt = wp_trim_words( $content, $length, $more );
        }

        // Add excerpt to output
        $output .= '<p>'. $excerpt .'</p>';

    endif;

    // Add readmore link to output if enabled
    if ( $readmore ) :

        $read_more_text = isset( $args['read_more_text'] ) ? $args['read_more_text'] : __( 'Read more', 'wpex' );
        $output .= '<a href="'. get_permalink( $post_id ) .'" title="'.$read_more_text .'" rel="bookmark" class="wpex-readmore theme-button">'. $read_more_text .' <span class="wpex-readmore-rarr">&rarr;</span></a>';

    endif;

    // Apply filters for easier customization
    $output = apply_filters( 'wpex_excerpt_output', $output );
    
    // Echo output
    return $output;

}

/**
 * Custom excerpt length for posts
 *
 * @since Total 1.0.0
 */
function wpex_excerpt_length() {

    // Theme panel length setting
    $length = get_theme_mod( 'blog_excerpt_length', '40' );

    // Taxonomy setting
    if ( is_category() ) {
        
        // Get taxonomy meta
        $term       = get_query_var( 'cat' );
        $term_data  = get_option( "category_$term" );
        if ( ! empty( $term_data['wpex_term_excerpt_length'] ) ) {
            $length = $term_data['wpex_term_excerpt_length'];
        }
    }

    // Return length and add filter for quicker child theme editign
    return apply_filters( 'wpex_excerpt_length', $length );

}

/**
 * Change default read more style
 *
 * @since Total 1.0.0
 */
function wpex_excerpt_more( $more ) {
    return '&hellip;';
}
add_filter( 'excerpt_more', 'wpex_excerpt_more', 10 );

/**
 * Change default excerpt length
 *
 * @since Total 1.0.0
 */
function wpex_custom_excerpt_length( $length ) {
    return '40';
}
add_filter( 'excerpt_length', 'wpex_custom_excerpt_length', 999 );

/**
 * Prevent Page Scroll When Clicking the More Link
 * http://codex.wordpress.org/Customizing_the_Read_More
 *
 * @since Total 1.0.0
 */
function wpex_remove_more_link_scroll( $link ) {
    $link = preg_replace( '|#more-[0-9]+|', '', $link );
    return $link;
}
add_filter( 'the_content_more_link', 'wpex_remove_more_link_scroll' );
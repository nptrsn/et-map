<?php
/**
 * Helper functions for the blog
 *
 * @package     Total
 * @subpackage  Framework/Blog
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.0.0
 * @version     1.1.0
 */

/**
 * Exclude categories from the blog
 * This function runs on pre_get_posts
 *
 * @since Total 1.0.0
 */
if ( ! function_exists( 'wpex_blog_exclude_categories' ) ) {
    function wpex_blog_exclude_categories( $return = false ) {

        // Don't run in these places
        if ( is_admin() ) {
            return;
        } elseif ( is_search() ) {
            return;
        } elseif ( is_archive() ) {
            return;
        }

        // Get Cat id's to exclude
        if ( $cats = get_theme_mod( 'blog_cats_exclude' ) ) {
            $cats = explode( ',', $cats );
            if ( ! is_array( $cats ) ) {
                return;
            }
        }

        // Return ID's
        if ( $return ) {
            return $cats;
        }

        // Exclude from homepage
        elseif ( is_home() && ! is_singular( 'page' ) ) {
            set_query_var( 'category__not_in', $cats );
        }
        
    }
}

/**
 * Returns the correct blog style
 *
 * @since Total 1.5.3
 */
function wpex_blog_style() {

    // Get default style from Customizer
    $style = get_theme_mod( 'blog_style', 'large-image-entry-style' );

    // Check custom category style
    if ( is_category() ) {
        $term       = get_query_var( 'cat' );
        $term_data  = get_option( "category_$term" );
        if ( $term_data && ! empty ( $term_data['wpex_term_style'] ) ) {
            $style = $term_data['wpex_term_style'] .'-entry-style';
        }
    }

    // Apply filters for child theming
    $style = apply_filters( 'wpex_blog_style', $style );

    // Return style
    return $style;

}

/**
 * Returns the grid style
 *
 * @since Total 1.5.3
 */
function wpex_blog_grid_style() {

    // Get default style from Customizer
    $style = get_theme_mod( 'blog_grid_style', 'fit-rows' );

    // Check custom category style
    if ( is_category() ) {
        $term       = get_query_var( 'cat' );
        $term_data  = get_option( "category_$term" );
        if ( $term_data && ! empty ( $term_data['wpex_term_grid_style'] ) ) {
            $style = $term_data['wpex_term_grid_style'];
        }
    }

    // Apply filters for child theming
    $style = apply_filters( 'wpex_blog_grid_style', $style );

    // Return style
    return $style;

}

/**
 * Checks if it's a fit-rows style grid
 *
 * @since   Total 1.5.3
 * @return  bool
 */
function wpex_blog_fit_rows() {

    // Return false by default
    $return = false;

    // Get current blog style
    if ( 'grid-entry-style' == wpex_blog_style() ) {
        $return = true;
    } else {
        $return = false;
    }

    // Apply filters for child theming
    $return = apply_filters( 'wpex_blog_fit_rows', $return );

    // Return bool
    return $return;

}

/**
 * Returns the correct pagination style
 *
 * @since Total 1.5.3
 */
function wpex_blog_pagination_style() {

    // Get default style from Customizer
    $style = get_theme_mod( 'blog_pagination_style' );

    // Check custom category style
    if ( is_category() ) {
        $term       = get_query_var( 'cat' );
        $term_data  = get_option( "category_$term" );
        if ( $term_data && ! empty ( $term_data['wpex_term_pagination'] ) ) {
            $style = $term_data['wpex_term_pagination'];
        }
    }

    // Apply filters for child theming
    $style = apply_filters( 'wpex_blog_pagination_style', $style );

    // Return style
    return $style;
}

/**
 * Returns correct style for the blog entry based on theme options or category options
 *
 * @since Total 1.5.3
 */
function wpex_blog_entry_style() {

    // Get default style from Customizer
    $style = get_theme_mod( 'blog_style', 'large-image-entry-style' );

    // Check custom category style
    if ( is_category() ) {
        $term       = get_query_var( "cat" );
        $term_data  = get_option( "category_$term" );
        if ( ! empty ( $term_data['wpex_term_style'] ) ) {
            $style = $term_data['wpex_term_style'] .'-entry-style';
        }
    }

    // Apply filters for child theming
    $style = apply_filters( 'wpex_blog_entry_style', $style );

    // Return style
    return $style;

}

/**
 * Checks if the blog entries should have equal heights
 *
 * @since   Total 2.0.0
 * @return  bool
 */
function wpex_blog_entry_equal_heights() {

    // Return if disabled via theme mod
    if ( ! get_theme_mod( 'blog_archive_grid_equal_heights', false ) ) {
        return false;
    }

    // Return true for the grid style
    if ( 'grid-entry-style' == wpex_blog_entry_style() && 'masonry' != wpex_blog_grid_style() ) {
        return true;
    }

}

/**
 * Returns correct columns for the blog entries
 *
 * @since Total 1.5.3
 */
function wpex_blog_entry_columns() {

    // Get columns from customizer setting
    $columns = get_theme_mod( 'blog_grid_columns', '2' );

    // Get custom columns per category basis
    if ( is_category() ) {
        $term       = get_query_var( 'cat' );
        $term_data  = get_option( "category_$term" );
        if ( ! empty ( $term_data['wpex_term_grid_cols'] ) ) {
            $columns = $term_data['wpex_term_grid_cols'];
        }
    }

    // Apply filters for child theming
    $columns = apply_filters( 'wpex_blog_entry_columns', $columns );

    // Return columns
    return $columns;

}


/**
 * Returns correct blog entry classes
 *
 * @since Total 1.1.6
 */
function wpex_blog_entry_classes() {

    // Define classes array
    $classes = array();

    // Entry Style
    $entry_style = wpex_blog_entry_style();

    // Core classes
    $classes[] = 'blog-entry';
    $classes[] = 'clr';

    // Masonry classes
    if ( 'masonry' == wpex_blog_grid_style() ) {
        $classes[] = 'isotope-entry';
    }

    // Equal heights
    if ( wpex_blog_entry_equal_heights() ) {
        $classes[] = 'blog-entry-equal-heights';
    }

    // Add columns for grid style entries
    if ( $entry_style == 'grid-entry-style' ) {
        $classes[] = 'col';
        $classes[] = wpex_grid_class( wpex_blog_entry_columns() );
    }

    // No Featured Image Class, don't add if oembed or self hosted meta are defined
    if ( ! has_post_thumbnail()
        && '' == get_post_meta( get_the_ID(), 'wpex_post_self_hosted_shortcode', true )
        && '' == get_post_meta( get_the_ID(), 'wpex_post_oembed', true ) ) {
        $classes[] = 'no-featured-image';
    }

    // Blog entry style
    $classes[] = $entry_style;

    // Counter
    global $wpex_count;
    if ( $wpex_count ) {
        $classes[] = 'col-'. $wpex_count;
    }

    // Apply filters to entry post class for child theming
    $classes = apply_filters( 'wpex_blog_entry_classes', $classes );

    // Rturn classes array
    return $classes;
}

/**
 * Check if author avatar is enabled or not for blog entries
 *
 * @since Total 1.0
 * @return bool
 */
if ( ! function_exists( 'wpex_post_entry_author_avatar_enabled' ) ) {
    function wpex_post_entry_author_avatar_enabled() {
        if ( get_theme_mod( 'blog_entry_author_avatar' ) ) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Returns the blog entry thumbnail
 *
 * @since Total 1.0
 */
function wpex_blog_entry_thumbnail( $args = '' ) {
    echo wpex_get_blog_entry_thumbnail( $args );
}

/**
 * Returns the blog entry thumbnail
 *
 * @since Total 1.0
 */
function wpex_get_blog_entry_thumbnail( $args = '' ) {

    // If args isn't array then it's the attachment
    if ( $args && ! is_array( $args ) ) {
        $args = array(
            'attachment' => $args,
        );
    }

    // Define thumbnail args
    $defaults = array(
        'attachment'    => get_post_thumbnail_id(),
        'size'          => 'blog_entry',
        'alt'           => wpex_get_esc_title(),
        'width'         => '',
        'height'        => '',
        'class'         => '',
    );

    // Parse arguments
    $args = wp_parse_args( $args, $defaults );

    // Custom sizes for categories
    if ( is_category() ) {

        // Get term data
        $term       = get_query_var('cat');
        $term_data  = get_option("category_$term");

        // Width
        if ( ! empty( $term_data['wpex_term_image_width'] ) ) {
            $args['size']   = 'wpex_custom';
            $args['width']  = $term_data['wpex_term_image_width'];
        }

        // height
        if ( ! empty( $term_data['wpex_term_image_height'] ) ) {
            $args['size']   = 'wpex_custom';
            $args['height'] = $term_data['wpex_term_image_height'];
        }

    }

    // Apply filter to args
    $args = apply_filters( 'wpex_blog_entry_thumbnail_args', $args );

    // Generate thumbnail
    $thumbnail = wpex_get_post_thumbnail( $args );

    // Return thumbnail
    return apply_filters( 'wpex_blog_entry_thumbnail', $thumbnail );

}

/**
 * Displays the blog post thumbnail
 *
 * @since Total 1.0
 */
function wpex_blog_post_thumbnail( $args = '' ) {
    echo wpex_get_blog_post_thumbnail( $args );
}

/**
 * Returns the blog post thumbnail
 *
 * @since Total 1.0
 */
function wpex_get_blog_post_thumbnail( $args = '' ) {

    // If args isn't array then it's the attachment
    if ( ! is_array( $args ) && ! empty( $args ) ) {
        $args = array(
            'attachment' => $args,
            'alt'       => wpex_get_esc_title(),
            'width'     => '',
            'height'    => '',
            'class'     => '',
        );
    }

    // Defaults
    $defaults = array(
        'size' => 'blog_post',
    );

    // Parse arguments
    $args = wp_parse_args( $args, $defaults );

    // Apply filter to args
    $args = apply_filters( 'wpex_blog_entry_thumbnail_args', $args );

    // Generate thumbnail
    $thumbnail = wpex_get_post_thumbnail( $args );

    // Apply filters for child theming
    return apply_filters( 'wpex_blog_post_thumbnail', $thumbnail );

}

/**
 * Returns post video URL
 *
 * @since Total 1.0
 */
function wpex_post_video_url( $post_id ) {

    // Get global object if post id isn't defined
    if ( ! $post_id ) {
        global $wpex_theme;
        $post_id = $wpex_theme->post_id;
    }

    // Oembed
    if ( $meta = get_post_meta( $post_id, 'wpex_post_oembed', true ) ) {
        return esc_url( $meta );
    }

    // Self Hosted redux
    $video = get_post_meta( $post_id, 'wpex_post_self_hosted_shortcode_redux', true );
    if ( is_array( $video ) && ! empty( $video['url'] ) ) {
        return $video['url'];
    }

    // Self Hosted old - Thunder theme compatibility
    if ( $meta = get_post_meta( $post_id, 'wpex_post_self_hosted_shortcode', true ) ) {
        return $meta;
    }

}

/**
 * Returns post audio URL
 *
 * @since Total 1.0
 */
function wpex_post_audio_url( $post_id ) {

    // Get global object if post id isn't defined
    if ( ! $post_id ) {
        global $wpex_theme;
        $post_id = $wpex_theme->post_id;
    }

    // Oembed
    if ( $meta = get_post_meta( $post_id, 'wpex_post_oembed', true ) ) {
        return $meta;
    }

    // Self Hosted redux
    $audio = get_post_meta( $post_id, 'wpex_post_self_hosted_shortcode_redux', true );
    if ( is_array( $audio ) && ! empty( $audio['url'] ) ) {
        return $audio['url'];
    }

    // Self Hosted old - Thunder theme compatibility
    if ( $meta = get_post_meta( $post_id, 'wpex_post_self_hosted_shortcode', true ) ) {
        return $meta;
    }

}

/**
 * Adds main classes to blog post entries
 *
 * @since Total 1.1.6
 */
function wpex_blog_wrap_classes( $classes = NULL ) {
    
    // Return custom class if set
    if ( $classes ) {
        return $classes;
    }
    
    // Admin defaults
    $style      = wpex_blog_style();
    $classes    = array();
        
    // Isotope classes
    if ( $style == 'grid-entry-style' ) {
        $classes[] = 'wpex-row ';
        if ( 'masonry' == wpex_blog_grid_style() ) {
            $classes[] = 'blog-masonry-grid ';
        } else {
            if ( 'infinite_scroll' == wpex_blog_pagination_style() ) {
                $classes[] = 'blog-masonry-grid ';
            } else {
                $classes[] = 'blog-grid ';
            }
        }
    }
    
    // Add some margin when author is enabled
    if ( $style == 'grid-entry-style' && get_theme_mod( 'blog_entry_author_avatar' ) ) {
        $classes[] = 'grid-w-avatars ';
    }
    
    // Infinite scroll classes
    if ( 'infinite_scroll' == wpex_blog_pagination_style() ) {
        $classes[] = 'infinite-scroll-wrap ';
    }
    
    // Add filter for child theming
    $classes = apply_filters( 'wpex_blog_wrap_classes', $classes );

    // Turn classes into space seperated string
    if ( is_array( $classes ) ) {
        $classes = implode( ' ', $classes );
    }

    // Echo classes
    echo $classes;
    
}

/**
 * Gets correct heading for the related blog items
 *
 * @since Total 2.0.0
 */
function wpex_blog_related_heading() {

    // Get heading text
    $heading = get_theme_mod( 'blog_related_title' );

    // Fallback
    $heading = $heading ? $heading : __( 'Related Posts', 'wpex' );

    // Translate heading with WPML
    $heading = wpex_translate_theme_mod( 'blog_related_title', $heading );

    // Return heading
    return $heading;

}

/**
 * Returns blog entry blocks
 *
 * @since   Total 2.0.0
 * @return  array
 */
function wpex_blog_entry_layout_blocks() {

    // Get layout blocks
    $blocks = get_theme_mod( 'blog_entry_composer' );

    // If blocks are 100% empty return defaults
    $blocks = $blocks ? $blocks : 'featured_media,title_meta,excerpt_content,readmore';
                
    // Apply filters to entry layout blocks
    $blocks = apply_filters( 'wpex_blog_entry_layout_blocks', $blocks );

    // Convert blocks to array so we can loop through them
    if ( ! is_array( $blocks ) ) {
        $blocks = explode( ',', $blocks );
    }

    // Return blocks
    return $blocks;

}

/**
 * Returns blog entry post blocks
 *
 * @since   Total 2.0.0
 * @return  array
 */
function wpex_blog_entry_meta_sections() {

    // Default sections
    $sections = array( 'date', 'author', 'categories', 'comments' );

    // Get Sections from Customizer
    $sections = get_theme_mod( 'blog_entry_meta_sections', $sections );

    // Apply filters for easy modification
    $sections = apply_filters( 'wpex_blog_entry_meta_sections', $sections );

    // Turn into array if string
    if ( $sections && ! is_array( $sections ) ) {
        $sections = explode( ',', $sections );
    }

    // Return sections
    return $sections;

}

/**
 * Returns single blog post blocks
 *
 * @since   Total 2.0.0
 * @return  array
 */
function wpex_blog_single_layout_blocks() {

    // Get layout blocks
    $blocks = get_theme_mod( 'blog_single_composer' );

    // If blocks are 100% empty return defaults
    $blocks = $blocks ? $blocks : 'featured_media,title_meta,post_series,the_content,post_tags,social_share,author_bio,related_posts,comments';
                
    // Apply filters to entry layout blocks
    $blocks = apply_filters( 'wpex_blog_single_layout_blocks', $blocks );

    // Convert blocks to array so we can loop through them
    if ( ! is_array( $blocks ) ) {
        $blocks = explode( ',', $blocks );
    }

    // Return blocks
    return $blocks;

}

/**
 * Returns single blog post blocks
 *
 * @since   Total 2.0.0
 * @return  array
 */
function wpex_blog_single_meta_sections() {

    // Default sections
    $sections = array( 'date', 'author', 'categories', 'comments' );

    // Get Sections from Customizer
    $sections = get_theme_mod( 'blog_post_meta_sections', $sections );

    // Apply filters for easy modification
    $sections = apply_filters( 'wpex_blog_single_meta_sections', $sections );

    // Turn into array if string
    if ( $sections && ! is_array( $sections ) ) {
        $sections = explode( ',', $sections );
    }

    // Return sections
    return $sections;

}

/**
 * Returns data attributes for the blog gallery slider
 *
 * @since   Total 2.0.0
 * @return  array
 */
function wpex_blog_slider_data_atrributes() {

    // Define main vars
    $attributes                         = array();
    $return                             = '';
    $attributes['auto-play']            = 'false';
    $attributes['buttons']              = 'false';
    $attributes['fade']                 = 'true';
    $attributes['loop']                 = 'true';
    $attributes['thumbnails-height']    = '60';
    $attributes['thumbnails-width']     = '60';

    // Apply filters for child theming
    $attributes = apply_filters( 'wpex_blog_slider_data_atrributes', $attributes );

    // Turn array into HTML
    foreach ( $attributes as $key => $val ) {
        $return .= ' data-'. $key .'="'. $val .'"';
    }

    // Return
    echo $return;

}

/**
 * Returns correct blog slider video embed code
 * Adds unique class for the slider
 *
 * @since   Total 2.0.0
 * @return  array
 */
function wpex_blog_slider_video( $attachment ) {
    $video  = get_post_meta( $attachment, '_video_url', true );
    $video  = wp_oembed_get( esc_url( $video ) );
    $video  = wpex_add_sp_video_to_oembed( $video );
    return $video;
}
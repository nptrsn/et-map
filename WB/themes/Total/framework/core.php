<?php
/**
 * Core theme functions - very important!! Do not ever edit this file, if you need to make
 * adjustments, please use a child theme. If you aren't sure how, please ask!
 *
 * @package     Total
 * @subpackage  Framework/Core
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.3.3
 * @version     2.0.2
 */

/**
 * Returns theme custom post types
 *
 * @since   Total 1.3.3
 * @return  array
 */
function wpex_theme_post_types() {
    $post_types = array( 'portfolio', 'staff', 'testimonials' );
    $post_types = array_combine( $post_types, $post_types );
    $post_types = apply_filters( 'wpex_theme_post_types', $post_types );
    return $post_types;
}

/**
 * Was used to retrieve redux theme options
 * Returns theme mod since 1.6.0
 *
 * @since Total 1.3.3
 */
function wpex_option( $id, $fallback = false, $param = false ) {
    return get_theme_mod( $id, $fallback );
}

/**
 * Check if retina is enabled
 *
 * @since Total 1.3.3
 */
function wpex_is_retina_enabled() {
    if ( get_theme_mod( 'image_resizing', true ) && get_theme_mod( 'retina', false ) ) {
        return true;
    }
}

/**
 * Get's the current ID, this function is needed to properly support WooCommerce
 *
 * @since   Total 1.5.4
 * @return  string
 */
function wpex_get_the_id() {

    // If singular get_the_ID
    if ( is_singular() ) {
        return get_the_ID();
    }

    // Get ID of WooCommerce product archive
    elseif ( WPEX_WOOCOMMERCE_ACTIVE && is_shop()  ) {
        $shop_id = wc_get_page_id( 'shop' );
        if ( isset( $shop_id ) ) {
            return wc_get_page_id( 'shop' );
        }
    }

    // Posts page
    elseif ( is_home() && $page_for_posts = get_option( 'page_for_posts' ) ) {
        return $page_for_posts;
    }

    // Return nothing
    else {
        return NULL;
    }

}

/**
 * Returns the correct main layout class
 *
 * @since   Total 1.5.0
 * @return  string
 */
function wpex_main_layout( $post_id = '' ) {

    // Check URL
    if ( ! empty( $_GET['site_layout'] ) ) {
        return $_GET['site_layout'];
    }

    // Get global object
    global $wpex_theme;

    // Get layout
    $layout = get_theme_mod( 'main_layout_style', 'full-width' );
    $meta   = get_post_meta( $post_id, 'wpex_main_layout', true );
    $layout = $meta ? $meta : $layout;

    // Check skin
    if ( 'gaps' == $wpex_theme->skin ) {
        $layout = 'boxed';
    }

    // Apply filters for child theming
    $layout = apply_filters( 'wpex_main_layout', $layout );

    // Return layout
    return $layout;

}

/**
 * Returns correct mobile menu style
 *
 * @since   Total 1.3.3
 * @return  string
 */
function wpex_mobile_menu_style() {

    // Get global object
    global $wpex_theme;

    // Get style defined in Customizer
    $style = get_theme_mod( 'mobile_menu_style', 'sidr' );

    // Sanitize
    $style = $style ? $style : 'sidr';

    // Disable if responsive is disabled
    $style = $wpex_theme->responsive ? $style : 'disabled';

    // Apply filters
    $style = apply_filters( 'wpex_mobile_menu_style', $style );

    // Return
    return $style;

}

/**
 * The source for the sidr mobile menu
 *
 * @since   Total 1.5.1
 * @return  string
 */
function wpex_mobile_menu_source() {

    // Define array of items
    $items = array();

    // Add close button
    $items['sidrclose'] = '#sidr-close';

    // Add mobile menu alternative if defined
    if ( has_nav_menu( 'mobile_menu_alt' ) ) {
        $items['nav'] = '#mobile-menu-alternative';
    }

    // If mobile menu alternative is not defined add main navigation
    else {
        $items['nav'] = '#site-navigation';
    }

    // Add search form
    $items['search'] = '#mobile-menu-search';

    // Apply filters for child theming
    $items = apply_filters( 'wpex_mobile_menu_source', $items );

    // Turn items into comma seperated list
    $items = implode( ', ', $items );

    // Return items
    return $items;
}

/**
 * Returns lightbox skin
 *
 * @return  $skin
 * @since   Total 1.3.3
 */
function wpex_ilightbox_skin() {

    // Get skin from Customizer setting
    $skin = get_theme_mod( 'lightbox_skin', 'dark' );

    // Sanitize
    $skin = $skin ? $skin : 'dark';
        
    // Apply filters
    $skin = apply_filters( 'wpex_lightbox_skin', $skin );

    // Return
    return $skin;

}

/**
 * Returns correct iLightbox skin directory
 *
 * @return  $skin
 * @since   Total 1.3.3
 */
function wpex_ilightbox_stylesheet( $skin ) {

    // Loop through skins
    $stylesheet = WPEX_CSS_DIR_URI .'ilightbox/'. $skin .'-skin/skin.css';

    // Apply filters
    $stylesheet = apply_filters( 'wpex_ilightbox_stylesheet', $stylesheet );

    // Return directory uri
    return $stylesheet;

}

/**
 * Defines your default search results page style
 *
 * @return  $style
 * @since   Total 1.5.4
 */
function wpex_search_results_style() {
    $style = apply_filters( 'wpex_search_results_style', 'default' );
    return $style;
}

/**
 * Echo the post URL
 *
 * @since   Total 1.5.4
 * @return  string
 */
function wpex_permalink( $post_id = '' ) {
    echo wpex_get_permalink( $post_id );
}

/**
 * Return the post URL
 *
 * @since   Total 2.0.0
 * @return  string
 */
function wpex_get_permalink( $post_id = '' ) {

    // If post ID isn't defined lets get it
    $post_id = $post_id ? $post_id : get_the_ID();

    // Check wpex_post_link custom field for custom link
    $meta = get_post_meta( $post_id, 'wpex_post_link', true );

    // If wpex_post_link custom field is defined return that otherwise return the permalink
    $permalink  = $meta ? $meta : get_permalink( $post_id );

    // Apply filters
    $permalink = apply_filters( 'wpex_permalink', $permalink );

    // Sanitize
    $permalink = esc_url( $permalink );

    // Return permalink
    return $permalink;

}

/**
 * Return custom permalink
 *
 * @since   Total 2.0.0
 * @return  string
 */
function wpex_get_custom_permalink() {
    $link = get_post_meta( get_the_ID(), 'wpex_post_link', true );
    return esc_url( $link );
}

/**
 * Echo escaped post title
 *
 * @since   Total 2.0.0
 * @return  string
 */
function wpex_esc_title() {
    echo wpex_get_esc_title();
}

/**
 * Return escaped post title
 *
 * @since   Total 1.5.4
 * @return  string
 */
function wpex_get_esc_title() {
    return esc_attr( the_title_attribute( 'echo=0' ) );
}

/**
 * Returns the correct sidebar ID
 *
 * @return  $sidebar
 * @since   1.0.0
 */
function wpex_get_sidebar( $sidebar = 'sidebar' ) {

    // Get global object
    global $wpex_theme;

    // Pages
    if ( is_page() && get_theme_mod( 'pages_custom_sidebar', true ) ) {
        if ( ! is_page_template( 'templates/blog.php' ) ) {
            $sidebar = 'pages_sidebar';
        }
    }

    // Staff
    elseif ( is_singular( 'staff' ) || wpex_is_staff_tax() ) {
        if ( get_theme_mod( 'staff_custom_sidebar', true ) ) {
            $sidebar = 'staff_sidebar';
        }
    }

    // Testimonials
    elseif ( is_singular( 'testimonials' ) || wpex_is_testimonials_tax() ) {
        if ( get_theme_mod( 'testimonials_custom_sidebar', true ) ) {
            $sidebar = 'testimonials_sidebar';
        }
    }

    // Search
    elseif ( is_search() && get_theme_mod( 'search_custom_sidebar', true ) ) {
        $sidebar = 'search_sidebar';
    }
    
    // bbPress
    elseif ( function_exists( 'is_bbpress' ) && is_bbpress() && get_theme_mod( 'bbpress_custom_sidebar', true ) ) {
        $sidebar = 'bbpress_sidebar';
    }
    
    // Add filter for tweaking the sidebar display via child theme's
    $sidebar = apply_filters( 'wpex_get_sidebar', $sidebar );

    // Check meta option after filter so it always overrides
    if ( $meta = get_post_meta( $wpex_theme->post_id, 'sidebar', true ) ) {
        $sidebar = $meta;
    }

    // Return the correct sidebar
    return $sidebar;
    
}

/**
 * Returns the correct sidebar ID
 *
 * @since 1.6.5
 */
function wpex_display_sidebar() {
    $sidebar = wpex_get_sidebar();
    if ( $sidebar ) {
        dynamic_sidebar( $sidebar );
    }
}

/**
 * Returns the correct classname for any specific column grid
 *
 * @return $class
 * @since   1.0.0
 */
function wpex_grid_class( $col = '4' ) {
    $class = 'span_1_of_'. $col;
    $class = apply_filters( 'wpex_grid_class', $class );
    return $class;
}

/**
 * Returns the 1st taxonomy of any taxonomy
 *
 * @since Total 1.3.3
 */
function wpex_get_first_term( $post_id, $taxonomy = 'category' ) {
    if ( ! $post_id ) {
        return;
    }
    if ( ! taxonomy_exists( $taxonomy ) ) {
        return;
    }
    $terms = wp_get_post_terms( $post_id, $taxonomy );
    if ( ! empty( $terms ) ) { ?>
        <span><?php echo $terms[0]->name; ?></span>
    <?php
    }
}

/**
 * Echos 1st taxonomy of any taxonomy with a link
 *
 * @since Total 2.0.0
 */
function wpex_first_term_link( $post_id, $taxonomy = 'category' ) {
    if ( ! $post_id ) {
        return;
    }
    if ( ! taxonomy_exists( $taxonomy ) ) {
        return;
    }
    $terms = wp_get_post_terms( $post_id, $taxonomy );
    if ( ! empty( $terms ) ) {
        $term_link = get_term_link( $terms[0], $taxonomy ); ?>
        <a href="<?php echo esc_url( $term_link ); ?>" title="<?php esc_attr( $terms[0]->name ); ?>"><?php echo $terms[0]->name; ?></a>
    <?php
    }
}

/**
 * List categories for specific taxonomy
 * 
 * @link    http://codex.wordpress.org/Function_Reference/wp_get_post_terms
 * @since   Total 1.6.3
 */
function wpex_list_post_terms( $taxonomy = 'category', $show_links = true, $echo = true ) {

    // Get terms
    $list_terms = array();
    $terms      = wp_get_post_terms( get_the_ID(), $taxonomy );

    // Return if no terms are found
    if ( ! $terms ) {
        return;
    }

    // Loop through terms
    foreach ( $terms as $term ) {
        $permalink = get_term_link( $term->term_id, $taxonomy );
        if ( $show_links ) {
            $list_terms[]   = '<a href="'. $permalink .'" title="'. $term->name .'" class="term-'. $term->term_id .'">'. $term->name .'</a>';
        } else {
            $list_terms[]   = '<span class="term-'. $term->term_id .'">'. $term->name .'</span>';
        }
    }

    // Turn into comma seperated string
    if ( $list_terms && is_array( $list_terms ) ) {
        $list_terms = implode( ', ', $list_terms );
    } else {
        return;
    }

    // Echo terms
    if ( $echo ) {
        echo $list_terms;
    } else {
        return $list_terms;
    }

}

/**
 * Minify CSS
 *
 * @since   Total 1.6.3
 * @return  string
 */
function wpex_minify_css( $css ) {

    if ( ! $css ) {
        return;
    }

    // Normalize whitespace
    $css = preg_replace( '/\s+/', ' ', $css );

    // Remove ; before }
    $css = preg_replace( '/;(?=\s*})/', '', $css );

    // Remove space after , : ; { } */ >
    $css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );

    // Remove space before , ; { }
    $css = preg_replace( '/ (,|;|\{|})/', '$1', $css );

    // Strips leading 0 on decimal values (converts 0.5px into .5px)
    $css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );

    // Strips units if value is 0 (converts 0px to 0)
    $css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

    // Trim
    $css = trim( $css );

    // Return minified CSS
    return $css;
    
}

/**
 * Provides translation support for plugins such as WPML
 *
 * @since   Total 1.6.3
 * @return  string
 */
function wpex_translate_theme_mod( $id, $content ) {

    // Return false if no content is found
    if ( ! $content ) {
        return false;
    }

    // WPML translation
    if ( function_exists( 'icl_t' ) && $id ) {
        $content = icl_t( 'Theme Mod', $id, $content );
    }

    // Polylang Translation
    if ( function_exists( 'pll__' ) && $id ) {
        $content = pll__( $content );
    }

    // Return the content
    return $content;

}

/**
 * Outputs a theme heading
 * 
 * @since Total 1.3.3
 */
if ( ! function_exists( 'wpex_heading' ) ) {
    function wpex_heading( $args = array() ) {

        // Defaults
        $defaults = array(
            'apply_filters' => '',
            'content'       => '',
            'tag'           => 'h2',
            'classes'       => array(),
        );

        // Add filters if defined
        if ( ! empty( $args['apply_filters'] ) ) {
            $args = apply_filters( 'wpex_heading_'. $args['apply_filters'], $args );
        }

        // Parse args
        wp_parse_args( $args, $defaults );

        // Extract args
        extract( $args );

        // Return if text is empty
        if ( ! $content ) {
            return;
        }

        // Get classes
        $add_classes    = $classes;
        $classes        = array( 'theme-heading' );
        if ( $add_classes && is_array( $add_classes ) ) {
            $classes = array_merge( $classes, $add_classes );
        }

        // Turn classes into space seperated string
        $classes = implode( ' ', $classes ); ?>

        <<?php echo $tag; ?> class="<?php echo $classes; ?>">
            <span class="text"><?php echo $content; ?></span>
        </<?php echo $tag; ?>><!-- <?php echo $classes; ?> -->

    <?php
    }
}

/**
 * Provides translation support for plugins such as WPML
 * 
 * @since Total 1.3.3
 */
if ( ! function_exists( 'wpex_element' ) ) {
    function wpex_element( $element ) {

        // Rarr
        if ( 'rarr' == $element ) {
            if ( is_rtl() ) {
                return '&larr;';
            } else {
                return '&rarr;';
            }
        }

        // Angle Right
        elseif ( 'angle_right' == $element ) {

            if ( is_rtl() ) {
                return '<span class="fa fa-angle-left"></span>';
            } else {
                return '<span class="fa fa-angle-right"></span>';
            }

        }

    }
}

/**
 * Checks if a featured image has a caption
 *
 * @since   Total 2.0.0
 * @return  bool
 */
function wpex_featured_image_caption( $post_id = '' ) {
    $post_id        = $post_id ? $post_id : get_the_ID();
    $thumbnail_id   = get_post_thumbnail_id( $post_id );
    $caption        = get_post_field( 'post_excerpt', $thumbnail_id );
    return $caption;
}

/**
 * Adds the sp-video class to an iframe
 *
 * @since   Total 1.0.0
 * @return  string
 */
function wpex_add_sp_video_to_oembed( $oembed ) {
    $oembed = str_replace( 'iframe', 'iframe class="sp-video"', $oembed );
    return $oembed;
}

/**
 * Echo lightbox image URL
 *
 * @since   Total 2.0.0
 * @return  string
 */
function wpex_lightbox_image( $attachment = '' ) {
    echo wpex_get_lightbox_image( $attachment );
}

/**
 * Returns lightbox image URL.
 *
 * @since   Total 2.0.0
 * @return  string
 */
function wpex_get_lightbox_image( $attachment = '' ) {

    // If attachment is empty lets set it to the post thumbnail id
    if ( ! $attachment ) {
        $attachment = get_post_thumbnail_id();
    }

    // Set default size
    $size = apply_filters( 'wpex_get_lightbox_image_size', 'large' );

    // If the attachment is an ID lets get the URL
    if ( is_numeric( $attachment ) ) {
        $image = wp_get_attachment_image_src( $attachment, $size );
    } elseif ( is_array( $attachment ) ) {
        $image = $attachment[0];
    } else {
        $image = $attachment;
    }

    // Sanitize data
    if ( ! empty( $image[0] ) ) {
        $image = $image[0];
    } else {
        $image = wp_get_attachment_url( $attachment );   
    }

    // Return escaped image
    return esc_url( $image );
}

/**
 * Returns attachment data
 *
 * @since   Total 2.0.0
 * @return  array
 */
function wpex_get_attachment_data( $attachment = '', $return = '' ) {

    // Return if no attachment
    if ( ! $attachment ) {
        return;
    }

    // Return if return equals none
    if ( 'none' == $return ) {
        return;
    }

    // Create array of attachment data
    $array = array(
        'url'           => get_post_meta( $attachment, '_wp_attachment_url', true ),
        'src'           => wp_get_attachment_url( $attachment ),
        'alt'           => get_post_meta( $attachment, '_wp_attachment_image_alt', true ),
        'title'         => get_the_title( $attachment),
        'caption'       => get_post_field( 'post_excerpt', $attachment ),
        'description'   => get_post_field( 'post_content', $attachment ),
        'video'         => esc_url( get_post_meta( $attachment, '_video_url', true ) ),
    );

    // Return data
    if ( $return ) {
        return $array[$return];
    } else {
        return $array;
    }

}

/**
 * Returns correct hover animation class
 *
 * @since   Total 2.0.0
 * @return  array
 */
function wpex_hover_animation_class( $animation ) {
    $animation = 'hvr-'. $animation;
    return $animation;
}

/**
 * Echo animation classes for entries
 *
 * @since   Total 1.1.6
 * @return  string
 */
function wpex_entry_image_animation_classes() {
    echo wpex_get_entry_image_animation_classes();
}

/**
 * Returns animation classes for entries
 *
 * @since   Total 1.1.6
 * @return  string
 */
function wpex_get_entry_image_animation_classes() {

    // Empty by default
    $classes = '';

    // Only used for standard posts now
    if ( 'post' != get_post_type( get_the_ID() ) ) {
        return;
    }

    // Get blog classes
    if ( get_theme_mod( 'blog_entry_image_hover_animation' ) ) {
        $classes = ' wpex-image-hover '. get_theme_mod( 'blog_entry_image_hover_animation' );
    }

    // Apply filters
    return apply_filters( 'wpex_entry_image_animation_classes', $classes );

}


/**
 * Returns thumbnail sizes
 *
 * @link    http://codex.wordpress.org/Function_Reference/get_intermediate_image_sizes
 * @since   Total 2.0.0
 * @return  array
 */
function wpex_get_thumbnail_sizes( $size = '' ) {

    global $_wp_additional_image_sizes;

    $sizes                          = array(
        'full'  => array(
            'width'     => '9999',
            'height'    => '9999',
            'crop'      => 0
        ),
    );
    $get_intermediate_image_sizes   = get_intermediate_image_sizes();

    // Create the full array with sizes and crop info
    foreach( $get_intermediate_image_sizes as $_size ) {

        if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

            $sizes[ $_size ]['width']   = get_option( $_size . '_size_w' );
            $sizes[ $_size ]['height']  = get_option( $_size . '_size_h' );
            $sizes[ $_size ]['crop']    = (bool) get_option( $_size . '_crop' );

        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

            $sizes[ $_size ] = array( 
                'width'     => $_wp_additional_image_sizes[ $_size ]['width'],
                'height'    => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop'      => $_wp_additional_image_sizes[ $_size ]['crop']
            );

        }

    }

    // Get only 1 size if found
    if ( $size ) {
        if ( isset( $sizes[ $size ] ) ) {
            return $sizes[ $size ];
        } else {
            return false;
        }
    }

    // Return sizes
    return $sizes;
}

/**
 * Generates a retina image
 *
 * @since Total 2.0.0
 */
function wpex_generate_retina_image( $image, $width, $height, $crop ) {

    // Define cropping args
    $args = array(
        'image'     => $image,
        'width'     => $width,
        'height'    => $height,
        'crop'      => $crop,
        'return'    => 'url',
        'retina'    => true,
    );

    // Resize image and create retina version
    $image = wpex_image_resize( $args );

    // Return image
    return $image;

}

/**
 * Echo post thumbnail url
 *
 * @since   Total 2.0.0
 * @return  string
 */
function wpex_post_thumbnail_url( $args = array() ) {
    echo wpex_get_post_thumbnail_url( $args );
}

/**
 * Return post thumbnail url
 *
 * @since   Total 2.0.0
 * @return  string
 */
function wpex_get_post_thumbnail_url( $args = array() ) {
    $args['return'] = 'url';
    return wpex_get_post_thumbnail( $args );
}

/**
 * Outputs the img HTMl thubmails used in the Total VC modules
 *
 * @since   Total 2.0.0
 * @return  string
 */
function wpex_post_thumbnail( $args = array() ) {
    echo wpex_get_post_thumbnail( $args );
}

/**
 * Returns correct HTMl for post thumbnails
 *
 * @since   Total 2.0.0
 * @return  string
 */
function wpex_get_post_thumbnail( $args = array() ) {

    // Check if retina is enabled
    $retina     = wpex_is_retina_enabled();
    $retina_img = '';
    $attr       = array();

    // Default args
    $defaults = array(
        'attachment'    => get_post_thumbnail_id(),
        'size'          => 'full',
        'width'         => '',
        'height'        => '',
        'crop'          => 'center-center',
        'alt'           => '',
        'class'         => '',
        'return'        => 'html',
        'style'         => '',
    );

    // Parse args
    $args = wp_parse_args( $args, $defaults );

    // Extract args
    extract( $args );

    // Return if there isn't any attachment
    if ( ! $attachment ) {
        return;
    }

    // Sanitize variables
    $size   = ( 'wpex-custom' == $size ) ? 'wpex_custom' : $size;
    $size   = ( 'wpex_custom' == $size ) ? false : $size;
    $crop   = ( ! $crop ) ? 'center-center' : $crop;
    $crop   = ( 'true' == $crop ) ? 'center-center' : $crop;

    // Image must have an alt
    if ( empty( $alt ) ) {
        $alt = get_post_meta( $attachment, '_wp_attachment_image_alt', true );
    }
    if ( empty( $alt ) ) {
        $alt = trim( strip_tags( get_post_field( 'post_excerpt', $attachment ) ) );
    }
    if ( empty( $alt ) ) {
        $alt = trim( strip_tags( get_the_title( $attachment ) ) );
        $alt = str_replace( '_', ' ', $alt );
        $alt = str_replace( '-', ' ', $alt );
    }

    // Prettify alt attribute
    if ( $alt ) {
        $alt = ucwords( $alt );
    }

    // If image width and height equal '9999' return full image
    if ( '9999' == $width && '9999' == $height ) {
        $size   = $size ? $size : 'full';
        $width  = $height = '';
    }

    // Define crop locations
    $crop_locations = array_flip( wpex_image_crop_locations() );

    // Set crop location if defined in format 'left-top' and turn into array
    if ( $crop && in_array( $crop, $crop_locations ) ) {
        $crop = ( 'center-center' == $crop ) ? true : explode( '-', $crop );
    }

    // Get attachment URl
    $attachment_url = wp_get_attachment_url( $attachment );

    // Return if there isn't any attachment URL
    if ( ! $attachment_url ) {
        return;
    }

    // Add classes
    if ( $class ) {
        $attr['class'] = $class;
    }

    // Add alt
    if ( $alt ) {
        $attr['alt'] = $alt;
    }

    // Add style
    if ( $style ) {
        $attr['style'] = $style;
    }

    // If on the fly image resizing is enabled or a custom width/height is defined
    if ( get_theme_mod( 'image_resizing', true ) || ( $width || $height ) ) {

        // Add Classes
        if ( $class ) {
            $class = ' class="'. $class .'"';
        }

        // If size is defined and not equal to wpex_custom
        if ( $size && 'wpex_custom' != $size ) {
            $dims   = wpex_get_thumbnail_sizes( $size );
            $width  = $dims['width'];
            $height = $dims['height'];
            $crop   = ! empty( $dims['crop'] ) ? $dims['crop'] : $crop;
        }


        // Crop standard image
        $image = wpex_image_resize( array(
            'image'     => $attachment_url,
            'width'     => $width,
            'height'    => $height,
            'crop'      => $crop,
        ) );

        // Generate retina version
        if ( $retina ) {
            $retina_img = wpex_generate_retina_image( $attachment_url, $width, $height, $crop );
            if ( $retina_img ) {
                $attr['data-at2x'] = $retina_img;
            } else {
                $attr['data-no-retina'] = '';
            }
        }

        // Return HTMl
        if ( $image ) {

            // Return image URL
            if ( 'url' == $return ) {
                return $image['url'];
            }

            // Return image HTMl
            else {

                // Add attributes
                $attr = array_map( 'esc_attr', $attr );
                $html = '';
                foreach ( $attr as $name => $value ) {
                    $html .= ' '. $name .'="'. $value .'"';
                }

                // Return img
                return '<img src="'. $image['url'] .'" width="'. $image['width'] .'" height="'. $image['height'] .'"'. $html .' />';

            }

        }

    }

    // Return image from add_image_size
    else {

        // Sanitize size
        $size = $size ? $size : 'full';

        // Create retina version if retina is enabled (not needed for full images)
        if ( $retina ) {

            // Retina not needed for full images
            if ( 'full' != $size ) {
                $dims       = wpex_get_thumbnail_sizes( $size );
                $retina_img = wpex_generate_retina_image( $attachment_url, $dims['width'], $dims['height'], $dims['crop'] );
            }

            // Add retina tag
            if ( $retina_img ) {
                $attr['data-at2x'] = $retina_img;
            } else {
                $attr['data-no-retina'] = '';
            }

        }

        // Return image URL
        if ( 'url' == $return ) {
            $src = wp_get_attachment_image_src( $attachment, $size, false );
            return $src[0];
        }

        // Return image HTMl
        else {
            return wp_get_attachment_image( $attachment, $size, false, $attr );
        }

    }

}

/**
 * Echo post video
 *
 * @since   Total 2.0.0
 * @return  string
 */
function wpex_post_video( $post_id ) {
    echo wpex_get_post_video( $post_id );
}

/**
 * Returns post video
 *
 * @since   Total 2.0.0
 * @return  string
 */
function wpex_get_post_video( $post_id = '' ) {

    // Define video variable
    $video = '';

    // Get correct ID
    $post_id = $post_id ? $post_id : get_the_ID();

    // Embed
    if ( $meta = get_post_meta( $post_id, 'wpex_post_video_embed', true ) ) {
        $video = $meta;
    }

    // Check for self-hosted first
    elseif ( $meta = get_post_meta( $post_id, 'wpex_post_self_hosted_media', true ) ) {
        $video = $meta;
    }

    // Check for wpex_post_video custom field
    elseif ( $meta = get_post_meta( $post_id, 'wpex_post_video', true ) ) {
        $video = $meta;
    }

    // Check for post oembed
    elseif ( $meta = get_post_meta( $post_id, 'wpex_post_oembed', true ) ) {
        $video = $meta;
    }

    // Check old redux custom field last
    elseif ( $meta = get_post_meta( $post_id, 'wpex_post_self_hosted_shortcode_redux', true ) ) {
        $video = $meta;
    }

    // Apply filters for child theming
    $video = apply_filters( 'wpex_get_post_video', $video );

    // Return data
    return $video;

}

/**
 * Echo post video HTML
 *
 * @since   Total 2.0.0
 * @return  string
 */
function wpex_post_video_html( $video = '' ) {
    echo wpex_get_post_video_html( $video );
}

/**
 * Returns post video HTML
 *
 * @since   Total 2.0.0
 * @return  string
 */
function wpex_get_post_video_html( $video = '' ) {

    // Get video
    $video = $video ? $video : wpex_get_post_video();

    // Return if video is empty
    if ( empty( $video ) ) {
        return;
    }

    // Check post format for standard post type
    if ( 'post' == get_post_type() && 'video' != get_post_format() ) {
        return;
    }

    // Check if it's an embed or iframe

    // Get oembed code and return
    if ( ! is_wp_error( $oembed = wp_oembed_get( $video ) ) && $oembed ) {
        return '<div class="responsive-video-wrap">'. $oembed .'</div>';
    }

    // Display using apply_filters if it's self-hosted
    else {

        $video = apply_filters( 'the_content', $video );

        // Add responsive video wrap for youtube/vimeo embeds
        if ( strpos( $video, 'youtube' ) || strpos( $video, 'vimeo' ) ) {
            return '<div class="responsive-video-wrap">'. $video .'</div>';
        }
        
        // Else return without responsive wrap
        else {
            return $video;
        }

    }

}


/**
 * Returns post audio
 *
 * @since   Total 2.0.0
 * @return  string
 */
function wpex_get_post_audio( $id = '' ) {

    // Define video variable
    $audio = '';

    // Get correct ID
    $id = $id ? $id : get_the_ID();

    // Check for self-hosted first
    if ( $self_hosted = get_post_meta( $id, 'wpex_post_self_hosted_media', true ) ) {
        $audio = $self_hosted;
    }

    // Check for wpex_post_audio custom field
    elseif ( $post_video = get_post_meta( $id, 'wpex_post_audio', true ) ) {
        $audio = $post_video;
    }

    // Check for post oembed
    elseif ( $post_oembed = get_post_meta( $id, 'wpex_post_oembed', true ) ) {
        $audio = $post_oembed;
    }

    // Check old redux custom field last
    elseif ( $self_hosted = get_post_meta( $id, 'wpex_post_self_hosted_shortcode_redux', true ) ) {
        $audio = $self_hosted;
    }

    // Apply filters for child theming
    $audio = apply_filters( 'wpex_get_post_audio', $audio );

    // Return data
    return $audio;

}

/**
 * Returns post audio
 *
 * @since   Total 2.0.0
 * @return  string
 */
function wpex_get_post_audio_html( $audio = '' ) {

    // Get video
    $audio = $audio ? $audio : wpex_get_post_audio();

    // Return if video is empty
    if ( empty( $audio ) ) {
        return;
    }

    // Get oembed code and return
    if ( ! is_wp_error( $oembed = wp_oembed_get( $audio ) ) && $oembed ) {
        return '<div class="responsive-audio-wrap">'. $oembed .'</div>';
    }

    // Display using apply_filters if it's self-hosted
    else {
        return apply_filters( 'the_content', $audio );
    }

}

/**
 * Returns the "category" taxonomy for a given post type
 *
 * @since   Total 2.0.0
 * @return  string
 */
function wpex_get_post_type_cat_tax( $post_type = '' ) {

    // Get the post type
    $post_type = $post_type ? $post_type : get_post_type();

    // Return taxonomy
    if ( 'post' == $post_type ) {
        $tax = 'category';
    } elseif ( 'portfolio' == $post_type ) {
        $tax = 'portfolio_category';
    } elseif( 'staff' == $post_type ) {
        $tax = 'staff_category';
    } elseif( 'testimonials' == $post_type ) {
        $tax = 'testimonials_category';
    } elseif ( 'product' == $post_type ) {
        $tax = 'product_cat';
    } elseif ( 'tribe_events' == $post_type ) {
        $tax = 'tribe_events_cat';
    } else {
        $tax = false;
    }

    // Apply filters
    $tax = apply_filters( 'wpex_get_post_type_cat_tax', $tax );

    // Return
    return $tax;

}

/**
 * Returns correct typography style class
 *
 * @since   Total 2.0.2
 * @return  string
 */
function wpex_typography_style_class( $style ) {
    $class = '';
    if ( $style
        && 'none' != $style
        && array_key_exists( $style, wpex_typography_styles() ) ) {
        $class = 'typography-'. $style;
    }
    return $class;
}


/**
 * Convert to array
 *
 * @since Total 2.0.0
 */
function wpex_string_to_array( $value = array() ) {

    // Return empty array if value is empty
    if ( empty( $value ) ) {
        return array();
    }

    // Check if array and not empty
    elseif ( ! empty( $value ) && is_array( $value ) ) {
        return $array;
    }

    // Create our own return
    else {

        // Define array
        $array = array();

        // Clean up value
        $items  = preg_split( '/\,[\s]*/', $value );

        // Create array
        foreach ( $items as $item ) {
            if ( strlen( $item ) > 0 ) {
                $array[] = $item;
            }
        }

        // Return array
        return $array;

    }

}
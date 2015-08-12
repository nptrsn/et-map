<?php
/**
 * Custom functions for use with Visual Composer Modules
 *
 * @package     Total
 * @subpackage  Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.4.0
 * @version     2.0.2
 */

/**
 * Fallback to prevent JS error
 *
 * @since Total 2.0.0
 */
if ( ! function_exists( 'vc_icon_element_fonts_enqueue' ) ) {
    function vc_icon_element_fonts_enqueue() {
       return;
    }
}

/**
 * Convert to array
 *
 * @since Total 2.0.2
 */
function vcex_grid_filter_args( $atts = '' ) {

    // Return if no attributes found
    if ( ! $atts ) {
        return;
    }

    // Define args
    $args = array();

    // Define post type and taxonomy
    $post_type  = ! empty( $atts['post_type'] ) ? $atts['post_type'] : '';
    $post_type  = ( 'post' == $post_type ) ? 'blog' : $post_type;
    $taxonomy   = ! empty( $atts['filter_taxonomy'] ) ? $atts['filter_taxonomy'] : $post_type.'_category';

    // Define include/exclude category vars
    $include = ! empty( $atts['include_categories'] ) ? $atts['include_categories'] : array();
    $exclude = ! empty( $atts['exclude_categories'] ) ? $atts['exclude_categories'] : array();

    // Sanitize data
    $include = vcex_string_to_array( $include );
    $exclude = vcex_string_to_array( $exclude );

    // Check if only 1 category is included
    // If so check if it's a parent item so we can display children as the filter links
    if ( '1' == count( $include ) && $children = get_term_children( $include[0], $taxonomy ) ) {
        $include = $children;
    }

    // Add to args
    if ( ! empty( $include ) ) {
        $args['include'] = $include;
    }
    if ( ! empty( $exclude ) ) {
        $args['exclude'] = $exclude;
    }

    // Apply filters
    if ( $post_type ) {
        $args = apply_filters( 'vcex_'. $post_type .'_grid_filter_args', $args );
    }

    // Return args
    return $args;

}

/**
 * Convert to array
 *
 * @since Total 2.0.2
 */
function vcex_string_to_array( $value = array() ) {
    
    // Return wpex function if it exists  
    if ( function_exists( 'wpex_string_to_array' ) ) {
        return wpex_string_to_array( $value );
    }

    // Create our own return
    else {

        // Return null for empty array
        if ( empty( $value ) && is_array( $value ) ) {
            return null;
        }

        // Return if already array
        if ( ! empty( $value ) && is_array( $value ) ) {
            return $value;
        }

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


/**
 * Generates various types of HTML based on a value
 *
 * @since Total 2.0.0
 */
function vcex_parse_old_design_js() {
    return WPEX_VCEX_DIR_URI . 'assets/parse-old-design.js';
}

/**
 * Generates various types of HTML based on a value
 *
 * @since Total 2.0.0
 */
function vcex_html( $type, $value, $trim = false ) {

    // Return nothing by default
    $return = '';

    // Return if value is empty
    if ( ! $value ) {
        return;
    }

    // Title attribute
    if ( 'id_attr' == $type ) {
        $value  = trim ( str_replace( '#', '', $value ) );
        $value  = str_replace( ' ', '', $value );
        if ( $value ) {
            $return = ' id="'. esc_attr( $value ) .'"';
        }
    }

    // Title attribute
    if ( 'title_attr' == $type ) {
        $return = ' title="'. esc_attr( $value ) .'"';
    }

    // Link Target
    elseif ( 'target_attr' == $type ) {
        if ( 'blank' == $value || strpos( $value, 'blank' ) ) {
            $return = ' target="_blank"';
        }
    }

    // Link rel
    elseif ( 'rel_attr' == $type ) {
        if ( 'nofollow' == $value ) {
            $return = ' rel="nofollow"';
        }
    }

    // Return HTMl
    if ( $trim ) {
        return trim( $return );
    } else {
        return $return;
    }

}

/**
 * Returns array of image sizes for use in the Customizer
 *
 * @since Total 2.0.0
 */
function vcex_image_sizes() {
    $sizes = array(
        __( 'Custom Size', 'wpex' ) => 'wpex_custom',
    );
    $get_sizes      = get_intermediate_image_sizes();
    array_unshift( $get_sizes, 'full' );
    $get_sizes      = array_combine( $get_sizes, $get_sizes );
    $sizes          = array_merge( $sizes, $get_sizes );
    return $sizes;
}

/**
 * Image Crop Locations
 *
 * @since Total 2.0.0
 */
function vcex_image_crop_locations() {
    $locations = wpex_image_crop_locations();
    return array_flip( $locations );
}

/**
 * Typography Styles
 *
 * @since Total 2.0.0
 */
function vcex_typography_styles() {
    $styles = wpex_typography_styles();
    return array_flip( $styles );
}


/**
 * Notice when no posts are found
 *
 * @since Total 2.0.0
 */
function vcex_no_posts_found_message( $atts ) {
    if ( ! empty( $atts['post_types'] ) && 'tribe_events' == $atts['post_types'] ) {
        return '<div class="vcex-no-posts-found">'. __( 'No ongoing events found.', 'wpex' ) .'</div>';
    } else {
        return '<div class="vcex-no-posts-found">'. __( 'No posts found for your query.', 'wpex' ) .'</div>';
    }
}

/**
 * Sanitize data
 *
 * @since Total 2.0.0
 */
function vcex_sanitize_data( $data = NULL, $type = NULL ) {
    if ( function_exists( 'wpex_sanitize_data' ) ) {
        return wpex_sanitize_data( $data, $type );
    } else {
        return $data;
    }
}

/**
 * Get Extra class
 *
 * @since Total 2.0.2
 */
function vcex_get_extra_class( $classes ) {
    if ( $classes ) {
        return str_replace( '.', '', $classes );
    }
}

/**
 * Echos unique ID html for VC modules
 *
 * @since Total 2.0.0
 */
function vcex_unique_id( $id ) {
    if ( ! $id ) {
        return;
    }
    echo vcex_html( 'id_attr', $id );
}

/**
 * Returns dummy image
 *
 * @since Total 2.0.0
 */
function vcex_dummy_image_url() {
    return get_template_directory_uri() .'/images/dummy-image.jpg';
}

/**
 * Outputs dummy image
 *
 * @since Total 2.0.0
 */
function vcex_dummy_image() {
    echo '<img src="'. get_template_directory_uri() .'/images/dummy-image.jpg" />';
}

/**
 * Used to enqueue styles for Visual Composer modules
 *
 * @since   Total 2.0.0
 * @return  array
 */
function vcex_enque_style( $type, $value = '' ) {

    // iLightbox
    if ( 'ilightbox' == $type ) {
        wp_enqueue_style( 'wpex-ilightbox-'. $value .'-skin', wpex_ilightbox_stylesheet( $value ), array( 'wpex-style' ) );
    }

    // Hover animation
    elseif ( 'hover-animations' == $type ) {
        wp_enqueue_style( 'wpex-hover-animations' );
    }

}

/**
 * Returns array of available hover animations
 *
 * @since   Total 2.0.0
 * @return  array
 */
function vcex_hover_animations() {
    $animations = wpex_hover_css_animations( 'array_flip' );
    return array_flip( $animations );
}

/**
 * Returns array of CSS animations
 *
 * @since Total 2.0.0
 */
function vcex_css_animations() {
    $animations = wpex_css_animations();
    return array_flip( $animations );
}

/**
 * Array of Icon box styles
 *
 * @since   Total 2.0.0
 * @return  array
 */
function vcex_icon_box_styles() {

    // Define array
    $array  = array(
        'one'   => __( 'Left Icon', 'wpex' ),
        'seven' => __( 'Right Icon', 'wpex' ),
        'two'   => __( 'Top Icon', 'wpex' ),
        'three' => __( 'Top Icon Style 2 - legacy', 'wpex' ),
        'four'  => __( 'Outlined & Top Icon - legacy', 'wpex' ),
        'five'  => __( 'Boxed & Top Icon - legacy', 'wpex' ),
        'six'   => __( 'Boxed & Top Icon Style 2 - legacy', 'wpex' ),
    );

    // Apply filters
    $array = apply_filters( 'vcex_icon_box_styles', $array );

    // Flip array around for use with VC
    $array = array_flip( $array ); 

    // Return array
    return $array;

}

/**
 * Array of grid column options
 *
 * @since   Total 2.0.0
 * @return  array
 */
function vcex_grid_columns() {
    $columns = wpex_grid_columns();
    return array_flip( $columns );
}

/**
 * Return array of column gaps
 *
 * @since   Total 2.0.0
 * @return  array
 */
function vcex_column_gaps() {
    $gaps = wpex_column_gaps();
    return array_flip( $gaps );
}

/**
 * Array of orderby options
 *
 * @since   Total 2.0.0
 * @return  array
 */
function vcex_orderby_array() {
    $orderby = array(
        __( 'Default', 'wpex')              => '',
        __( 'Date', 'wpex')                 => 'date',
        __( 'Title', 'wpex' )               => 'title',
        __( 'Name', 'wpex' )                => 'name',
        __( 'Modified', 'wpex')             => 'modified',
        __( 'Author', 'wpex' )              => 'author',
        __( 'Random', 'wpex')               => 'rand',
        __( 'Parent', 'wpex')               => 'parent',
        __( 'Type', 'wpex')                 => 'type',
        __( 'ID', 'wpex' )                  => 'ID',
        __( 'Comment Count', 'wpex' )       => 'comment_count',
        __( 'Menu Order', 'wpex' )          => 'menu_order',
        __( 'Meta Key Value', 'wpex' )      => 'meta_value',
        __( 'Meta Key Value Num', 'wpex' )  => 'meta_value_num',
    );
    return apply_filters( 'vcex_orderby', $orderby );
}

/**
 * Array of order options
 *
 * @since   Total 2.0.0
 * @return  array
 */
function vcex_order_array() {
    return array(
        __( 'Default', 'wpex' ) => '',
        __( 'DESC', 'wpex' )    => 'DESC',
        __( 'ASC', 'wpex' )     => 'ASC',
    );
}

/**
 * Array of ilightbox skins
 *
 * @since   Total 2.0.0
 * @return  array
 */
function vcex_ilightbox_skins() {
    $skins = array(
        ''  => __( 'Default', 'wpex' ),
    );
    $skins = array_merge( $skins, wpex_ilightbox_skins() );
    $skins = array_flip( $skins );
    return $skins;
}

/**
 * Array of font weights
 *
 * @since   Total 2.0.0
 * @return  array
 */
function vcex_font_weights() {
    $weights = wpex_font_weights();
    return array_flip( $weights );
}

/**
 * Array of text transforms
 *
 * @since   Total 2.0.0
 * @return  array
 */
function vcex_text_transforms() {
    $transforms = wpex_text_transforms();
    return array_flip( $transforms );
}

/**
 * Array of alignments
 *
 * @since   Total 2.0.0
 * @return  array
 */
function vcex_alignments() {
    $alignments = wpex_alignments();
    return array_flip( $alignments );
}

/**
 * Array of border styles
 *
 * @since   Total 2.0.0
 * @return  array
 */
function vcex_border_styles() {
    $borders = wpex_border_styles();
    return array_flip( $borders );
}

/**
 * Visibility
 *
 * @since   Total 2.0.0
 * @return  array
 */
function vcex_visibility() {
    $visibility = wpex_visibility();
    return array_flip( $visibility );
}

/**
 * Image filter styles VC extensions
 *
 * @since Total 1.4.0
 */
function vcex_image_filters() {
    $filters = array (
        __( 'None', 'wpex' )        => '',
        __( 'Grayscale', 'wpex' )   => 'grayscale',
    );
    return apply_filters( 'vcex_image_filters', $filters );
}

/**
 * Border Radius Options
 *
 * @since Total 1.4.0
 */
function vcex_border_radius() {
    $filters = array (
        __( 'None', 'wpex' )            => '',
        __( 'Semi-Rounded', 'wpex' )    => 'semi-rounded',
        __( 'Rounded', 'wpex' )         => 'rounded',
        __( 'Round', 'wpex' )           => 'round',
    );
    return apply_filters( 'vcex_image_filters', $filters );
}

/**
 * Border Radius Classname
 *
 * @since Total 1.4.0
 */
function vcex_get_border_radius_class( $val ) {
    return 'border-radius-'. $val;
}

/**
 * Total Button Styles
 *
 * @since   Total 2.0.0
 * @return  array
 */
function vcex_button_styles() {
    $styles = wpex_button_styles();
    return array_flip( $styles );
}

/**
 * Total Button Colors
 *
 * @since   Total 2.0.0
 * @return  array
 */
function vcex_button_colors() {
    $colors = wpex_button_colors();
    return array_flip( $colors );
}

/**
 * Image hover styles
 *
 * @since   Total 1.4.0
 * @return  array
 */
function vcex_image_hovers() {
    $hovers = wpex_image_hovers();
    return array_flip( $hovers );
}

/**
 * Image rendering
 *
 * @since   Total 1.4.0
 * @return  array
 */
function vcex_image_rendering() {
    $render = array (
        __( 'Auto','wpex' )         => '',
        __( 'Crisp Edges','wpex' )  => 'crisp-edges',
    );
    return apply_filters( 'vcex_image_rendering', $render );
}

/**
 * Overlay options for the VC
 *
 * @since   Total 1.4.0
 * @return  array
 */
function vcex_overlays_array( $group = '', $style = 'default' ) {
    if ( ! function_exists( 'wpex_overlay_styles_array' ) ) {
        return;
    }
    $overlays = wpex_overlay_styles_array( $style );
    if ( ! is_array( $overlays ) ) {
        return;
    }
    $overlays   = array_flip( $overlays );
    $group      = ! empty( $group ) ? $group : __( 'Image', 'wpex' ); 
    return array(
        'type'          => 'dropdown',
        'heading'       => __( 'Image Overlay Style', 'wpex' ),
        'param_name'    => 'overlay_style',
        'value'         => $overlays,
        'group'         => $group,
    );
}

/**
 * Returns an array of overlays
 *
 * @since   Total 1.4.0
 * @return  array
 */
function vcex_image_overlays() {
    $overlays = wpex_overlay_styles_array();
    return array_flip( $overlays );
}

/**
 * Returns the wpex_excerpt function if it exists otherwise it returns the wordpress excerpt function
 *
 * @since Total 1.4.0
 */
function vcex_get_excerpt( $args ) {
    if ( function_exists( 'wpex_excerpt' ) ) {
        return wpex_get_excerpt( $args );
    } else {
        return get_the_excerpt();
    }
}

/**
 * Echos the excerpt
 *
 * @since Total 1.4.0
 */
function vcex_excerpt( $args ) {
    if ( function_exists( 'wpex_excerpt' ) ) {
        wpex_excerpt( $args );
    } else {
        the_excerpt();
    }
}

/**
 * Helper function for building links using link param
 *
 * @since Total 2.0.0
 */
function vcex_build_link( $link, $fallback = '' ) {

    // If empty return fallback
    if ( empty( $link ) ) {
        return $fallback;
    }

    // Return if there isn't any link
    if ( '||' == $link ) {
        return;
    }

    // Return simple link escaped (fallback for old textfield input)
    if ( false === strpos( $link, 'url:' ) ) {
        return esc_url( $link );
    }

    // Build link
    $link = vc_build_link( $link );

    // Return array of link data
    return $link;

}

/**
 * Returns link data
 *
 * @since Total 2.0.0
 */
function vcex_get_link_data( $return, $link, $fallback = '' ) {

    // Get data
    $link = vcex_build_link( $link, $fallback );

    if ( 'url' == $return ) {
        if ( is_array( $link ) && ! empty( $link['url'] ) ) {
            return $link['url'];
        } else {
            return $link;
        }
    }

    if ( 'title' == $return ) {
        if ( is_array( $link ) && ! empty( $link['title'] ) ) {
            return $link['title'];
        } else {
            return $fallback;
        }
    }

    if ( 'target' == $return ) {
        if ( is_array( $link ) && ! empty( $link['target'] ) ) {
            return $link['target'];
        } else {
            return $fallback;
        }
    }

}

/**
 * Helper function enqueues icon fonts from Visual Composer
 *
 * @since Total 2.0.0
 */
function vcex_enqueue_icon_font( $family = '' ) {

    // Return if VC function doesn't exist
    if ( ! function_exists( 'vc_icon_element_fonts_enqueue' ) ) {
        return;
    }

    // Return if icon type is empty or it's fontawesome
    if ( empty( $family ) || 'fontawesome' == $family ) {
        return;
    }

    // Enqueue script
    vc_icon_element_fonts_enqueue( $family );

}

/**
 * Returns correct icon class based on icon type
 *
 * @since Total 2.0.0
 */
function vcex_get_icon_class( $atts, $icon ) {

    // Return if attributes or icon type
    if ( empty( $atts ) ) {
        return;
    }

    // Define icon type
    $icon_type = ! empty( $atts['icon_type'] ) ? $atts['icon_type'] : 'fontawesome';

    // Generate fontawesome icon class
    if ( 'fontawesome' == $icon_type && ! empty( $atts[$icon] ) ) {
        $icon   = $atts[$icon];
        $icon   = str_replace( 'fa-', '', $icon );
        $icon   = str_replace( 'fa ', '', $icon );
        $icon   = 'fa fa-'. $icon;
    } elseif ( ! empty( $atts[ $icon .'_'. $icon_type ] ) ) {
        $icon   = $atts[ $icon .'_'. $icon_type ];
    }

    // Return if icon is set to "none" or "icon"
    if ( in_array( $icon, array( 'icon', 'none' ) ) ) {
        return;
    }

    // Return icon classes
    return $icon;

}

/**
 * Adds inner row margin to compensate for the VC negative margins
 *
 * @since   Total 2.0.0
 * @return  bool
 */
function vcex_add_inner_row_margin( $atts ) {

    // Do not add for full-width
    if ( ! empty( $atts['full_width'] ) && 'stretch_row' == $atts['full_width'] ) {
        return;
    }

    // Check old modules for background or border
    if ( ! empty( $atts['center_row'] )
        || ! empty( $atts['bg_image'] )
        || ! empty( $atts['bg_color'] )
        || ! empty( $atts['border_width'] )
    ) {
        return true;
    }

    /* Check css parameter for background or border => NOT USED !!!
    if ( ! empty( $atts['css'] ) ) {

        if ( strpos( $atts['css'], 'background' ) ) {
            return true;
        } elseif ( strpos( $atts['css'], 'border' ) ) {
            return true;
        }

    } */

}

/**
 * Enables/Disables vc_row video bg functions
 *
 * @since Total 2.0.0
 */
function vcex_enable_row_video() {
    return apply_filters( 'vcex_enable_row_video', true );
}

/**
 * Outputs video row background
 *
 * @since Total 2.0.0
 */
if ( ! function_exists( 'vcex_row_video' ) ) {
    function vcex_row_video( $atts ) {

        // Extract attributes
        extract( $atts );

        // Return if video_bg is empty
        if ( empty( $video_bg ) ) {
            return;
        }

        // Get background image
        $bg_image = ! empty( $bg_image ) ? $bg_image : ''; ?>

        <?php
        // Self hosted
        if ( 'self_hosted' == $video_bg ) { ?>
            <video class="vcex-video-bg" poster="<?php echo wp_get_attachment_url( $bg_image ); ?>" preload="auto" autoplay="true" loop="loop" muted volume="0">
                <?php if ( $video_bg_webm ) { ?>
                    <source src="<?php echo $video_bg_webm; ?>" type="video/webm" />
                <?php } ?>
                <?php if ( $video_bg_ogv ) { ?>
                    <source src="<?php echo $video_bg_ogv; ?>" type="video/ogg ogv" />
                <?php } ?>
                <?php if ( $video_bg_mp4 ) { ?>
                    <source src="<?php echo $video_bg_mp4; ?>" type="video/mp4" />
                <?php } ?>
            </video><!-- .vcex-video-bg -->
        <?php }

        // Embeded
        elseif ( 'youtube' == $video_bg && ! empty( $video_bg_youtube ) ) {

            return; // Not ready yet

            // Sanize embed src
            $video_bg_youtube_parsed  = vcex_sanitize_data( $video_bg_youtube, 'embed_url' );
            $video_bg_youtube         = $video_bg_youtube_parsed ? $video_bg_youtube_parsed : $video_bg_youtube; ?>

            <embed class="vcex-video-bg" src="<?php echo $video_bg_youtube; ?>?loop=1&amp;autoplay=1&amp;controls=0&amp;showinfo=0&amp;autohide=1&amp;sound=0" width="100%" height="100%"></embed>

        <?php }

        // Wrong style return
        else {
            return;
        } ?>

        <?php if ( $video_bg_overlay && 'none' != $video_bg_overlay ) { ?>
            <span class="vcex-video-bg-overlay <?php echo $video_bg_overlay; ?>-overlay"></span>
        <?php } ?>

    <?php
    }
}

/**
 * Enables/Disables vc_row parallax functions
 *
 * @since Total 2.0.0
 */
function vcex_enable_row_parallax() {
    return apply_filters( 'vcex_enable_row_parallax', true );
}

/**
 * Outputs row parallax background
 *
 * @since Total 2.0.0
 */
if ( ! function_exists( 'vcex_parallax_bg' ) ) {

    function vcex_parallax_bg( $atts ) {

        // Extract attributes
        extract( $atts );

        // Make sure parallax is enabled and a background image is defined
        if ( ! $parallax || ! $bg_image ) {
            return;
        }

        // Load inline js
        vcex_inline_js( array( 'parallax' ) );

        // Sanitize data
        $parallax_style     = ( ! empty( $parallax_style ) ) ? $parallax_style : 'fixed-no-repeat';
        $parallax_speed     = ( ! empty( $parallax_speed ) ) ? abs( $parallax_speed ) : '0.2';
        $parallax_direction = ( ! empty( $parallax_direction ) ) ? $parallax_direction : 'up';

        // Classes
        $classes = array( 'parallax-bg', 'bg-cover' );
        $classes[] = $parallax_style;
        if ( ! $parallax_mobile ) {
             $classes[] = 'not-mobile';
        }
        $classes = implode( ' ', $classes );

        // Add style
        $style = 'style="background-image: url('. $bg_image .');"';

        // Attributes
        $attributes = 'data-direction="'. $parallax_direction .'" data-velocity="-'. $parallax_speed .'"'; ?>

        <div class="<?php echo $classes; ?>" <?php echo $style; ?> <?php echo $attributes; ?>></div>

    <?php
    }

}

/**
 * Array of social links profiles to loop through
 *
 * @since Total 2.0.0
 */
function vcex_social_links_profiles() {

    // Create array of social profiles
    $profiles = array(
        'twitter'       => array(
            'label'         => 'Twitter',
            'icon_class'    => 'fa fa-twitter',
        ),
        'facebook'      => array(
            'label'         => 'Facebook',
            'icon_class'    => 'fa fa-facebook',
        ),
        'googleplus'    => array(
            'label'         => 'Google Plus',
            'icon_class'    => 'fa fa-google-plus',
        ),
        'pinterest'     => array(
            'label'         => 'Pinterest',
            'icon_class'    => 'fa fa-pinterest',
        ),
        'dribbble'      => array(
            'label'         => 'Dribbble',
            'icon_class'    => 'fa fa-dribbble',
        ),
        'vk'            => array(
            'label'         => 'Vk',
            'icon_class'    => 'fa fa-vk',
        ),
        'instagram'     => array(
            'label'         => 'Instragram',
            'icon_class'    => 'fa fa-instagram',
        ),
        'linkedin'      => array(
            'label'         => 'LinkedIn',
            'icon_class'    => 'fa fa-linkedin',
        ),
        'tumblr'        => array(
            'label'         => 'Tumblr',
            'icon_class'    => 'fa fa-tumblr',
        ),
        'github'        => array(
            'label'         => 'Github',
            'icon_class'    => 'fa fa-github-alt',
        ),
        'flickr'        => array(
            'label'         => 'Flickr',
            'icon_class'    => 'fa fa-flickr',
        ),
        'skype'         => array(
            'label'         => 'Skype',
            'icon_class'    => 'fa fa-skype',
        ),
        'youtube'       => array(
            'label'         => 'Youtube',
            'icon_class'    => 'fa fa-youtube',
        ),
        'vimeo'         => array(
            'label'         => 'Vimeo',
            'icon_class'    => 'fa fa-vimeo-square',
        ),
        'vine'          => array(
            'label'         => 'Vine',
            'icon_class'    => 'fa fa-vine',
        ),
        'xing'          => array(
            'label'         => 'Xing',
            'icon_class'    => 'fa fa-xing',
        ),
        'yelp'          => array(
            'label'         => 'Yelp',
            'icon_class'    => 'fa fa-yelp',
        ),
        'email'         => array(
            'label'         => __( 'Email', 'wpex' ),
            'icon_class'    => 'fa fa-envelope',
        ),
        'rss'           => array(
            'label'         => __( 'RSS', 'wpex' ),
            'icon_class'    => 'fa fa-rss',
        ),
    );

    // Apply filters
    $profiles = apply_filters( 'vcex_social_links_profiles', $profiles );

    // Return profiles array
    return $profiles;

}

/**
 * Array of pixel icons
 *
 * @since Total 1.4.0
 */
if ( ! function_exists( 'vcex_pixel_icons' ) ) {
    function vcex_pixel_icons() {
        return array(
            array( 'vc_pixel_icon vc_pixel_icon-alert' => __( 'Alert', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-info' => __( 'Info', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-tick' => __( 'Tick', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-explanation' => __( 'Explanation', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-address_book' => __( 'Address book', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-alarm_clock' => __( 'Alarm clock', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-anchor' => __( 'Anchor', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-application_image' => __( 'Application Image', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-arrow' => __( 'Arrow', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-asterisk' => __( 'Asterisk', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-hammer' => __( 'Hammer', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-balloon' => __( 'Balloon', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-balloon_buzz' => __( 'Balloon Buzz', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-balloon_facebook' => __( 'Balloon Facebook', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-balloon_twitter' => __( 'Balloon Twitter', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-battery' => __( 'Battery', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-binocular' => __( 'Binocular', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-document_excel' => __( 'Document Excel', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-document_image' => __( 'Document Image', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-document_music' => __( 'Document Music', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-document_office' => __( 'Document Office', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-document_pdf' => __( 'Document PDF', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-document_powerpoint' => __( 'Document Powerpoint', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-document_word' => __( 'Document Word', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-bookmark' => __( 'Bookmark', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-camcorder' => __( 'Camcorder', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-camera' => __( 'Camera', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-chart' => __( 'Chart', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-chart_pie' => __( 'Chart pie', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-clock' => __( 'Clock', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-fire' => __( 'Fire', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-heart' => __( 'Heart', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-mail' => __( 'Mail', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-play' => __( 'Play', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-shield' => __( 'Shield', 'wpex' ) ),
            array( 'vc_pixel_icon vc_pixel_icon-video' => __( 'Video', 'wpex' ) ),
        );
    }
}

/**
 * Deprecated functions
 *
 * @since Total 2.0.0
 */
function vcex_advanced_parallax() {
    _deprecated_function( 'vcex_advanced_parallax', '2.0.2', 'vcex_parallax_bg' );
}
function vcex_front_end_carousel_js() {
    _deprecated_function( 'vcex_front_end_carousel_js', '2.0.0', 'vcex_inline_js' );
}
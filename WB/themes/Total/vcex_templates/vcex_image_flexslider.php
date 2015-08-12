<?php
/**
 * Output for the image flexslider Visual Composer module
 *
 * @package     Total
 * @subpackage  vcex_templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 2.0.0
 * @version     2.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Not needed in admin ever.
if ( is_admin() ) return;

// Define shortcode params
extract( shortcode_atts( array(
    'unique_id'                 => '',
    'classes'                   => '',
    'image_ids'                 => '',
    'visibility'                => '',
    'loop'                      => '',
    'animation'                 => 'slide',
    'slideshow'                 => 'true',
    'slideshow_speed'           => '5000',
    'height_animation'          => '500',
    'control_thumbs_height'     => '70',
    'control_thumbs_width'      => '70',
    'randomize'                 => '',
    'direction'                 => '',
    'animation_speed'           => '',
    'control_nav'               => '',
    'direction_nav'             => '',
    'direction_nav_hover'       => '',
    'pause_on_hover'            => 'true',
    'smooth_height'             => '',
    'thumbnail_link'            => '',
    'lightbox_skin'             => '',
    'lightbox_path'             => '',
    'lightbox_title'            => '',
    'lightbox_caption'          => '',
    'custom_links'              => '',
    'custom_links_target'       => '',
    'img_size'                  => '',
    'img_crop'                  => '',
    'img_width'                 => '',
    'img_height'                => '',
    'caption'                   => 'true',
    'control_thumbs'            => '',
    'control_thumbs_pointer'    => '',
    'css'                       => '',
    'caption_type'              => '',
    'caption_position'          => 'bottomCenter',
    'caption_show_transition'   => 'up',
    'caption_hide_transition'   => 'down',
    'caption_width'             => '100%',
    'caption_delay'             => '500',
    'preloader_img'             => 'true',
    'caption_horizontal'        => '',
    'caption_vertical'          => '',
    'caption_style'             => 'black',
    'caption_rounded'           => '',
    'caption_font_size'         => '',
    'caption_padding'           => '',
    'caption_visibility'        => '',
    'css'                       => '',
), $atts ) );

// Display warning
if ( empty( $image_ids ) ) {
    echo '<div class="vc-module-notice">'. __( 'Please select some images.', 'wpex' ) .'</div>';
    return;
}

// Get Attachments
$attachments = explode( ',', $image_ids );

// Turn links into array
if ( $custom_links && 'custom_link' == $thumbnail_link ) {

    // Turn custom links into array
    $custom_links = explode( ',', $custom_links );

    // Display warning if there are more custom links then images
    if ( count( $custom_links ) > count( $attachments ) ) {
        _e( 'You have too many custom links and to few images', 'wpex' );
        return;
    }

    // Add empty values to custom_links array for images without links
    if ( count( $attachments ) > count( $custom_links ) ) {
      foreach( $attachments as $key => $value ) {
          if ( ! isset( $custom_links[$key] ) ) {
            $custom_links[] = NULL;
        }
      }
    }

    // Set links as the values for the images
    $attachments = array_combine( $attachments, $custom_links );

} else {
    $attachments = array_combine( $attachments, $attachments );
}

//Output images
if ( $attachments ) :

    // Load inline js
    $inline_js = array( 'slider_pro' );
    if ( 'lightbox' == $thumbnail_link ) {
        $inline_js[] = 'ilightbox';
    }
    vcex_inline_js( $inline_js );

    // Sanitize data and declare main vars
    $caption_data   = array();
    $wrap_data      = array();
    $slideshow      = vc_is_inline() ? 'false' : $slideshow;
    $caption        = ( 'false' == $caption ) ? false : true;

    // Slider attributes
    if ( in_array( $animation, array( 'fade', 'fade_slides' ) ) ) {
        $wrap_data[] = 'data-fade="true"';
    }
    if ( 'true' == $randomize ) {
        $wrap_data[] = 'data-shuffle="true"';
    }
    if ( 'true' == $loop ) {
        $wrap_data[] = ' data-loop="true"';
    }
    if ( 'false' == $slideshow ) {
        $wrap_data[] = 'data-auto-play="false"';
    }
    if ( $slideshow && $slideshow_speed ) {
        $wrap_data[] = 'data-auto-play-delay="'. $slideshow_speed .'"';
    }
    if ( 'false' == $direction_nav ) {
        $wrap_data[] = 'data-arrows="false"';
    }
    if ( 'false' == $control_nav ) {
        $wrap_data[] = 'data-buttons="false"';
    }
    if ( 'false' == $direction_nav_hover ) {
        $wrap_data[] = 'data-fade-arrows="false"';
    }
    if ( 'true' == $control_thumbs ) {
        $wrap_data[] = 'data-thumbnails="true"';
    }
    if ( 'true' == $control_thumbs && 'true' == $control_thumbs_pointer ) {
        $wrap_data[] = 'data-thumbnail-pointer="true"';
    }
    if ( $animation_speed ) {
        $wrap_data[] = 'data-animation-speed="'. intval( $animation_speed ) .'"';
    }
    if ( $height_animation ) {
        $wrap_data[] = 'data-height-animation-duration="'. intval( $height_animation ) .'"';
    }
    if ( $control_thumbs_height ) {
        $wrap_data[] = 'data-thumbnail-height="'. intval( $control_thumbs_height ) .'"';
    }
    if ( $control_thumbs_width ) {
        $wrap_data[] = 'data-thumbnail-width="'. intval( $control_thumbs_width ) .'"';
    }

    // Caption attributes and classes
    if ( $caption ) {

        // Caption attributes
        if ( $caption_position ) {
            $caption_data[] = 'data-position="'. $caption_position .'"';
        }
        if ( $caption_show_transition ) {
            $caption_data[] = 'data-show-transition="'. $caption_show_transition .'"';
        }
        if ( $caption_hide_transition ) {
            $caption_data[] = 'data-hide-transition="'. $caption_hide_transition .'"';
        }
        if ( $caption_width ) {
            $caption_data[] = 'data-width="'. vcex_sanitize_data( $caption_width, 'px-pct' ) .'"';
        }
        if ( $caption_horizontal ) {
            $caption_data[] = 'data-horizontal="'. intval( $caption_horizontal ) .'"';
        }
        if ( $caption_vertical ) {
            $caption_data[] = 'data-vertical="'. intval( $caption_vertical ) .'"';
        }
        if ( $caption_delay ) {
            $caption_data[] = 'data-show-delay="'. intval( $caption_delay ) .'"';
        }
        if ( empty( $caption_show_transition ) && empty( $caption_hide_transition ) ) {
            $caption_data[] = 'data-sp-static="false"';
        }
        $caption_data = implode( ' ', $caption_data );

        // Caption classes
        $caption_classes = array( 'wpex-slider-caption', 'sp-layer', 'sp-padding', 'clr' );
        if ( $caption_visibility ) {
            $caption_classes[] = $caption_visibility;
        }
        if ( $caption_style ) {
            $caption_classes[] = 'sp-'. $caption_style;
        }
        if ( 'true' == $caption_rounded ) {
            $caption_classes[] = 'sp-rounded';
        }
        $caption_classes = implode( ' ', $caption_classes );

        // Caption style
        $caption_inline_style = vcex_inline_style( array(
            'font_size' => $caption_font_size,
            'padding'   => $caption_padding,
        ) );

    }

    // Main Classes
    $wrap_classes = array( 'wpex-slider', 'slider-pro', 'vcex-image-slider', 'clr' );
    if ( $classes ) {
        $wrap_classes[] = $this->getExtraClass( $classes );
    }
    if ( $visibility ) {
        $wrap_classes[] = $visibility;
    }
    if ( 'lightbox' == $thumbnail_link ) {
        $wrap_classes[] = 'lightbox-group';
        if ( $lightbox_skin ) {
            $wrap_data[] = 'data-skin="'. $lightbox_skin .'"';
            vcex_enque_style( 'ilightbox', $lightbox_skin );
        }
        if ( $lightbox_path ) {
            $wrap_data[] = 'data-path="'. $lightbox_path .'"';
        }
    }

    // Convert arrays into strings
    $wrap_classes   = implode( ' ', $wrap_classes );
    $wrap_data      = ' '. implode( ' ', $wrap_data ); ?>

    <?php
    // Open css wrapper
    if ( $css ) : ?>
        <div class="vcex-image-slider-css-wrap <?php echo apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css ), 'vcex_image_flexslider', $atts ); ?>">
    <?php endif; ?>

    <?php
    // Display the first image of the slider as a "preloader"
    if ( 'false' != $preloader_img ) : ?>

        <div class="wpex-slider-preloaderimg">

            <?php wpex_post_thumbnail( array(
                'attachment'    => reset( $attachments ),
                'size'          => $img_size,
                'crop'          => $img_crop,
                'width'         => $img_width,
                'height'        => $img_height,
            ) ); ?>

        </div><!-- .wpex-slider-preloaderimg -->

    <?php endif; ?>

    <div class="<?php echo $wrap_classes; ?>"<?php vcex_unique_id( $unique_id ); ?><?php echo $wrap_data; ?>>

        <div class="wpex-slider-slides sp-slides">

            <?php
            // Loop through attachments
            foreach ( $attachments as $attachment => $custom_link ) : ?>

                <?php
                // Define main vars
                $attachment_link    = get_post_meta( $attachment, '_wp_attachment_url', true );
                $attachment_data    = wpex_get_attachment_data( $attachment );
                $caption_type       = $caption_type ? $caption_type : 'caption';
                $caption_output     = $attachment_data[$caption_type];
                $attachment_video   = wp_oembed_get( $attachment_data['video'] );
                $attachment_video   = wpex_add_sp_video_to_oembed( $attachment_video );

                // Generate img HTML
                $attachment_img = wpex_get_post_thumbnail( array(
                    'attachment'    => $attachment,
                    'size'          => $img_size,
                    'crop'          => $img_crop,
                    'width'         => $img_width,
                    'height'        => $img_height,
                    'alt'           => $attachment_data['alt'],
                ) ); ?>

                <div class="wpex-slider-slide sp-slide">

                    <div class="wpex-slider-media">

                        <?php
                        // Check if the current attachment has a video
                        if ( $attachment_video ) : ?>

                            <div class="wpex-slider-video responsive-video-wrap">
                                <?php echo $attachment_video; ?>
                            </div><!-- .wpex-slider-video -->

                        <?php elseif( $attachment_img ) : ?>

                            <?php if ( 'lightbox' == $thumbnail_link ) {

                                // Data attributes
                                $lightbox_data_attributes = ' data-type="image"';
                                if ( $lightbox_title ) {
                                    if ( 'title' == $lightbox_title && $attachment_data['title'] ) {
                                        $lightbox_data_attributes = ' data-title="'. $attachment_data['title'] .'"';
                                    } elseif ( esc_attr( $attachment_data['alt'] ) ) {
                                        $lightbox_data_attributes = ' data-title="'. esc_attr( $attachment_data['alt'] ) .'"';
                                    }
                                }

                                // Caption data
                                if ( $attachment_data['caption'] && 'false' != $lightbox_caption ) {
                                    $lightbox_data_attributes = ' data-caption="'. str_replace( '"',"'", $attachment_data['caption'] ) .'"';
                                } ?>

                                <a href="<?php wpex_lightbox_image( $attachment ); ?>" title="<?php echo esc_url( $attachment_data['title'] ); ?>" class="vcex-flexslider-entry-img lightbox-group-item"<?php echo $lightbox_data_attributes; ?>>
                                    <?php echo $attachment_img; ?>
                                </a>
                            
                            <?php } elseif ( 'custom_link' == $thumbnail_link ) { ?>

                                <?php if ( '#' == $custom_link ) { ?>

                                    <?php echo $attachment_img; ?>

                                <?php } else { ?>

                                    <a href="<?php echo esc_url( $custom_link ); ?>"<?php echo vcex_html( 'title_attr', $attachment_data['title'] ); ?><?php echo vcex_html( 'target_attr', $custom_links_target ); ?>>
                                        <?php echo $attachment_img; ?>
                                    </a>

                                <?php } ?>

                            <?php } else { ?>

                                <?php
                                // Display the main slider image
                                echo $attachment_img; ?>

                            <?php } ?>

                            <?php
                            // Display caption if enabled and there is one
                            if ( $caption && $caption_output ) : ?>

                                <div class="<?php echo $caption_classes; ?>"<?php echo $caption_data; ?><?php echo $caption_inline_style; ?>>
                                    <?php if ( in_array( $caption_type, array( 'description', 'caption' ) ) ) { ?>
                                        <?php echo wpautop( $caption_output ); ?>
                                    <?php } else { ?>
                                        <?php echo $caption_output; ?>
                                    <?php } ?>
                                </div><!-- .wpex-slider-caption -->

                            <?php endif; ?>

                        <?php endif; ?>

                    </div><!-- .wpex-slider-media -->

                </div><!-- .wpex-slider-slide -->

            <?php endforeach; ?>

        </div><!-- .wpex-slider-slides -->

        <?php if ( 'true' == $control_thumbs ) : ?>

            <div class="wpex-slider-thumbnails sp-thumbnails">

                <?php foreach ( $attachments as $attachment => $custom_link ) : ?>

                    <?php
                    // Output thumbnail image
                    wpex_post_thumbnail( array(
                        'attachment'    => $attachment,
                        'size'          => $img_size,
                        'crop'          => $img_crop,
                        'width'         => $img_width,
                        'height'        => $img_height,
                        'class'         => 'wpex-slider-thumbnail sp-thumbnail',
                    ) ); ?>

                <?php endforeach; ?>

            </div><!-- .wpex-slider-thumbnails -->

        <?php endif; ?>

    </div><!-- .wpex-slider -->

    <?php
    // Close css wrapper
    if ( $css ) echo '</div>'; ?>

<?php endif; ?>
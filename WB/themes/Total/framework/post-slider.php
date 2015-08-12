<?php
/**
 * Display page slider based on meta option
 *
 * @package     Total
 * @subpackage  Framework/Sliders
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.0.0
 */

/**
 * Checks if the current page has a post slider or not
 *
 * @since   Total 2.0.0
 * @return  bool
 */
function wpex_has_post_slider( $post_id = '' ) {

    // Get post ID if not defined
    $post_id = $post_id ? $post_id : wpex_get_the_id();

    // Return false by default
    $return = false;

    // Check for meta
    if ( wpex_post_slider_shortcode( $post_id ) ) {
        $return = true;
    }

    // Apply filters for child theming
    $return = apply_filters( 'wpex_has_post_slider', $return );

    // Return value
    return $return;

}

/**
 * Gets slider position based on wpex_post_slider_shortcode_position custom field
 *
 * @since Total 1.5.1
 */
function wpex_post_slider_position( $post_id = '' ) {

    // Default position is below the title
    $position = 'below_title';

    // Check meta field for position
    if ( $meta = get_post_meta( $post_id, 'wpex_post_slider_shortcode_position', true ) ) {
        $position = $meta;
    }

    // Apply filters for child theming
    $position = apply_filters( 'wpex_post_slider_position', $position );

    // Return position
    return $position;

}

/**
 * Returns correct post slider shortcode
 *
 * @since Total 1.6.0
 */
function wpex_post_slider_shortcode( $post_id = '' ) {

    // Get post id if not defined
    $post_id = $post_id ? $post_id : wpex_get_the_id();

    // Check for slider defined in custom fields
    if ( $slider = get_post_meta( $post_id, 'wpex_post_slider_shortcode', true ) ) {
        $slider = $slider;
    } elseif( get_post_meta( $post_id, 'wpex_page_slider_shortcode', true ) ) {
        $slider = get_post_meta( $post_id, 'wpex_page_slider_shortcode', true );
    }

    // Apply filters
    $slider = apply_filters( 'wpex_post_slider_shortcode', $slider );

    // Return slider
    return $slider;

}

/**
 * Outputs page/post slider based on the wpex_post_slider_shortcode custom field
 *
 * @since Total 1.0.0
 */
function wpex_post_slider( $post_id = '', $postion = '' ) {

    // Get global object
    global $wpex_theme;

    // Return if there isn't a slider defined
    if ( ! $wpex_theme->has_post_slider ) {
        return;
    }

    // Get current filter
    $filter = current_filter();

    // Define get variable
    $get = false;

    // Get slider position
    $position = $wpex_theme->post_slider_position;

    // Get current filter against slider position
    if ( 'above_topbar' == $position && 'wpex_hook_topbar_before' == $filter ) {
        $get = true;
    } elseif ( 'above_header' == $position && 'wpex_hook_header_before' == $filter ) {
        $get = true;
    } elseif ( 'above_menu' == $position && 'wpex_hook_header_bottom' == $filter ) {
        $get = true;
    } elseif ( 'above_title' == $position && 'wpex_hook_page_header_before' == $filter ) {
        $get = true;
    } elseif ( 'below_title' == $position && 'wpex_hook_main_top' == $filter ) {
        $get = true;
    }

    // Return if $get is still false after checking filters
    if ( ! $get ) {
        return;
    }

    // Get post id
    $post_id = $post_id ? $post_id : $wpex_theme->post_id;
    
    // Get the Slider shortcode
    $slider = wpex_post_slider_shortcode( $post_id );

    // Disable on Mobile?
    $disable_on_mobile = get_post_meta( $post_id, 'wpex_disable_post_slider_mobile', true );

    // Get slider alternative
    $slider_alt = get_post_meta( $post_id, 'wpex_post_slider_mobile_alt', true );

    // Check if alider alternative for mobile custom field has a value
    if ( $slider_alt ) {

        // Cleanup validation for old Redux system
        if ( is_array( $slider_alt ) && ! empty( $slider_alt['url'] ) ) {
            $slider_alt = $slider_alt['url'];
        }

        // Mobile slider alternative link
        $slider_alt_url = get_post_meta( $post_id, 'wpex_post_slider_mobile_alt_url', true );

        // Mobile slider alternative link target
        if ( $slider_alt_target = get_post_meta( $post_id, 'wpex_post_slider_mobile_alt_url_target', true ) ) {
            $slider_alt_target = 'target="_'. $slider_alt_target .'"';
        }
    }

    // Otherwise set all vars to empty
    else {
        $slider_alt = $slider_alt_url = $slider_alt_target = NULL;;
    } ?>

        <div class="page-slider clr">

            <?php
            // Mobile slider
            if ( $slider_alt ) : ?>

                <div class="page-slider-mobile hidden-desktop clr">
                
                    <?php if ( $slider_alt_url ) : ?>

                        <a href="<?php echo esc_url( $slider_alt_url ); ?>" title=""<?php echo $slider_alt_target; ?>>
                            <img src="<?php echo $slider_alt; ?>" class="page-slider-mobile-alt" alt="<?php echo the_title(); ?>" />
                        </a>

                    <?php else : ?>

                        <img src="<?php echo $slider_alt; ?>" class="page-slider-mobile-alt" alt="<?php echo the_title(); ?>" />

                    <?php endif; ?>

                </div><!-- .page-slider-mobile -->

            <?php endif; ?>

            <?php
            // Disable slider on mobile
            if ( 'on' == $disable_on_mobile ) { ?>
                <div class="visible-desktop clr">
            <?php } ?>

                <?php echo do_shortcode( $slider ); ?>

            <?php if ( 'on' == $disable_on_mobile ) echo '</div>'; ?>

        </div><!-- .page-slider -->

        <?php if ( $margin = get_post_meta( $post_id, 'wpex_post_slider_bottom_margin', true ) ) : ?>

            <div style="height:<?php echo intval( $margin ); ?>px;"></div>

        <?php endif; ?>
        
<?php
}
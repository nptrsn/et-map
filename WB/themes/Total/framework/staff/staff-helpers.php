<?php
/**
 * Useful global functions for the staff
 *
 * @package     Total
 * @subpackage  Framework/Staff
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.0.0
 * @version     2.0.0
 */

/**
 * Returns correct thumbnail HTML for the staff entries
 *
 * @since Total 2.0.0
 */
function wpex_get_staff_entry_thumbnail() {

    // Define thumbnail args
    $args = array(
        'size'  => 'staff_entry',
        'class' => 'staff-entry-img',
        'alt'   => wpex_get_esc_title(),
    );

    // Apply filters
    $args = apply_filters( 'wpex_get_staff_entry_thumbnail_args', $args );

    // Return thumbanil
    return wpex_get_post_thumbnail( $args );

}

/**
 * Returns correct thumbnail HTML for the staff posts
 *
 * @since Total 2.0.0
 */
function wpex_get_staff_post_thumbnail() {

    // Define thumbnail args
    $args = array(
        'size'  => 'staff_post',
        'class' => 'staff-single-media-img',
        'alt'   => wpex_get_esc_title(),
    );

    // Apply filters
    $args = apply_filters( 'wpex_get_staff_post_thumbnail_args', $args );

    // Return thumbanil
    return wpex_get_post_thumbnail( $args );

}

/**
 * Returns correct classes for the staff wrap
 *
 * @since   Total 1.5.3
 * @return  var $classes
 */
function wpex_get_staff_wrap_classes() {

    // Define main classes
    $classes = array( 'wpex-row', 'clr' );

    // Get grid style
    $grid_style = get_theme_mod( 'staff_archive_grid_style' );
    $grid_style =  $grid_style ? $grid_style : 'fit-rows';

    // Add grid style
    $classes[] = 'staff-'. $grid_style;

    // Apply filters
    apply_filters( 'wpex_staff_wrap_classes', $classes );

    // Turninto space seperated string
    $classes = implode( " ", $classes );

    // Return
    return $classes;

}

/**
 * Returns staff archive columns
 *
 * @since Total 2.0.0
 */
function wpex_staff_archive_columns() {
    return get_theme_mod( 'staff_entry_columns', '3' );
}

/**
 * Returns correct classes for the staff grid
 *
 * @since Total 1.5.2
 */
if ( ! function_exists( 'wpex_staff_column_class' ) ) {
    function wpex_staff_column_class( $query ) {
        if ( 'related' == $query ) {
            return wpex_grid_class( get_theme_mod( 'staff_related_columns', '3' ) );
        } else {
            return wpex_grid_class( get_theme_mod( 'staff_entry_columns', '3' ) );
        }
    }
}

/**
 * Checks if match heights are enabled for the staff
 *
 * @since Total 1.5.3
 * @return bool
 */
if ( ! function_exists( 'wpex_staff_match_height' ) ) {
    function wpex_staff_match_height() {
        $grid_style = get_theme_mod( 'staff_archive_grid_style', 'fit-rows' ) ? get_theme_mod( 'staff_archive_grid_style', 'fit-rows' ) : 'fit-rows';
        $columns    = get_theme_mod( 'staff_entry_columns', '4' ) ? get_theme_mod( 'staff_entry_columns', '4' ) : '4';
        if ( 'fit-rows' == $grid_style && get_theme_mod( 'staff_archive_grid_equal_heights' ) && $columns > '1' ) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Staff Overlay
 *
 * @since Total 1.0
 */
if ( ! function_exists( 'wpex_get_staff_overlay' ) ) {
    function wpex_get_staff_overlay( $id = NULL ) {
        $post_id  = $id ? $id : get_the_ID();
        $position = get_post_meta( get_the_ID(), 'wpex_staff_position', true );
        if ( ! $position ) {
            return;
        } ?>
        <div class="staff-entry-position">
            <span><?php echo $position; ?></span>
        </div><!-- .staff-entry-position -->
        <?php
    }
}

/**
 * Outputs the staff social options
 *
 * @since Total 1.0
 */
if ( ! function_exists( 'wpex_get_staff_social' ) ) {
    function wpex_get_staff_social( $atts = NULL ) {

        // Extract staff social args
        extract( shortcode_atts( array(
            'link_target'   => 'blank',
        ),
        $atts ) );

        ob_start();

        // Get social profiles array
        $profiles = wpex_staff_social_array(); ?>

        <div class="staff-social clr">
            <?php
            // Loop through social options
            foreach ( $profiles as $profile ) {

                // Get meta
                $meta = $profile['meta'];

                // Get URl
                $url = get_post_meta( get_the_ID(), $meta, true );

                // Escape URL for all items except skype
                if ( ! in_array( $meta, array( 'wpex_staff_skype', 'wpex_staff_phone_number' ) ) ) {
                    $url = esc_url( $url );
                }

                // Display link
                if ( $url ) {

                    // Add "tel" for phones
                    if ( 'wpex_staff_phone_number' === $meta ) {
                        $url    = str_replace( 'tel:', '', $url );
                        $url    = 'tel:'. $url;
                    } ?>

                    <a href="<?php echo $url; ?>" title="<?php echo $profile['label']; ?>" class="staff-<?php echo $profile['key']; ?> tooltip-up" target="_<?php echo $link_target; ?>">
                        <span class="<?php echo $profile['icon_class']; ?>"></span>
                    </a>

                <?php }
            } ?>
        </div><!-- .staff-social -->

        <?php return ob_get_clean();
    }
}
add_shortcode( 'staff_social', 'wpex_get_staff_social' );
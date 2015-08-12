<?php
/**
 * Used for the main Add Ons dashboard menu and page
 *
 * @package     Total
 * @subpackage  Framework/Addons
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.6.0
 * @version     2.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Only needed in the admin
if ( ! is_admin() ) {
    return;
}

// Start Class
if ( ! class_exists( 'WPEX_Tweaks_Admin' ) ) {
    class WPEX_Tweaks_Admin {

        /**
         * Start things up
         */
        public function __construct() {
            add_action( 'admin_menu', array( $this, 'add_menu_page' ) );
            add_action( 'admin_menu', array( $this, 'add_menu_subpage' ) );
            add_action( 'admin_init', array( $this,'register_settings' ) );
        }

        /**
         * Registers a new menu page
         *
         * @link    http://codex.wordpress.org/Function_Reference/add_menu_page
         * @since   Total 1.6.0
         */
        function add_menu_page() {
            add_menu_page(
                __( 'Theme Panel', 'wpex' ),    // page title
                'Theme Panel',                  // menu title - can't be translated because it' used for the $hook prefix
                'manage_options',               // capability
                'wpex-addons',                  // menu_slug
                '',                             // function
                'dashicons-admin-generic',      // admin icon
                null                            // position
            );
        }

        /**
         * Registers a new submenu page
         *
         * @link    http://codex.wordpress.org/Function_Reference/add_submenu_page
         * @since   Total 1.6.0
         */
        function add_menu_subpage(){
            add_submenu_page(
                'wpex-addons',
                __( 'General', 'wpex' ),
                __( 'General', 'wpex' ),
                'manage_options',
                'wpex-addons',
                array( $this, 'create_admin_page' )
            );
        }

        /**
         * Register a setting and its sanitization callback.
         *
         * @link http://codex.wordpress.org/Function_Reference/register_setting
         */
        function register_settings() {
            register_setting( 'wpex_tweaks', 'wpex_tweaks', array( $this, 'admin_sanitize' ) ); 
        }

        /**
         * Main Sanitization callback
         */
        function admin_sanitize( $options ) {

            // Check options first
            if ( ! is_array( $options ) || empty( $options ) || ( false === $options ) ) {
                return array();
            }

            // Save checkboxes
            $checkboxes = array( 'minify_js', 'under_construction_enable', 'remove_posttype_slugs', 'post_series_enable', 'custom_404_enable', 'custom_wp_gallery', 'footer_builder_enable', 'custom_admin_login_enable', 'custom_css_enable', 'widget_areas_enable', 'skins_enable', 'visual_composer_theme_mode', 'extend_visual_composer', 'favicons_enable' );

            // Add post type settings to checkboxes array
            $post_types = wpex_theme_post_types();
            foreach ( $post_types as $post_type ) {
                $checkboxes[] = $post_type .'_enable';
            }

            // Remove thememods for checkboxes not in array
            foreach ( $checkboxes as $checkbox ) {
                if ( isset( $options[$checkbox] ) ) {
                    set_theme_mod( $checkbox, 1 );
                } else {
                    set_theme_mod( $checkbox, 0 );
                }
            }

            // Standard options
            foreach( $options as $key => $value ) {
                if ( in_array( $key, $checkboxes ) ) {
                    continue; // checkboxes already done
                }
                if ( ! empty( $value ) ) {
                    set_theme_mod( $key, $value );
                } else {
                    remove_theme_mod( $key );
                }
            }

            // No need to save in options table
            $options = '';
            return $options;

        }

        /**
         * Settings page output
         */
        function create_admin_page() { ?>
            <div class="wrap">
                <h2><?php _e( 'Theme Panel', 'wpex' ); ?></h2>
                <form method="post" action="options.php">
                    <?php settings_fields( 'wpex_tweaks' ); ?>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php _e( 'Enable Addons', 'wpex' ); ?></th>
                            <td>
                                <fieldset>
                                    <?php $theme_mod = get_theme_mod( 'custom_css_enable', true ); ?>
                                    <label><input type="checkbox" name="wpex_tweaks[custom_css_enable]" value="<?php echo $theme_mod; ?>" <?php checked( $theme_mod, true ); ?>> <?php _e( 'Custom CSS', 'wpex' ); ?></label>
                                    <br />
                                    <label><input type="checkbox" name="wpex_tweaks[favicons_enable]" <?php checked( get_theme_mod( 'favicons_enable', true ) ); ?>> <?php _e( 'Favicons', 'wpex' ); ?></label>
                                    <br />
                                    <label><input type="checkbox" name="wpex_tweaks[custom_404_enable]" <?php checked( get_theme_mod( 'custom_404_enable', true ) ); ?>> <?php _e( '404 Page', 'wpex' ); ?></label>
                                    <br />
                                    <label><input type="checkbox" name="wpex_tweaks[custom_wp_gallery]" <?php checked( get_theme_mod( 'custom_wp_gallery', true ) ); ?>> <?php _e( 'Custom WordPress Gallery', 'wpex' ); ?></label>
                                    <br />
                                    <label><input type="checkbox" name="wpex_tweaks[custom_admin_login_enable]" <?php checked( get_theme_mod( 'custom_admin_login_enable', true ) ); ?>> <?php _e( 'Login Page', 'wpex' ); ?></label>
                                    <br />
                                    <label><input type="checkbox" name="wpex_tweaks[footer_builder_enable]" <?php checked( get_theme_mod( 'footer_builder_enable', true ) ); ?>> <?php _e( 'Footer Builder', 'wpex' ); ?></label>
                                    <br />
                                    <label><input type="checkbox" name="wpex_tweaks[widget_areas_enable]" <?php checked( get_theme_mod( 'widget_areas_enable', true ) ); ?>> <?php _e( 'Widget Areas', 'wpex' ); ?></label>
                                    <br />
                                    <label><input type="checkbox" name="wpex_tweaks[skins_enable]" <?php checked( get_theme_mod( 'skins_enable', false ) ); ?>> <?php _e( 'Skins', 'wpex' ); ?></label>
                                    <br />
                                    <label><input type="checkbox" name="wpex_tweaks[under_construction_enable]" <?php checked( get_theme_mod( 'under_construction_enable', true ) ); ?>> <?php _e( 'Under Construction', 'wpex' ); ?></label>
                                </fieldset>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e( 'Minify Javascript', 'wpex' ); ?></th>
                            <td>
                                <fieldset>
                                    <label><input type="checkbox" name="wpex_tweaks[minify_js]"<?php checked( get_theme_mod( 'minify_js', true ) ); ?>> <?php _e( 'Minify and load all theme related javascript in one single, minified file.', 'wpex' ); ?></label>
                                    <p class="description"><?php _e( 'Improves site speed but best to disable whenever you are troubleshooting an error.', 'wpex' ); ?></p>
                                </fieldset>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e( 'Enable Post Types', 'wpex' ); ?></th>
                            <td>
                                <fieldset>
                                    <?php
                                    // Display post types options
                                    $post_types = wpex_theme_post_types();
                                    foreach ( $post_types as $post_type ) {
                                        if ( post_type_exists( $post_type ) ) {
                                            $obj    = get_post_type_object( $post_type );
                                            $name   = $obj->labels->name;
                                        } else {
                                            $name = ucfirst( $post_type );
                                        } ?>
                                        <label><input type="checkbox" name="wpex_tweaks[<?php echo $post_type; ?>_enable]" <?php checked( get_theme_mod( $post_type . '_enable', true ) ); ?>> <?php echo $name; ?></label>
                                        <br />
                                    <?php } ?>
                                </fieldset>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e( 'Remove Post Type Slugs', 'wpex' ); ?></th>
                            <td>
                                <fieldset>
                                    <label><input type="checkbox" name="wpex_tweaks[remove_posttype_slugs]" <?php checked( get_theme_mod( 'remove_posttype_slugs', false ) ); ?>> <?php _e( 'Remove Custom Post Type Slugs (Experimental)', 'wpex' ); ?></label>
                                    <p class="description"><?php _e( 'Toggle the slug on/off for your custom post types (portfolio, staff, testimonials). Custom Post Types in WordPress by default should have a slug to prevent conflicts, you can use this setting to disable them, but be careful.', 'wpex' ); ?> <?php _e( 'Please make sure to re-save your WordPress permalinks settings whenever changing this option.', 'wpex' ); ?></p>
                                </fieldset>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e( 'Post Series', 'wpex' ); ?></th>
                            <td>
                            <label><input type="checkbox" name="wpex_tweaks[post_series_enable]" <?php checked( get_theme_mod( 'post_series_enable', true ) ); ?>> <?php _e( 'Check to enable the post series function for blog posts.', 'wpex' ); ?></label>
                            </td>
                        </tr>
                        <?php if ( get_theme_mod( 'post_series_enable', true ) ) { ?>
                            <tr valign="top">
                                <th scope="row"><?php _e( 'Post Series Labels', 'wpex' ); ?></th>
                                <td>
                                <input type="text" name="wpex_tweaks[post_series_labels]" value="<?php echo get_theme_mod( 'post_series_labels', __( 'Post Series', 'wpex' ) ); ?>" style="width:25em;">
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row"><?php _e( 'Post Series Slug', 'wpex' ); ?></th>
                                <td>
                                <input type="text" name="wpex_tweaks[post_series_slug]" value="<?php echo get_theme_mod( 'post_series_slug', 'post-series' ); ?>" style="width:25em;">
                                </td>
                            </tr>
                        <?php } ?>
                        <tr valign="top">
                            <th scope="row"><?php _e( 'Visual Composer', 'wpex' ); ?></th>
                            <td>
                                <fieldset>
                                    <label><input type="checkbox" name="wpex_tweaks[visual_composer_theme_mode]" <?php checked( get_theme_mod( 'visual_composer_theme_mode', true ) ); ?>> <?php _e( ' Run Visual Composer In Theme Mode', 'wpex' ); ?></label><p class="description"><?php _e( 'Please keep this option enabled unless you have purchased a full copy of the Visual Composer plugin directly from the author.', 'wpex' ); ?></p>
                                    <br />
                                    <label><input type="checkbox" name="wpex_tweaks[extend_visual_composer]" <?php checked( get_theme_mod( 'extend_visual_composer', true ) ); ?>> <?php _e( ' Extend The Visual Composer?', 'wpex' ); ?></label><p class="description"><?php _e( 'This theme includes many extensions (more modules) for the Visual Composer plugin. If you do not wish to use any disable them here.', 'wpex' ); ?></p>
                                </fieldset>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e( 'Theme Branding', 'wpex' ); ?></th>
                            <td>
                                <fieldset>
                                    <input type="text" name="wpex_tweaks[theme_branding]" value="<?php echo get_theme_mod( 'theme_branding', 'Total' ); ?>" style="width:25em;">
                                </fieldset>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e( 'Analytics Tracking Code', 'wpex' ); ?></th>
                            <td>
                                <fieldset>
                                    <textarea type="text" name="wpex_tweaks[tracking]" rows="5" style="width:25em;"><?php echo get_theme_mod( 'tracking', false ); ?></textarea><p class="description"><?php _e( 'Enter your entire tracking code (javascript).', 'wpex' ); ?></p>
                                </fieldset>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e( 'Item Purchase Code', 'wpex' ); ?></th>
                            <td>
                                <fieldset>
                                    <input type="text" name="wpex_tweaks[envato_license_key]" value="<?php echo get_theme_mod( 'envato_license_key', '' ); ?>" style="width:25em;"><p class="description"><?php _e( 'Enter your Envato license key here if you wish to receive auto updates for your theme.', 'wpex' ); ?></p>
                                </fieldset>
                            </td>
                        </tr>
                    </table>
                    <?php submit_button(); ?>
                </form>
            </div><!-- .wrap -->
        <?php
        }

    }
}
new WPEX_Tweaks_Admin();
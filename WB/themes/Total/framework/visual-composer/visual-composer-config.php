<?php
/**
 * Loads all functions for the Visual Composer
 *
 * @package     Total
 * @subpackage  Framework/Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.6.0
 * @version     2.0.0
 */

// WPEX Visual Composer Class used to tweak VC functions and defaults
class WPEX_Visual_Composer_Config {

    /**
     * Edit the Visual Composer?
     *
     * @since 1.6.0
     */
    public $has_vc_edits = true;

    /**
     * Start things up
     *
     * @since 1.6.0
     */
    public function __construct() {

        // Declare global object to store data for use with custom vc modules and keep things fast
        global $vcex_global;
        $vcex_global = new stdClass;

        // Setup global object to store key data for use with VC modules
        add_action( 'vc_before_init', array( &$this, 'global_object' ), 0 );

        // Load Visual Composer stylesheet at the very top before the main stylesheet so we can override it
        add_action( 'wp_enqueue_scripts', array( &$this, 'reload_js_composer_css' ), 1 );

        // Remove and Load scripts
        add_action( 'wp_enqueue_scripts', array( &$this, 'scripts' ) );

        // Enque scripts for the admin
        add_action( 'admin_enqueue_scripts',  array( &$this, 'admin_scripts' ) );

        // Apply filters so you can disable modifications via a child theme
        $this->has_vc_edits = apply_filters( 'wpex_edit_visual_composer', $this->has_vc_edits );

        // Disable updates
        add_action( 'vc_before_init', array( &$this, 'disable_updates' ) );

        // Define default post types
        add_action( 'init', array( &$this, 'define_post_types' ) );

        // Configure default VC shortcodes
        add_action( 'init', array( &$this, 'config_shortcodes' ) );

        // Remove VC elements
        add_action( 'init', array( &$this, 'remove_elements' ) );

        // Extend the Visual Composer (add new modules)
        add_action( 'after_setup_theme', array( &$this, 'extend' ) );

        // Admin Init
        add_action( 'admin_init', array( &$this, 'remove_params' ) );

        // Remove metaboxes
        add_action( 'do_meta_boxes', array( &$this, 'remove_metaboxes' ) );

        // Include helper functions
        require_once( WPEX_FRAMEWORK_DIR .'visual-composer/helpers.php' );

        // Include helper classes
        require_once( WPEX_FRAMEWORK_DIR .'visual-composer/classes/build-query.php' );
        require_once( WPEX_FRAMEWORK_DIR .'visual-composer/classes/inline-js.php' );
        require_once( WPEX_FRAMEWORK_DIR .'visual-composer/classes/inline-style.php' );
        require_once( WPEX_FRAMEWORK_DIR .'visual-composer/classes/parse-row-atts.php' );

    }

    /**
     * Setup global object to store key data for use with VC modules
     *
     * @since	2.0.2
     * @access	public
     */
    public function global_object() {

        // Get global object
        global $vcex_global;
        
        // Store list of users
        $users     				= get_users( array( 'number' => '30' ) );
        $vcex_global->users_list	= array();
        foreach ( $users as $user ) {
            $vcex_global->users_list[] = array(
                'label' => esc_html( $user->display_name ),
                'value' => $user->ID,
                'group' => __( 'Select', 'wpex' )
            );
        }


    }

    /**
     * Load Visual Composer stylesheet at the very top before the main stylesheet so we can override it
     *
     * @since	2.0.0
     * @access	public
     */
    public function reload_js_composer_css() {
         wp_enqueue_style( 'js_composer_front' );
    }

    /**
     * Remove and Load scripts
     *
     * @since	1.6.0
     * @access	public
     */
    public function scripts() {

        // Remove VC javascript when on the customizer to prevent bugs with jQuery UI
        if ( is_customize_preview() ) {
            wp_deregister_script( 'wpb_composer_front_js' );
            wp_dequeue_script( 'wpb_composer_front_js' );
        }

        // Remove unwanted scripts
        if ( $this->has_vc_edits ) {
            wp_deregister_style( 'js_composer_custom_css' );
        }

    }

    /**
     * Admin Scripts
     *
     * @since	1.6.0
     * @access	public
     */
    public function admin_scripts() {
        
        // Make sure we can edit the visual composer
        if ( ! $this->has_vc_edits ) {
            return;
        }

        // Load custom admin CSS
        wp_enqueue_style( 'vcex-admin-css', WPEX_VCEX_DIR_URI .'assets/admin.css' );

    }

    /**
     * Disable Updates
     * Set the visual composer to run in theme mod
     *
     * @since	1.6.0
     * @access	public
     */
    public function disable_updates() {
        
        if ( ! function_exists( 'vc_set_as_theme' ) ||  ! get_theme_mod( 'visual_composer_theme_mode', true ) ) {
            return;
        }

        // Set VC as theme mode and disable updater
        vc_set_as_theme( true );

    }

    /**
     * Alter default post types
     *
     * @since	2.0.0
     * @access	public
     */
    public function define_post_types() {

        // Return if vc_set_default_editor_post_types doesn't exist
        if ( ! function_exists( 'vc_set_default_editor_post_types' ) ) {
            return;
        }

        // Set default post types for the VC
        vc_set_default_editor_post_types( array( 'page', 'portfolio', 'staff' ) );

    }

    /**
     * Configure core VC shortcodes
     *
     * @since	2.0.0
     * @access	public
     */
    public function config_shortcodes() {

        if ( ! $this->has_vc_edits || ! function_exists( 'vc_add_param' ) ) {
            return;
        }

        // Config files tweak VC modules (add/remove params)
        require_once( WPEX_FRAMEWORK_DIR .'visual-composer/config/vc-row.php' );
        require_once( WPEX_FRAMEWORK_DIR .'visual-composer/config/vc-single-image.php' );

        // Add params to other modules
        require_once( WPEX_FRAMEWORK_DIR .'visual-composer/config/add-params.php' );

    }

    /**
     * Extend the Visual Composer / Add custom modules
     *
     * @since	2.0.0
     * @access	public
     */
    public function extend() {

        if ( ! get_theme_mod( 'extend_visual_composer', true ) ) {
            return;
        }

        require_once( WPEX_VCEX_DIR .'extend.php' );

    }

    /**
     * Remove metaboxes
     *
     * @since   1.6.0
     * @access	public
     *
     * @link    http://codex.wordpress.org/Function_Reference/do_meta_boxes
     */
    public function remove_metaboxes() {

        // Make sure we can edit the visual composer
        if ( ! $this->has_vc_edits ) {
            return;
        }

        // Loop through post types and remove params
        $post_types = get_post_types( '', 'names' ); 
        foreach ( $post_types as $post_type ) {
            remove_meta_box( 'vc_teaser',  $post_type, 'side' );
        }

    }

    /**
     * Remove modules
     *
     * @since	1.6.0
     * @access	public
     *
     * @link http://kb.wpbakery.com/index.php?title=Vc_remove_element
     */
    public function remove_elements() {

        // Make sure we can edit the visual composer
        if ( ! $this->has_vc_edits ) {
            return;
        }

        // Array of elements to remove
        $elements = array(
            'vc_teaser_grid',
            'vc_posts_grid',
            'vc_posts_slider',
            'vc_carousel',
            'vc_wp_tagcloud',
            'vc_wp_archives',
            'vc_wp_calendar',
            'vc_wp_pages',
            'vc_wp_links',
            'vc_wp_posts',
            'vc_gallery',
            'vc_wp_categories',
            'vc_wp_rss',
            'vc_wp_text',
            'vc_wp_meta',
            'vc_wp_recentcomments',
            'vc_images_carousel',
            'layerslider_vc'
        );

        // Add filter for child theme tweaking
        $elements = apply_filters( 'wpex_vc_remove_elements', $elements );

        // Loop through and remove default Visual Composer Elements until fully tested and they work well
        if ( is_array( $elements ) ) {
            foreach ( $elements as $element ) {
                vc_remove_element( $element );
            }
        }

    }

    /**
     * Remove params
     *
     * @since   1.6.0
     * @access	public
     *
     * @link    http://kb.wpbakery.com/index.php?title=Vc_remove_param
     */
    public function remove_params() {

        // Make sure we can edit the visual composer
        if ( ! $this->has_vc_edits ) {
            return;
        }

        // Array of params to remove
        $params = array(

            // Rows
            'vc_row'            => array(
                'font_color',
                'padding',
                'bg_image',
                'bg_color',
                'css',
                'bg_image_repeat',
                'margin_bottom',
            ),

            // Row Inner
            'vc_row_inner'      => array(
                'css',
            ),

            // Seperator w/ Text
            'vc_text_separator' => array(
                'color',
                'el_width',
                'accent_color',
                'border_width',
                'align',
            ),

            // Columns
            'vc_column'         => array(
                'css',
                'font_color',
            ),

            // Column Inner
            'vc_column_inner'   => array(
                'css',
            ),

        );

        // Add filter for child theme tweaking
        $params = apply_filters( 'wpex_vc_remove_params', $params );

        // Loop through and remove default Visual Composer params
        foreach ( $params as $key => $val ) {

            if ( ! is_array( $val ) ) {
                return;
            }
            foreach ( $val as $remove_param ) {
                vc_remove_param( $key, $remove_param );
            }

        }

    }
}
$wpex_visual_composer_config = new WPEX_Visual_Composer_Config();
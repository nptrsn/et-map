<?php
/**
 * Footer Builder Addon
 *
 * @package     Total
 * @subpackage  Framework/Addons
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 2.0.0
 * @version     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Start Class
class WPEX_Footer_Builder {

    /**
     * Start things up
     */
    public function __construct() {
        $this->footer_builder_id = get_theme_mod( 'footer_builder_page_id' );
        add_action( 'admin_menu', array( &$this, 'add_page' ), 20 );
        add_action( 'admin_init', array( &$this,'register_page_options' ) );
        add_action( 'init', array( &$this,'alter_footer' ) );
        add_action( 'wp_head', array( &$this,'remove_singular_actions' ) );
        add_filter( 'wpex_post_layout_class', array( &$this,'remove_sidebar_on_footer_builder' ) );
        add_filter( 'wpex_customizer_panels', array( &$this,'remove_customizer_footer_panel' ) );
    }

    /**
     * Add sub menu page for the custom CSS input
     *
     * @link    http://codex.wordpress.org/Function_Reference/add_theme_page
     * @since   Total 2.0.0
     */
    public function add_page() {
        add_submenu_page(
            'wpex-addons',
            __( 'Footer Builder', 'wpex' ),
            __( 'Footer Builder', 'wpex' ),
            'administrator',
            'wpex-footer-builder-admin',
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Function that will register admin page options.
     *
     * @link    http://codex.wordpress.org/Function_Reference/register_setting
     * @link    http://codex.wordpress.org/Function_Reference/add_settings_section
     * @link    http://codex.wordpress.org/Function_Reference/add_settings_field
     * @since   Total 2.0.0
     */
    public function register_page_options() {

        // Register settings
        register_setting( 'wpex_footer_builder', 'footer_builder', array( $this, 'sanitize' ) );

        // Add main section to our options page
        add_settings_section( 'wpex_footer_builder_main', false, array( $this, 'section_main_callback' ), 'wpex-footer-builder-admin' );

        // Custom Page ID
        add_settings_field(
            'footer_builder_page_id',
            __( 'Footer Builder page', 'wpex' ),
            array( $this, 'content_id_field_callback' ),
            'wpex-footer-builder-admin',
            'wpex_footer_builder_main'
        );

    }

    /**
     * Sanitization callback
     *
     * @since Total 2.0.0
     */
    public function sanitize( $options ) {

        // Set theme mods
        if ( isset( $options['content_id'] ) ) {
            set_theme_mod( 'footer_builder_page_id', $options['content_id'] );
        }

        // Set options to nothing since we are storing in the theme mods
        $options = '';
        return $options;
    }

    /**
     * Main Settings section callback
     *
     * @since Total 2.0.0
     */
    public function section_main_callback( $options ) {
        // Leave blank
    }

    /**
     * Fields callback functions
     *
     * @since Total 2.0.0
     */

    // Footer Builder Page ID
    public function content_id_field_callback() {
        $page_id = get_theme_mod( 'footer_builder_page_id' );
        wp_dropdown_pages( array(
            'echo'              => true,
            'selected'          => $page_id,
            'name'              => 'footer_builder[content_id]',
            'show_option_none'  => __( 'None - Display Widgetized Footer', 'wpex' ),
        ) ); ?>
        <br />
        <p class="description"><?php _e( 'Select your custom page for your footer layout.', 'wpex' ) ?></p>
        <?php if ( $page_id ) { ?>
            <br />
            <a href="<?php echo admin_url( 'post.php?post='. $page_id .'&action=edit' ); ?>" class="button" target="_blank">
                <?php _e( 'Edit your footer', 'wpex' ); ?>
            </a>
        <?php } ?>
    <?php }

    /**
     * Settings page output
     *
     * @since Total 2.0.0
     */
    public function create_admin_page() { ?>
        <div class="wrap">
            <h2><?php _e( 'Footer Builder', 'wpex' ); ?></h2>
            <p>
                <?php _e( 'By default the footer consists of a simple widgetized area. For more complex layouts you can use the option below to select a page which will hold the content and layout for your site footer.', 'wpex' ); ?>
                <br />
                <?php _e( 'Selecting a custom footer will remove all footer functions (footer widgets and footer customizer options) so you can create an entire footer using the Visual Composer and not load that extra functions.', 'wpex' ); ?>
            </p>
            <form method="post" action="options.php">
                <?php settings_fields( 'wpex_footer_builder' ); ?>
                <?php do_settings_sections( 'wpex-footer-builder-admin' ); ?>
                <?php submit_button(); ?>
            </form>
        </div><!-- .wrap -->
    <?php }

    /**
     * Remove the footer and add custom footer if enabled
     *
     * @since Total 2.0.0
     */
    public function alter_footer() {

        // Remove footer and display custom footer
        if ( $this->footer_builder_id ) {

            // Remove theme footer
            remove_action( 'wpex_hook_wrap_bottom', 'wpex_footer', 10 );

            // Add builder footer
            add_action( 'wpex_hook_wrap_bottom', 'wpex_footer_builder_content', 10 );

            // Remove widgets
            unregister_sidebar( 'footer_one' );
            unregister_sidebar( 'footer_two' );
            unregister_sidebar( 'footer_three' );
            unregister_sidebar( 'footer_four' );

        }

    }

    /**
     * Remove header/sidebar/title..etc while editing footer in front end
     *
     * @since Total 2.0.0
     */
    public function remove_singular_actions() {
        if ( ! empty( $this->footer_builder_id ) && is_page( $this->footer_builder_id ) ) {
            global $wpex_theme;
            if ( ! empty( $wpex_theme->hooks ) ) {
                foreach ( $wpex_theme->hooks as $hook ) {
                    remove_all_actions( $hook, 10 );
                }
            }
        }
    }

    /**
     * Remove the footer and add custom footer if enabled
     *
     * @since Total 2.0.0
     */
    public function remove_customizer_footer_panel( $panels ) {
        if ( $this->footer_builder_id ) {
            unset( $panels['footer'] );
        }
        return $panels;
    }

    /**
     * Make Footer builder page full-width (no sidebar)
     *
     * @since Total 2.0.0
     */
    public function remove_sidebar_on_footer_builder( $class ) {
        if ( $this->footer_builder_id ) {
            if ( is_page( $this->footer_builder_id ) ) {
                $class = 'full-width';
            }
        }
        return $class;
    }


}
new WPEX_Footer_Builder();

/**
 * Helper function displays the footer builder content
 *
 * @since   Total 1.0
 * @return  bool
 */
function wpex_footer_builder_content() {
    $page_id = get_theme_mod( 'footer_builder_page_id' );
    if ( function_exists( 'icl_object_id' ) ) $page_id = icl_object_id( $page_id, 'page' ); ?>
    <div class="footer-builder-content clr container">
        <?php echo do_shortcode( get_post_field( 'post_content', $page_id ) ); ?>
    </div><!-- .footer-builder-content -->
<?php }
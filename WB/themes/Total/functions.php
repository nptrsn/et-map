<?php
/**
 * Total functions and definitions.
 * Text Domain: wpex
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * Total is a very powerful theme and virtually anything can be customized
 * via a child theme. If you need any help altering a function, just let us know!
 * Customizations aren't included for free but if it's a simple task I'll be sure to help :)
 * 
 * @package     Total
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @license     http://themeforest.net/licenses/terms/regular
 * @since       Total 1.0.0
 * @version     2.0.0
 */

class WPEX_Theme_Setup {

	/**
	 * Main Theme Class Constructor
	 *
	 * Loads all necessary classes, functions, hooks, configuration files and actions for the theme.
	 * Everything starts here.
	 *
	 * @since   1.6.0
	 * @access  public
	 *
	 * @global  object $wpex_theme Main theme object.
	 */
	public function __construct() {

		// Setup empty class for the global $wpex_theme object
		global $wpex_theme;
		$wpex_theme = new stdClass;

		// Defines hooks and runs actions on init
		add_action( 'init', array( $this, 'actions' ), 0 );

		// Define constants
		add_action( 'after_setup_theme', array( $this, 'constants' ), 1 );

		// Load all the theme addons
		add_action( 'after_setup_theme', array( &$this, 'addons' ), 2 );

		// Load configuration classes (post types & 3rd party plugins)
		// Must load first so it can use hooks defined in the classes
		add_action( 'after_setup_theme', array( &$this, 'configs' ), 3 );

		// Load all core theme function files
		add_action( 'after_setup_theme', array( &$this, 'include_functions' ), 4 );

		// Load framework classes
		add_action( 'after_setup_theme', array( &$this, 'classes' ), 5 );

		// Load custom widgets
		add_action( 'after_setup_theme', array( &$this, 'custom_widgets' ), 5 );

		// Populate the global opject after all core functions are registered and after the WP object is set up
		// Would be best to use template_redirect, but need to use wp_head to fix a bug with the Visual Composer Media Grid builder...
		add_action( 'wp_head', array( $this, 'global_object' ), 0 );

		// Actions & filters
		add_action( 'after_setup_theme', array( &$this, 'add_theme_support' ) );

		// Flush rewrites after theme switch to prevent 404 errors
		add_action( 'after_switch_theme', array( &$this, 'flush_rewrite_rules' ) );

		// Load scripts in the WP admin
		add_action( 'admin_enqueue_scripts', array( &$this, 'admin_scripts' ) );

		// Load theme CSS
		add_action( 'wp_enqueue_scripts', array( &$this, 'theme_css' ) );

		// Load responsive CSS - must be added last
		add_action( 'wp_enqueue_scripts', array( &$this, 'responsive_css' ), 99 );

		// Load theme js
		add_action( 'wp_enqueue_scripts', array( &$this, 'theme_js' ) );

		// Add meta viewport tag to header
		add_action( 'wp_head', array( &$this, 'meta_viewport' ), 1 );

		 // Add meta viewport tag to header
		add_action( 'wp_head', array( &$this, 'meta_edge' ), 0 );

		// Loads CSS for ie8
		add_action( 'wp_head', array( &$this, 'ie8_css' ) );

		// Loads html5 shiv script
		add_action( 'wp_head', array( &$this, 'html5_shiv' ) );

		// Adds tracking code to the site head
		add_action( 'wp_head', array( &$this, 'tracking' ) );

		// Outputs custom CSS to the head
		add_action( 'wp_head', array( &$this, 'custom_css' ), 9999 );

		// register sidebar widget areas
		add_action( 'widgets_init', array( &$this, 'register_sidebars' ) );

		// Define the directory URI for the gallery metabox calss
		add_action( 'wpex_gallery_metabox_dir_uri', array( &$this, 'gallery_metabox_dir_uri' ) );

		// Alter tagcloud widget to display all tags with 1em font size
		add_filter( 'widget_tag_cloud_args', array( &$this, 'widget_tag_cloud_args' ) );

		// Alter WP categories widget to display count inside a span
		add_filter( 'wp_list_categories', array( &$this, 'wp_list_categories_args' ) );

		// Exclude categories from the blog page
		add_filter( 'pre_get_posts', array( &$this, 'pre_get_posts' ) );

		// Add new social profile fields to the user dashboard
		add_filter( 'user_contactmethods', array( &$this, 'add_user_social_fields' ) );

		// Add a responsive wrapper to the WordPress oembed output
		add_filter( 'embed_oembed_html', array( &$this, 'add_responsive_wrap_to_oembeds' ), 99, 4 );

		// Allow for the use of shortcodes in the WordPress excerpt
		add_filter( 'the_excerpt', 'shortcode_unautop' );
		add_filter( 'the_excerpt', 'do_shortcode' );

		// Make sure the wp_get_attachment_url() function returns correct page request (HTTP or HTTPS)
		add_filter( 'wp_get_attachment_url', array( &$this, 'honor_ssl_for_attachments' ) );

		// Tweak the default password protection output form
		add_filter( 'the_password_form', array( &$this, 'custom_password_protected_form' ) );

		// Exclude posts with custom links from the next and previous post links
		add_filter( 'get_previous_post_join', array( &$this, 'prev_next_join' ) );
		add_filter( 'get_next_post_join', array( &$this, 'prev_next_join' ) );
		add_filter( 'get_previous_post_where', array( &$this, 'prev_next_where' ) );
		add_filter( 'get_next_post_where', array( &$this, 'prev_next_where' ) );

		// Redirect posts with custom links
		add_filter( 'template_redirect', array( &$this, 'redirect_custom_links' ) );

	}

	/**
	 * Defines the constants for use within the theme.
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function constants() {

		// Theme version
		define( 'WPEX_THEME_VERSION', '2.0.2' );

		// Paths to the parent theme directory
		define( 'WPEX_THEME_DIR', get_template_directory() );
		define( 'WPEX_THEME_URI', get_template_directory_uri() );

		// Javascript and CSS Paths
		define( 'WPEX_JS_DIR_URI', WPEX_THEME_URI .'/js/' );
		define( 'WPEX_CSS_DIR_URI', WPEX_THEME_URI .'/css/' );

		// Skins Paths
		define( 'WPEX_SKIN_DIR', WPEX_THEME_DIR .'/skins/' );
		define( 'WPEX_SKIN_DIR_URI', WPEX_THEME_URI .'/skins/' );

		// Framework Paths
		define( 'WPEX_FRAMEWORK_DIR', WPEX_THEME_DIR .'/framework/' );
		define( 'WPEX_FRAMEWORK_DIR_URI', WPEX_THEME_URI .'/framework/' );
		define( 'WPEX_ClASSES', WPEX_FRAMEWORK_DIR .'/classes/' );

		// Classes directory
		define( 'WPEX_ClASSES_DIR', WPEX_FRAMEWORK_DIR .'/classes/' );

		// Admin Panel Hook
		define( 'WPEX_ADMIN_PANEL_HOOK_PREFIX', 'theme-panel_page_' );

		// Check if plugins are active
		define( 'WPEX_VC_ACTIVE', class_exists( 'Vc_Manager' ) );
		define( 'WPEX_BBPRESS_ACTIVE', class_exists( 'bbPress' ) );
		define( 'WPEX_WOOCOMMERCE_ACTIVE', class_exists( 'WooCommerce' ) );
		define( 'WPEX_REV_SLIDER_ACTIVE', class_exists( 'RevSlider' ) );
		define( 'WPEX_LAYERSLIDER_ACTIVE', function_exists( 'lsSliders' ) );
		define( 'WPEX_WPML_ACTIVE', class_exists( 'SitePress' ) );
		define( 'WPEX_TRIBE_EVENTS_CALENDAR_ACTIVE', class_exists( 'TribeEvents' ) );

		// Active post types
		define( 'WPEX_PORTFOLIO_IS_ACTIVE', get_theme_mod( 'portfolio_enable', true ) );
		define( 'WPEX_STAFF_IS_ACTIVE', get_theme_mod( 'staff_enable', true ) );
		define( 'WPEX_TESTIMONIALS_IS_ACTIVE', get_theme_mod( 'testimonials_enable', true ) );

		// Define branding constant based on theme options
		define( 'WPEX_THEME_BRANDING', get_theme_mod( 'theme_branding', 'Total' ) );

		// Visual Composer
		define( 'WPEX_VCEX_DIR', WPEX_FRAMEWORK_DIR .'visual-composer/extend/' );
		define( 'WPEX_VCEX_DIR_URI', WPEX_FRAMEWORK_DIR_URI .'visual-composer/extend/' );

	}

	/**
	 * Defines all theme hooks and runs all needed actions for theme hooks.
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function actions() {
		require_once( WPEX_FRAMEWORK_DIR .'hooks/hooks.php' );
		require_once( WPEX_FRAMEWORK_DIR .'hooks/actions.php' );
		require_once( WPEX_FRAMEWORK_DIR .'hooks/partials.php' );
	}

	/**
	 * Theme addons.
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function addons() {

		// Main Theme Panel
		require_once( WPEX_FRAMEWORK_DIR .'addons/tweaks.php' );

		// Under Construction
		if ( get_theme_mod( 'under_construction_enable', true ) ) {
			require_once( WPEX_FRAMEWORK_DIR .'addons/under-construction.php' );
		}

		// Custom Favicons
		if ( get_theme_mod( 'favicons_enable', true ) ) {
			require_once( WPEX_FRAMEWORK_DIR .'addons/favicons.php' );
		}

		// Custom 404
		if ( get_theme_mod( 'custom_404_enable', true ) ) {
			require_once( WPEX_FRAMEWORK_DIR .'addons/custom-404.php' );
		}

		// Custom widget areas
		if ( get_theme_mod( 'widget_areas_enable', true ) ) {
			require_once( WPEX_FRAMEWORK_DIR .'addons/widget-areas.php' );
		}

		// Custom Login
		if ( get_theme_mod( 'custom_admin_login_enable', true ) ) {
			require_once( WPEX_FRAMEWORK_DIR .'addons/custom-login.php' );
		}

		// Footer builder
		if ( get_theme_mod( 'footer_builder_enable', true ) ) {
			require_once( WPEX_FRAMEWORK_DIR .'addons/footer-builder.php' );
		}

		// Custom WordPress gallery output
		if ( get_theme_mod( 'custom_wp_gallery', true ) ) {
			require_once( WPEX_FRAMEWORK_DIR .'addons/custom-wp-gallery.php' );
		}

		// Custom CSS
		if ( get_theme_mod( 'custom_css_enable', true ) ) {
			require_once( WPEX_FRAMEWORK_DIR .'addons/custom-css.php' );
		}

		// Skins
		if ( get_theme_mod( 'skins_enable', true ) ) {
			require_once( WPEX_SKIN_DIR . 'skins.php' );
		}

		// Customizer
		require_once( WPEX_FRAMEWORK_DIR .'customizer/customizer.php' );

		// Import Export Functions
		if ( is_admin() ) {
			require_once( WPEX_FRAMEWORK_DIR .'addons/import-export.php' );
		}

	}

	/**
	 * Configs for post types and 3rd party plugins.
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function configs() {

		// Recommend plugins
		require_once( WPEX_FRAMEWORK_DIR .'config/tgm-plugin-activation-config.php' );

		// Post Series
		if ( get_theme_mod( 'post_series_enable', true ) ) {
			require_once( WPEX_FRAMEWORK_DIR .'post-series/post-series-config.php' );
		}

		// Portfolio config
		if ( WPEX_PORTFOLIO_IS_ACTIVE ) {
			require_once( WPEX_FRAMEWORK_DIR .'portfolio/portfolio-config.php' );
		}

		// Staff config
		if ( WPEX_STAFF_IS_ACTIVE ) {
			require_once( WPEX_FRAMEWORK_DIR .'staff/staff-config.php' );
		}

		// Testimonials config
		if ( WPEX_TESTIMONIALS_IS_ACTIVE ) {
			require_once( WPEX_FRAMEWORK_DIR .'testimonials/testimonials-config.php' );
		}

		// WooCommerce config
		if ( WPEX_WOOCOMMERCE_ACTIVE ) {

			// WooCommerce core tweaks
			require_once( WPEX_FRAMEWORK_DIR .'woocommerce/woocommerce-config.php' );

		}

		// Visual composer config
		if ( WPEX_VC_ACTIVE ) {
			require_once( WPEX_FRAMEWORK_DIR .'visual-composer/visual-composer-config.php' );
		}

		// Tribe events config
		if ( WPEX_TRIBE_EVENTS_CALENDAR_ACTIVE ) {
			require_once( WPEX_FRAMEWORK_DIR .'config/tribe-events-config.php' );
		}

		// Revolution slider config
		if ( WPEX_REV_SLIDER_ACTIVE ) {
			require_once( WPEX_FRAMEWORK_DIR .'config/revslider-config.php' );
		}

		// WPML Config
		if ( WPEX_WPML_ACTIVE ) {
			require_once( WPEX_FRAMEWORK_DIR .'config/wpml-config.php' );
		}

		// Polylang Config
		if ( class_exists( 'Polylang' ) ) {
			require_once( WPEX_FRAMEWORK_DIR .'config/polylang-config.php' );
		}

	}

	/**
	 * Framework functions.
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function include_functions() {

		// Display warnings for deprecated functions
		require_once( WPEX_FRAMEWORK_DIR .'deprecated.php' );

		// Core functions used throughout the theme
		require_once( WPEX_FRAMEWORK_DIR .'core.php' );

		// Conditional functions
		require_once( WPEX_FRAMEWORK_DIR .'conditionals.php' );

		// Useful arrays
		require_once( WPEX_FRAMEWORK_DIR .'arrays.php' );

		// Custom fonts and typography functions
		require_once( WPEX_FRAMEWORK_DIR .'fonts.php' );

		// Image overlays
		require_once( WPEX_FRAMEWORK_DIR .'overlays.php' );

		// Meta
		require_once( WPEX_FRAMEWORK_DIR .'category-meta.php');

		// Add classes to the body tag
		require_once( WPEX_FRAMEWORK_DIR .'body-classes.php' );

		// Toggle bar functions
		require_once( WPEX_FRAMEWORK_DIR .'togglebar.php' );

		// Topbar functions
		require_once( WPEX_FRAMEWORK_DIR .'topbar.php' );

		// Header functions
		require_once( WPEX_FRAMEWORK_DIR .'header-functions.php' );

		// Search functions
		require_once( WPEX_FRAMEWORK_DIR .'search-functions.php' );

		// Returns correct title name for any page/post
		require_once( WPEX_FRAMEWORK_DIR .'title.php' );

		// Page header / Title functions
		require_once( WPEX_FRAMEWORK_DIR .'page-header.php' );

		// Main header menu functions
		require_once( WPEX_FRAMEWORK_DIR .'menu-functions.php' );

		// Post layouts
		require_once( WPEX_FRAMEWORK_DIR .'post-layout.php' );

		// Custom excerpt functions and WordPress Excerpt tweaks
		require_once( WPEX_FRAMEWORK_DIR .'excerpts.php' );

		// TinyMCE editor tweaks and addons
		require_once( WPEX_FRAMEWORK_DIR .'tinymce.php' );

		// Adds thumbnails to the WP dashboard
		if ( is_admin() && get_theme_mod( 'blog_dash_thumbs', true ) ) {
			require_once( WPEX_FRAMEWORK_DIR .'thumbnails/dashboard-thumbnails.php' );
		}

		// Custom comments callback
		require_once( WPEX_FRAMEWORK_DIR .'comments-callback.php');

		// Post slider functions and output
		require_once( WPEX_FRAMEWORK_DIR .'post-slider.php' );

		// Social sharing output
		require_once( WPEX_FRAMEWORK_DIR .'social-share.php' );

		// Main blog functions
		require_once( WPEX_FRAMEWORK_DIR .'blog/blog-functions.php' );

		// Main footer functions
		require_once( WPEX_FRAMEWORK_DIR .'footer-functions.php' );

		// Pagination functions
		require_once( WPEX_FRAMEWORK_DIR .'pagination.php' );

		// Adds new media fields to the WP media library items
		require_once( WPEX_FRAMEWORK_DIR .'thumbnails/media-fields.php' );

		// Add some basic shortcodes
		require_once( WPEX_FRAMEWORK_DIR .'shortcodes/shortcodes.php' );

	}

	/**
	 * Framework Classes.
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function classes() {

		// Automatic updates
		if ( get_theme_mod( 'envato_license_key' ) ) {
			require_once(  WPEX_FRAMEWORK_DIR .'classes/auto-updates/wp-updates-theme.php');
		}

		// Migrate old redux options to new Customizer
		if ( ! get_option( 'wpex_customizer_migration_complete' ) ) {
			require_once( WPEX_FRAMEWORK_DIR .'classes/migrate/migrate.php' );
		}

		// Sanitize data
		require_once( WPEX_FRAMEWORK_DIR .'classes/sanitize/sanitize-data.php');

		// Recommends plugins for use with the theme
		require_once( WPEX_FRAMEWORK_DIR .'classes/tgm-plugin-activation/class-tgm-plugin-activation.php' );

		// Speeds up the WordPress menu
		require_once( WPEX_FRAMEWORK_DIR .'classes/faster-menu-dashboard/faster-menu-dashboard.php' );

		// Site breadcrumbs
		require_once( WPEX_FRAMEWORK_DIR .'classes/breadcrumbs/breadcrumbs.php' );

		// Image resizer class
		require_once( WPEX_FRAMEWORK_DIR .'classes/image-resize/image-resize.php' );

		// Custom site layouts
		require_once( WPEX_FRAMEWORK_DIR .'classes/site-layouts/site-layouts.php' );

		// Custom backgrounds
		require_once( WPEX_FRAMEWORK_DIR .'classes/site-backgrounds/site-backgrounds.php' );

		// Advanced styling output for customizer settings
		require_once( WPEX_FRAMEWORK_DIR .'classes/advanced-styling/advanced-styling.php' );

		// Adds a gallery metabox to posts
		require_once( WPEX_FRAMEWORK_DIR .'classes/gallery-metabox/gallery-metabox.php' );

		// Define page settings metabox
		require_once( WPEX_FRAMEWORK_DIR .'classes/post-metaboxes/post-metaboxes.php');

		// Remove post type slugs if enabled
		if ( get_theme_mod( 'remove_posttype_slugs' ) ) {
			require_once( WPEX_ClASSES_DIR .'remove-post-type-slugs/remove-post-type-slugs.php' );
		}

		// Add image Sizes
		require_once( WPEX_FRAMEWORK_DIR .'classes/image-sizes/image-sizes.php');

		// Custom Header
		require_once( WPEX_FRAMEWORK_DIR .'classes/custom-header/custom-header.php');

	}

	/**
	 * Include all custom widget classes
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function custom_widgets() {

		// Define array of custom widgets for the theme
		$widgets = array(
			'social-fontawesome',
			'social',
			'simple-menu',
			'modern-menu',
			'flickr',
			'video',
			'posts-thumbnails',
			'posts-grid',
			'posts-icons',
			'comments-avatar',
		);

		// Apply filters so you can remove custom widgets via a child theme if wanted
		$widgets = apply_filters( 'wpex_custom_widgets', $widgets );

		// Loop through widgets and load their files
		foreach ( $widgets as $widget ) {
			$widget_file = WPEX_FRAMEWORK_DIR .'classes/widgets/'. $widget .'.php';
			if ( file_exists( $widget_file ) ) {
				require_once( $widget_file );
			}
		}

	}

	/**
	 * Populate the $wpex_theme global object.
	 *
	 * This helps speed things up by calling specific functions only once rather then multiple times.
	 *
	 * @since   2.0.0
	 * @access  public
	 *
	 * @global  object $wpex_theme Main theme object.
	 */
	public function global_object() {

		// Get global object
		global $wpex_theme;

		// Array of all theme hooks
		$wpex_theme->hooks                      = wpex_theme_hooks();

		// Main
		$wpex_theme->skin                       = function_exists( 'wpex_active_skin' ) ? wpex_active_skin() : 'base';
		$wpex_theme->post_id                    = wpex_get_the_id();
		$wpex_theme->main_layout                = wpex_main_layout( $wpex_theme->post_id );
		$wpex_theme->responsive                 = get_theme_mod( 'responsive', true );
		$wpex_theme->post_layout                = wpex_post_layout( $wpex_theme->post_id );
		$wpex_theme->has_site_header            = wpex_has_header( $wpex_theme->post_id );
		$wpex_theme->has_overlay_header         = $wpex_theme->has_site_header ? wpex_has_header_overlay( $wpex_theme->post_id ) : false;
		$wpex_theme->header_overlay_style       = get_post_meta( $wpex_theme->post_id, 'wpex_overlay_header_style', true );
		$wpex_theme->header_style               = wpex_get_header_style( $wpex_theme->post_id );
		$wpex_theme->header_logo                = wpex_header_logo_img();
		$wpex_theme->page_header_style          = wpex_page_header_style( $wpex_theme->post_id );
		$wpex_theme->lightbox_skin              = wpex_ilightbox_skin();
		$wpex_theme->mobile_menu_style          = wpex_mobile_menu_style();
		$wpex_theme->header_search_style        = wpex_header_search_style();
		$wpex_theme->sidr_menu_source           = wpex_mobile_menu_source();
		$wpex_theme->post_slider_position       = wpex_post_slider_position( $wpex_theme->post_id );
		$wpex_theme->fixed_header_custom_logo   = wpex_fixed_header_logo( $wpex_theme->post_id );
		$wpex_theme->shrink_fixed_header        = get_theme_mod( 'shink_fixed_header', true );
		$wpex_theme->is_mobile                  = wp_is_mobile();
		$wpex_theme->has_composer               = wpex_has_composer( $wpex_theme->post_id );
		$wpex_theme->has_top_bar                = wpex_has_top_bar( $wpex_theme->post_id );
		$wpex_theme->toggle_bar_content_id      = wpex_toggle_bar_content_id();
		$wpex_theme->has_togglebar              = wpex_has_togglebar( $wpex_theme->post_id );
		$wpex_theme->has_page_header            = wpex_has_page_header( $wpex_theme->post_id );
		$wpex_theme->has_page_header_title      = wpex_has_page_header_title( $wpex_theme->post_id );
		$wpex_theme->has_page_header_subheading = wpex_has_page_header_subheading( $wpex_theme->post_id );
		$wpex_theme->has_post_slider            = wpex_has_post_slider( $wpex_theme->post_id );
		$wpex_theme->has_breadcrumbs            = wpex_has_breadcrumbs( $wpex_theme->post_id );
		$wpex_theme->has_fixed_header           = wpex_has_fixed_header();
		$wpex_theme->has_footer                 = wpex_has_footer( $wpex_theme->post_id );
		$wpex_theme->has_footer_widgets         = wpex_has_footer_widgets( $wpex_theme->post_id );
		$wpex_theme->has_footer_reveal          = wpex_has_footer_reveal( $wpex_theme->post_id );
		$wpex_theme->has_footer_callout         = wpex_has_footer_callout( $wpex_theme->post_id );
		$wpex_theme->has_social_share           = wpex_has_social_share( $wpex_theme->post_id );

	}

	/**
	 * Adds basic theme support functions and registers the nav menus
	 *
	 * @since   1.6.0
	 * @access  public
	 *
	 * @var     integer $content_width WP global variable.
	 */
	public function add_theme_support() {

		// Get globals
		global $content_width;

		// Set content width based on theme's default design
		if ( ! isset( $content_width ) ) {
			$content_width = 980;
		}

		// Register navigation menus
		register_nav_menus (
			array(
				'topbar_menu'       => __( 'Top Bar', 'wpex' ),
				'main_menu'         => __( 'Main', 'wpex' ),
				'mobile_menu'       => __( 'Mobile Icons', 'wpex' ),
				'mobile_menu_alt'   => __( 'Mobile Menu Alternative', 'wpex' ),
				'footer_menu'       => __( 'Footer', 'wpex' ),
			)
		);

		// Load text domain
		load_theme_textdomain( 'wpex', WPEX_THEME_DIR .'/languages' );

		// Enable some useful post formats for the blog
		add_theme_support( 'post-formats', array( 'video', 'gallery', 'audio', 'quote', 'link' ) );
		
		// Add automatic feed links in the header - for themecheck nagg
		add_theme_support( 'automatic-feed-links' );
		
		// Enable featured image support
		add_theme_support( 'post-thumbnails' );
		
		// And HTML5 support
		add_theme_support( 'html5' );
		
		// Enable excerpts for pages.
		add_post_type_support( 'page', 'excerpt' );
		
		// Add support for WooCommerce - Yay!
		add_theme_support( 'woocommerce' );

		// Add styles to the WP editor
		add_editor_style( 'css/editor-style.css' );

		// Title tag
		add_theme_support( 'title-tag' );

	}

	/**
	 * Functions called after theme switch
	 *
	 * @since   1.6.0
	 * @access  public
	 *
	 * @link    http://codex.wordpress.org/Plugin_API/Action_Reference/after_switch_theme
	 */
	public function flush_rewrite_rules() {
		flush_rewrite_rules();
	}

	/**
	 * Adds the meta tag to the site header
	 *
	 * @since   1.6.0
	 * @access  public
	 *
	 * @global  object $wpex_theme Main theme object.
	 */
	public function meta_viewport() {

		// Get global object
		global $wpex_theme;

		// Responsive viewport viewport
		if ( ! empty( $wpex_theme->responsive ) ) {
			$viewport = '<meta name="viewport" content="width=device-width, initial-scale=1">';
		}

		// Non responsive meta viewport
		else {
			$width      = intval( get_theme_mod( 'main_container_width', '980' ) );
			$width      = $width ? $width: '980';
			$viewport   = '<meta name="viewport" content="width='. $width .'" />';
		}
		
		// Apply filters to the meta viewport for child theme tweaking
		echo apply_filters( 'wpex_meta_viewport', $viewport );

	}

	/**
	 * Adds meta edge tag to disable compatability mode in IE
	 *
	 * @since   2.0.2
	 * @access  public
	 *
	 * @link	https://www.modern.ie/en-us/performance/how-to-use-x-ua-compatible
	 */
	public static function meta_edge() {
	   echo '<meta http-equiv="X-UA-Compatible" content="IE=edge" />';
	}

	/**
	 * Load scripts in the WP admin
	 *
	 * @since   1.6.0
	 * @access  public
	 *
	 * @link    http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	 */
	public function admin_scripts() {
		wp_enqueue_style( 'wpex-font-awesome', WPEX_CSS_DIR_URI .'font-awesome.min.css' );
	}

	/**
	 * Returns all CSS needed for the front-end
	 *
	 * @since   1.6.0
	 * @access  public
	 *
	 * @global  object $wpex_theme Main theme object.
	 */
	public function theme_css() {
		
		// Get global object
		global $wpex_theme;

		// Font Awesome
		wp_deregister_style( 'font-awesome' );
		wp_deregister_style( 'fontawesome' );
		wp_enqueue_style( 'wpex-font-awesome', WPEX_CSS_DIR_URI .'font-awesome.min.css', false, '4.3.0' );

		// Register hover-css
		wp_register_style( 'wpex-hover-animations', WPEX_CSS_DIR_URI .'hover-css.min.css', false, '2.0.1' );

		// Main Style.css File
		wp_enqueue_style( 'wpex-style', get_stylesheet_uri(), false, WPEX_THEME_VERSION );

		// Load RTL.css first
		if ( is_RTL() ) {
			wp_enqueue_style( 'wpex-rtl', WPEX_CSS_DIR_URI .'rtl.css', array( 'wpex-style' ), false );
		}

		// Visual Composer CSS
		if ( WPEX_VC_ACTIVE ) {
			wp_enqueue_style( 'wpex-visual-composer', WPEX_CSS_DIR_URI .'wpex-visual-composer.css', array( 'js_composer_front' ), '2.0.1' );
			wp_enqueue_style( 'wpex-visual-composer-extend', WPEX_CSS_DIR_URI .'wpex-visual-composer-extend.css', '', '2.0.0' );
		}

		// BBPress CSS
		if ( WPEX_BBPRESS_ACTIVE && is_bbpress() ) {
			wp_enqueue_style( 'wpex-bbpress', WPEX_CSS_DIR_URI .'wpex-bbpress.css', array( 'bbp-default' ), '2.0.0' );
		}

		// Ligthbox skin
		if ( ! empty( $wpex_theme->lightbox_skin ) ) {
			wp_enqueue_style( 'wpex-ilightbox-'. $wpex_theme->lightbox_skin .'-skin', wpex_ilightbox_stylesheet( $wpex_theme->lightbox_skin ), array( 'wpex-style' ) );
		}

	}

	/**
	 * Loads responsive css very last after all styles.
	 *
	 * @since   1.6.0
	 * @access  public
	 */
	public function responsive_css() {

		// Return if responsiveness is disabled
		if ( ! wpex_is_responsive() ) {
			return;
		}

		// Load main theme responsive.css file
		wp_enqueue_style( 'wpex-responsive', WPEX_CSS_DIR_URI .'responsive.css' );

	}

	/**
	 * Returns all js needed for the front-end
	 *
	 * @since   1.6.0
	 * @access  public
	 *
	 * @global  object $wpex_theme Main theme object.
	 */
	public function theme_js() {

		// Get global object
		global $wpex_theme;

		// Make sure the core jQuery script is loaded
		wp_enqueue_script( 'jquery' );

		// Retina.js
		if ( wpex_is_retina_enabled() ) {
			wp_enqueue_script( 'retina', WPEX_JS_DIR_URI .'retina.js', array( 'jquery' ), '0.0.2', true );
		}

		// Comment reply
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Localize data
		$localize_array = array(
			'isMobile'                  => $wpex_theme->is_mobile,
			'isRTL'                     => is_rtl(),
			'mainLayout'                => $wpex_theme->main_layout,
			'mobileMenuStyle'           => $wpex_theme->mobile_menu_style,
			'sidrSource'                => $wpex_theme->sidr_menu_source,
			'sidrDisplace'              => true,
			'lightboxSkin'              => $wpex_theme->lightbox_skin,
			'lightboxArrows'            => get_theme_mod( 'lightbox_arrows', true ),
			'lightboxThumbnails'        => get_theme_mod( 'lightbox_thumbnails', true ),
			'lightboxFullScreen'        => get_theme_mod( 'lightbox_fullscreen', true ),
			'lightboxMouseWheel'        => get_theme_mod( 'lightbox_mousewheel', false ),
			'lightboxTitles'            => get_theme_mod( 'lightbox_titles', true ),
			'sidrSide'                  => get_theme_mod( 'mobile_menu_sidr_direction', 'left' ),
			'headerSeachStyle'          => $wpex_theme->header_search_style,
			'wooCartStyle'              => get_theme_mod( 'woo_menu_icon_style', 'drop-down' ),
			'superfishDelay'            => 600,
			'superfishSpeed'            => 'fast',
			'superfishSpeedOut'         => 'fast',
			'localScrollSpeed'          => 1000,
			'overlayHeaderStickyTop'    => 0,
			'siteHeaderStyle'           => $wpex_theme->header_style,
			'hasFixedMobileHeader'      => get_theme_mod( 'fixed_header_mobile', false ),
			'hasFixedHeader'            => $wpex_theme->has_fixed_header,
			'fixedHeaderBreakPoint'     => 960,
			'hasTopBar'                 => $wpex_theme->has_top_bar,
			'hasFooterReveal'           => $wpex_theme->has_footer_reveal,
			'hasHeaderOverlay'          => $wpex_theme->has_overlay_header,
			'fixedHeaderCustomLogo'     => $wpex_theme->fixed_header_custom_logo,
			'fixedHeaderHeight'         => '70',
			'shrinkFixedHeader'         => $wpex_theme->shrink_fixed_header,
			'retinaLogo'                => get_theme_mod( 'retina_logo' ),
		);

		$localize_array = apply_filters( 'wpex_localize_array', $localize_array );

		// Load minified global scripts
		if ( get_theme_mod( 'minify_js', true ) ) {

			wp_enqueue_script( 'total-min', WPEX_JS_DIR_URI .'total-min.js', array( 'jquery' ), '2.0.1', true );
			wp_localize_script( 'total-min', 'wpexLocalize', $localize_array );

		}
		
		// Load all non-minified js
		else {

			// Superfish used for menu dropdowns
			wp_enqueue_script( 'wpex-superfish', WPEX_JS_DIR_URI .'lib/superfish.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'wpex-supersubs', WPEX_JS_DIR_URI .'lib/supersubs.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'wpex-hoverintent', WPEX_JS_DIR_URI .'lib/hoverintent.js', array( 'jquery' ), false, true );

			// Sticky header
			wp_enqueue_script( 'wpex-sticky', WPEX_JS_DIR_URI .'lib/sticky.js', array( 'jquery' ), false, true );
			wp_localize_script( 'wpex-sticky', 'wpexLocalize', array( 'retinaLogo' => $localize_array['retinaLogo'] ) );

			// Tooltips
			wp_enqueue_script( 'wpex-tipsy', WPEX_JS_DIR_URI .'lib/tipsy.js', array( 'jquery' ), false, true );

			// Checks if images are loaded within an element
			wp_enqueue_script( 'wpex-images-loaded', WPEX_JS_DIR_URI .'lib/images-loaded.js', array( 'jquery' ), false, true );

			// Main masonry script
			wp_enqueue_script( 'wpex-isotope', WPEX_JS_DIR_URI .'lib/isotope.js', array( 'jquery' ), false, true );

			// Leaner modal used for search/woo modals
			wp_enqueue_script( 'wpex-leanner-modal', WPEX_JS_DIR_URI .'lib/leanner-modal.js', array( 'jquery' ), false, true );

			// Slider Pro
			wp_enqueue_script( 'wpex-sliderpro', WPEX_JS_DIR_URI .'lib/jquery.sliderPro.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'wpex-sliderpro-customthumbnails', WPEX_JS_DIR_URI .'lib/jquery.sliderProCustomThumbnails.js', array( 'jquery' ), false, true );

			// Touch Swipe - do we need it?
			wp_enqueue_script( 'wpex-touch-swipe', WPEX_JS_DIR_URI .'lib/touch-swipe.js', array( 'jquery' ), false, true );

			// Carousels
			wp_enqueue_script( 'wpex-owl-carousel', WPEX_JS_DIR_URI .'lib/owl.carousel.js', array( 'jquery' ), false, true );

			// Used for milestones
			wp_enqueue_script( 'wpex-count-to', WPEX_JS_DIR_URI .'lib/count-to.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'wpex-appear', WPEX_JS_DIR_URI .'lib/appear.js', array( 'jquery' ), false, true );

			// Mobile menu
			wp_enqueue_script( 'wpex-sidr', WPEX_JS_DIR_URI .'lib/sidr.js', array( 'jquery' ), false, true );

			// Custom Selects
			wp_enqueue_script( 'wpex-custom-select', WPEX_JS_DIR_URI .'lib/jquery.customSelect.js', array( 'jquery' ), false, true );

			// Equal Heights
			wp_enqueue_script( 'wpex-match-height', WPEX_JS_DIR_URI .'lib/jquery.matchHeight.js', array( 'jquery' ), false, true );

			// Not sure if needed, lets check on that and removed if not!
			wp_enqueue_script( 'wpex-mousewheel', WPEX_JS_DIR_URI .'lib/jquery.mousewheel.js', array( 'jquery' ), false, true );

			// Parallax bgs
			wp_enqueue_script( 'wpex-scrolly', WPEX_JS_DIR_URI .'lib/scrolly.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'wpex-request-animation', WPEX_JS_DIR_URI .'lib/jquery.requestAnimationFrame.js', array( 'jquery' ), false, true );

			// iLightbox
			wp_enqueue_script( 'wpex-ilightbox', WPEX_JS_DIR_URI .'lib/ilightbox.js', array( 'jquery' ), false, true );

			// WooCommerce quanity buttons
			if ( WPEX_WOOCOMMERCE_ACTIVE ) {
				wp_enqueue_script( 'wc-quantity-increment', WPEX_JS_DIR_URI .'lib/wc-quantity-increment.js', array( 'jquery' ), false, true );
			}

			// Core global functions
			wp_enqueue_script( 'wpex-functions', WPEX_JS_DIR_URI .'functions.js', array( 'jquery' ), false, true );

			// Localize script
			wp_localize_script( 'wpex-functions', 'wpexLocalize', $localize_array );

		}

	}

	/**
	 * Adds CSS for ie8
	 * Applies the wpex_ie_8_url filter so you can alter your IE8 stylesheet URL
	 *
	 * @access  public
	 * @since   1.6.0
	 *
	 * @return  sring
	 */
	public function ie8_css() {
		$ie_8_url   = WPEX_CSS_DIR_URI .'ie8.css';
		$ie_8_url   = apply_filters( 'wpex_ie_8_url', $ie_8_url );
		echo '<!--[if IE 8]><link rel="stylesheet" type="text/css" href="'. $ie_8_url .'" media="screen"><![endif]-->';
	}

	/**
	 * Load HTML5 dependencies for IE8
	 *
	 * @since   1.6.0
	 * @access  public
	 *
	 * @link    https://github.com/aFarkas/html5shiv
	 */
	public function html5_shiv() {
		echo '<!--[if lt IE 9]>
			<script src="'. WPEX_JS_DIR_URI .'html5.js"></script>
		<![endif]-->';
	}

	/**
	 * Outputs tracking code in the header
	 *
	 * @since   1.6.0
	 * @access  public
	 */
	public function tracking() {

		// Return if user is logged in
		if ( is_user_logged_in() ) {
			return;
		}

		// Display tracking code
		if ( $tracking = get_theme_mod( 'tracking' ) ) {
			echo $tracking;
		}

	}

	/**
	 * Registers the theme sidebars (widget areas)
	 *
	 * @since   1.6.0
	 * @access  public
	 *
	 * @link    http://codex.wordpress.org/Function_Reference/register_sidebar 
	 */
	public function register_sidebars() {

		// Heading element type
		$sidebar_headings   = get_theme_mod( 'sidebar_headings', 'div' );
		$sidebar_headings   = $sidebar_headings ? $sidebar_headings : 'div';
		$footer_headings    = get_theme_mod( 'footer_headings', 'div' );
		$footer_headings    = $footer_headings ? $footer_headings : 'div';

		// Main Sidebar
		register_sidebar( array (
			'name'          => __( 'Main Sidebar', 'wpex' ),
			'id'            => 'sidebar',
			'description'   => __( 'Widgets in this area are used in the default sidebar. This sidebar will be used for your standard blog posts.', 'wpex' ),
			'before_widget' => '<div class="sidebar-box %2$s clr">',
			'after_widget'  => '</div>',
			'before_title'  => '<'. $sidebar_headings .' class="widget-title">',
			'after_title'   => '</'. $sidebar_headings .'>',
		) );

		// Pages Sidebar
		if ( get_theme_mod( 'pages_custom_sidebar', true ) ) {
			register_sidebar( array (
				'name'          => __( 'Pages Sidebar', 'wpex' ),
				'id'            => 'pages_sidebar',
				'before_widget' => '<div class="sidebar-box %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<'. $sidebar_headings .' class="widget-title">',
				'after_title'   => '</'. $sidebar_headings .'>',
			) );
		}

		// Search Results Sidebar
		if ( get_theme_mod( 'search_custom_sidebar', true ) ) {
			register_sidebar( array (
				'name'          => __( 'Search Results Sidebar', 'wpex' ),
				'id'            => 'search_sidebar',
				'before_widget' => '<div class="sidebar-box %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<'. $sidebar_headings .' class="widget-title">',
				'after_title'   => '</'. $sidebar_headings .'>',
			) );
		}

		// Testimonials Sidebar
		if ( post_type_exists( 'testimonials' ) && get_theme_mod( 'testimonials_custom_sidebar', true ) ) {
			$obj            = get_post_type_object( 'testimonials' );
			$post_type_name = $obj->labels->name;
			register_sidebar( array (
				'name'          => $post_type_name .' '. __( 'Sidebar', 'wpex' ),
				'id'            => 'testimonials_sidebar',
				'before_widget' => '<div class="sidebar-box %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<'. $sidebar_headings .' class="widget-title">',
				'after_title'   => '</'. $sidebar_headings .'>',
			) );
		}

		// bbPress Sidebar
		if ( WPEX_BBPRESS_ACTIVE && get_theme_mod( 'bbpress_custom_sidebar', true ) ) {
			register_sidebar( array (
				'name'          => __( 'bbPress Sidebar', 'wpex' ),
				'id'            => 'bbpress_sidebar',
				'before_widget' => '<div class="sidebar-box %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<'. $sidebar_headings .' class="widget-title">',
				'after_title'   => '</'. $sidebar_headings .'>',
			) );
		}

		// Footer Sidebars
		if ( get_theme_mod( 'footer_widgets', true ) ) {

			// Footer widget columns
			$footer_columns = get_theme_mod( 'footer_widgets_columns', '4' );
			
			// Footer 1
			register_sidebar( array (
				'name'          => __( 'Footer Column 1', 'wpex' ),
				'id'            => 'footer_one',
				'before_widget' => '<div class="footer-widget %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<'. $footer_headings .' class="widget-title">',
				'after_title'   => '</'. $footer_headings .'>',
			) );
			
			// Footer 2
			if ( $footer_columns > '1' ) {
				register_sidebar( array (
					'name'          => __( 'Footer Column 2', 'wpex' ),
					'id'            => 'footer_two',
					'before_widget' => '<div class="footer-widget %2$s clr">',
					'after_widget'  => '</div>',
					'before_title'  => '<'. $footer_headings .' class="widget-title">',
					'after_title'   => '</'. $footer_headings .'>'
				) );
			}
			
			// Footer 3
			if ( $footer_columns > '2' ) {
				register_sidebar( array (
					'name'          => __( 'Footer Column 3', 'wpex' ),
					'id'            => 'footer_three',
					'before_widget' => '<div class="footer-widget %2$s clr">',
					'after_widget'  => '</div>',
					'before_title'  => '<'. $footer_headings .' class="widget-title">',
					'after_title'   => '</'. $footer_headings .'>',
				) );
			}
			
			// Footer 4
			if ( $footer_columns > '3' ) {
				register_sidebar( array (
					'name'          => __( 'Footer Column 4', 'wpex' ),
					'id'            => 'footer_four',
					'before_widget' => '<div class="footer-widget %2$s clr">',
					'after_widget'  => '</div>',
					'before_title'  => '<'. $footer_headings .' class="widget-title">',
					'after_title'   => '</'. $footer_headings .'>',
				) );
			}

			// Footer 5
			if ( $footer_columns > '4' ) {
				register_sidebar( array (
					'name'          => __( 'Footer Column 5', 'wpex' ),
					'id'            => 'footer_five',
					'before_widget' => '<div class="footer-widget %2$s clr">',
					'after_widget'  => '</div>',
					'before_title'  => '<'. $footer_headings .' class="widget-title">',
					'after_title'   => '</'. $footer_headings .'>',
				) );
			}

		}

	}

	/**
	 * Defines the directory URI for the gallery metabox class.
	 *
	 * @since   1.6.3
	 * @access  public
	 *
	 * @var     string $url The directory url for the gallery metabox assets.
	 */
	public function gallery_metabox_dir_uri( $url ) {
		$url = WPEX_FRAMEWORK_DIR_URI .'classes/gallery-metabox/';
		return $url;
	}

	/**
	 * All theme functions hook into the wpex_head_css filter for this function.
	 * This way all dynamic CSS is minified and outputted in one location in the site header.
	 *
	 * @since   1.6.0
	 * @access  public
	 *
	 * @var     string $output Returns the CSS output for the wp_head.
	 */
	public function custom_css( $output = NULL ) {

		// Add filter for adding custom css via other functions
		$output = apply_filters( 'wpex_head_css', $output );

		// Minify and output CSS in the wp_head
		if ( ! empty( $output ) ) {
			$output = wpex_minify_css( $output );
			$output = "<!-- TOTAL CSS -->\n<style type=\"text/css\">\n" . $output . "\n</style>";
			echo $output;
		}

	}

	/**
	 * Alters the default WordPress tag cloud widget arguments.
	 * Makes sure all font sizes for the cloud widget are set to 1em.
	 *
	 * @since   1.6.0
	 * @access  public
	 *
	 * @link    https://developer.wordpress.org/reference/hooks/widget_tag_cloud_args/   
	 */
	public function widget_tag_cloud_args( $args ) {
		$args['largest']    = '0.923em';
		$args['smallest']   = '0.923em';
		$args['unit']       = 'em';
		return $args;
	}

	/**
	 * Alter wp list categories arguments.
	 * Adds a span around the counter for easier styling.
	 *
	 * @since   1.6.0
	 * @access  public
	 *
	 * @link    https://developer.wordpress.org/reference/functions/wp_list_categories/
	 */
	public function wp_list_categories_args( $links ) {
		$links  = str_replace( '</a> (', '</a> <span class="cat-count-span">(', $links );
		$links  = str_replace( ')', ')</span>', $links );
		return $links;
	}

	/**
	 * This function runs before the main query.
	 *
	 * @since   1.6.0
	 * @access  public
	 *
	 * @link    http://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts
	 */
	public function pre_get_posts( $query ) {

		// Lets not break stuff
		if ( is_admin() || ! $query->is_main_query() ) {
			return;
		}

		// Search pagination
		if ( is_search() ) {
			$query->set( 'posts_per_page', get_theme_mod( 'search_posts_per_page', '10' ) );
			return;
		}

		// Exclude categories from the main blog
		if ( ( is_home() || is_page_template( 'templates/blog.php' ) ) && function_exists( 'wpex_blog_exclude_categories' ) ) {
			wpex_blog_exclude_categories( false );
			return;
		}

		// Category pagination
		$terms = get_terms( 'category' );
		if ( ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				if ( is_category( $term->slug ) ) {
					$term_id    = $term->term_id;
					$term_data  = get_option( "category_$term_id" );
					if ( $term_data ) {
						if ( ! empty( $term_data['wpex_term_posts_per_page'] ) ) {
							$query->set( 'posts_per_page', $term_data['wpex_term_posts_per_page'] );
							return;
						}
					}
				}
			}
		}

	}

	/**
	 * Add new user fields
	 *
	 * @since   1.6.0
	 * @access  public
	 *
	 * @link    http://codex.wordpress.org/Plugin_API/Filter_Reference/user_contactmethods
	 */
	public function add_user_social_fields( $contactmethods ) {

		// Add Twitter
		if ( ! isset( $contactmethods['wpex_twitter'] ) ) {
			$contactmethods['wpex_twitter'] = WPEX_THEME_BRANDING .' - Twitter';
		}
		// Add Facebook
		if ( ! isset( $contactmethods['wpex_facebook'] ) ) {
			$contactmethods['wpex_facebook'] = WPEX_THEME_BRANDING .' - Facebook';
		}
		// Add GoglePlus
		if ( ! isset( $contactmethods['wpex_googleplus'] ) ) {
			$contactmethods['wpex_googleplus'] = WPEX_THEME_BRANDING .' - Google+';
		}
		// Add LinkedIn
		if ( ! isset( $contactmethods['wpex_linkedin'] ) ) {
			$contactmethods['wpex_linkedin'] = WPEX_THEME_BRANDING .' - LinkedIn';
		}
		// Add Pinterest
		if ( ! isset( $contactmethods['wpex_pinterest'] ) ) {
			$contactmethods['wpex_pinterest'] = WPEX_THEME_BRANDING .' - Pinterest';
		}
		// Add Pinterest
		if ( ! isset( $contactmethods['wpex_instagram'] ) ) {
			$contactmethods['wpex_instagram'] = WPEX_THEME_BRANDING .' - Instagram';
		}

		// Return contact methods
		return $contactmethods;

	}

	/**
	 * Alters the default oembed output.
	 * Adds special classes for responsive oembeds via CSS.
	 *
	 * @since   1.6.0
	 * @access  public
	 *
	 * @link    https://developer.wordpress.org/reference/hooks/embed_oembed_html/
	 */
	public function add_responsive_wrap_to_oembeds( $html, $url, $attr, $post_id ) {
		$html = '<div class="responsive-video-wrap entry-video">' . $html . '</div>';
		return $html;
	}

	/**
	 * The wp_get_attachment_url() function doesn't distinguish whether a page request arrives via HTTP or HTTPS.
	 * Using wp_get_attachment_url filter, we can fix this to avoid the dreaded mixed content browser warning
	 *
	 * @since   1.6.0
	 * @access  public
	 *
	 * @link    http://codex.wordpress.org/Plugin_API/Filter_Reference/wp_get_attachment_url
	 */
	public function honor_ssl_for_attachments( $url ) {
		$http       = site_url( FALSE, 'http' );
		$https      = site_url( FALSE, 'https' );
		$isSecure   = false;
		if ( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443 ) {
			$isSecure = true;
		}
		if ( $isSecure ) {
			return str_replace( $http, $https, $url );
		} else {
			return $url;
		}
	}

	/**
	 * Alters the default WordPress password protected form so it's easier to style
	 *
	 * @since   2.0.0
	 * @access  public
	 *
	 * @link    http://codex.wordpress.org/Using_Password_Protection
	 */
	public function custom_password_protected_form() {
		ob_start();
		include( locate_template( 'partials/password-protection-form.php' ) );
		return ob_get_clean();
	}


	/**
	 * Modify JOIN in the next/prev function
	 *
	 * @since   2.0.0
	 * @access  public
	 *
	 * @link    https://core.trac.wordpress.org/browser/tags/4.1.1/src/wp-includes/link-template.php
	 */
	public function prev_next_join( $join ) {
		global $wpdb;
		$join .= " LEFT JOIN $wpdb->postmeta AS m ON ( p.ID = m.post_id AND m.meta_key = 'wpex_post_link' )";
		return $join;
	}

	/**
	 * Modify WHERE in the next/prev function
	 *
	 * @since   2.0.0
	 * @access  public
	 *
	 * @link    https://core.trac.wordpress.org/browser/tags/4.1.1/src/wp-includes/link-template.php
	 */
	public function prev_next_where( $where ) {
		global $wpdb;
		$where .= " AND ( (m.meta_key = 'wpex_post_link' AND CAST(m.meta_value AS CHAR) = '') OR m.meta_id IS NULL ) ";
		return $where;
	}

	/**
	 * Alters the default WordPress password protected form so it's easier to style
	 *
	 * @since   2.0.0
	 * @access  public
	 *
	 * @link    http://codex.wordpress.org/Using_Password_Protection
	 */
	public function redirect_custom_links() {

		// Only needed for singular posts and pages
		if ( ! is_singular() ) {
			return;
		}

		// Get custom link
		if ( $custom_link = wpex_get_custom_permalink() ) {

			// If there is a custom link, redirect to it
			if ( $custom_link = esc_url( $custom_link ) ) {
				wp_redirect( $custom_link, 301 );
			}

		}

	}

}

/**
 * Run the theme setup class
 *
 * @since 1.6.3
 */
$wpex_theme_setup = new WPEX_Theme_Setup;
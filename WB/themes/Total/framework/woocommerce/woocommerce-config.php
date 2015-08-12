<?php
/**
 * Perform all main WooCommerce configurations for this theme
 *
 * @package     Total
 * @subpackage  Framework/WooCommerce
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.6.0
 * @version     2.0.0
 */

if ( ! class_exists( 'WPEX_WooCommerce_Config' ) ) {

    class WPEX_WooCommerce_Config {

        /**
         * Main Class Constructor.
         *
         * @since   2.0.0
         * @access  public
         */
        public function __construct() {

            // Include files
            add_action( 'after_setup_theme', array( &$this, 'includes' ) );

            // Run this actions on init
            add_action( 'init', array( &$this, 'init' ) );

            // Add image sizes
            add_filter( 'wpex_image_sizes', array( &$this, 'add_image_sizes' ), 99 );

            // Remove General Settings
            add_filter( 'woocommerce_general_settings', array( &$this, 'remove_general_settings' ) );

            // Remove product settings
            add_filter( 'woocommerce_product_settings', array( &$this, 'remove_product_settings' ) );

            // Add WooCommerce sidebar area
            if ( get_theme_mod( 'woo_custom_sidebar', true ) ) {
                add_filter( 'widgets_init', array( &$this, 'register_woo_sidebar' ) );
                add_filter( 'wpex_get_sidebar', array( &$this, 'display_woo_sidebar' ) );
            }

            // Configure the main title output
            add_filter( 'wpex_title', array( &$this, 'title_config' ) );

            // Show/Hide main page header
            add_filter( 'wpex_display_page_header', array( &$this, 'display_page_header' ) );

            // Tweak the post layout
            add_filter( 'wpex_post_layout_class', array( &$this, 'layouts' ) );

            // Make edits to WooCommerce scripts
            add_action( 'woocommerce_enqueue_styles', array( &$this, 'remove_styles' ) );
            add_action( 'wp_enqueue_scripts', array( &$this, 'remove_scripts' ) );
            add_action( 'wp_enqueue_scripts', array( &$this, 'add_custom_css' ) );

            // Alter default WooCommerce image sizes
            add_action( 'after_switch_theme', array( &$this, 'image_sizes' ) );

            // Remove shop title
            add_filter( 'woocommerce_show_page_title', array( &$this, 'remove_title' ) );

            // Change onsale text
            add_filter( 'woocommerce_sale_flash', array( &$this, 'onsale_text' ), 10, 3 );

            // Change products per page for the shop
            add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '. get_theme_mod( 'woo_shop_posts_per_page', '12' ) .';' ), 20 );

            // Change products per row
            add_filter( 'loop_shop_columns', array( &$this, 'loop_shop_columns' ) );

            // Add a new inner div to products
            add_filter( 'woocommerce_before_shop_loop_item', array( &$this, 'add_shop_loop_item_inner_div' ) );
            add_filter( 'woocommerce_after_shop_loop_item', array( &$this, 'close_shop_loop_item_inner_div' ) );

            // Clear floats for single product images and summary
            add_filter( 'woocommerce_after_single_product_summary', array( __class__, 'clear_product_images_summary_floats' ), 1 );

            // Add out-of-stock badge
            add_filter( 'woocommerce_before_shop_loop_item', array( &$this, 'add_shop_loop_item_out_of_stock_badge' ) );

            // Related product arguments
            add_filter( 'woocommerce_output_related_products_args', array( &$this, 'related_product_args' ) );

            // Tweak the pagination arguments
            add_filter( 'woocommerce_pagination_args', array( &$this, 'pagination_args' ) );

            // Change continue shopping link
            add_filter( 'woocommerce_continue_shopping_redirect', array( &$this, 'continue_shopping_redirect' ) );

            // Hooks into the wpex_has_post_slider function and returns true for the shop if a slider is defined via the customizer
            add_filter( 'wpex_has_post_slider', array( &$this, 'display_shop_slider' ) );

            // Shop slider shortcode
            add_filter( 'wpex_post_slider_shortcode', array( &$this, 'shop_slider_shortcode' ) );

            // Alter subheading on taxonomies
            add_filter( 'wpex_post_subheading', array( &$this, 'alter_subheadings' ) );

            // Add term description for Woo products above the loop if enabled
            add_filter( 'wpex_has_term_description_above_loop', array( &$this, 'term_description_above_loop' ) );

            // Add Social sharing to posts
            add_filter( 'wpex_has_social_share', array( &$this, 'post_social_share' ) );

            // Add social share to Woo Products
            add_filter( 'woocommerce_after_single_product_summary', array( __class__, 'social_share' ), 11 );

            // Adds classes to the product entry class
            add_filter( 'post_class', array( &$this, 'add_product_entry_classes' ) );

            // Changes add to cart text
            add_filter( 'woocommerce_product_single_add_to_cart_text', array( &$this, 'custom_single_add_to_cart_text' ) );

            // Single next/prev visibility
            add_filter( 'wpex_has_next_prev', array( &$this, 'next_prev' ) );
            
        }

        /**
         * Include WooCommerce files.
         *
         * @since   2.0.0
         * @access  public
         */
        public function includes() {

            // Helpers
            require_once( WPEX_FRAMEWORK_DIR .'woocommerce/woocommerce-helpers.php' );

            // WooCommerce menu icon and functions
            if ( get_theme_mod( 'woo_menu_icon', true ) ) {
                require_once( WPEX_FRAMEWORK_DIR .'woocommerce/menu-cart.php' );
                require_once( WPEX_FRAMEWORK_DIR .'woocommerce/cartwidget-overlay.php' );
                require_once( WPEX_FRAMEWORK_DIR .'woocommerce/cartwidget-dropdown.php' );
            }

        }

        /**
         * Runs on Init.
         * You can't remove certain actions in the constructor because it's too early.
         *
         * @since   2.0.0
         * @access  public
         */
        public function init() {

            // Remove category descriptions, these are added already by the theme
            remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
            
            // Alter cross-sells display
            remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
            add_action( 'woocommerce_cart_collaterals', array( &$this, 'cross_sell_display' ) );

            // Alter upsells display
            remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
            add_action( 'woocommerce_after_single_product_summary', array( &$this, 'upsell_display' ), 15 );

            // Alter WooCommerce category thumbnail
            remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
            add_action( 'woocommerce_before_subcategory_title', array( &$this, 'subcategory_thumbnail' ), 10 );

            // Remove loop product thumbnail function and add our own that pulls from template parts
            remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
            add_action( 'woocommerce_before_shop_loop_item_title', array( &$this, 'loop_product_thumbnail' ), 10 );

            // Remove coupon from checkout
            //remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

            // Remove single meta
            if ( ! get_theme_mod( 'woo_product_meta', true ) ) {
                remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
            }

            // Remove upsells if set to 0
            if ( '0' == get_theme_mod( 'woocommerce_upsells_count', '4' ) ) {
                remove_action( 'woocommerce_after_single_product_summary', 'wpex_woocommerce_output_upsells', 15 );
            }

            // Remove related products if count is set to 0
            if ( '0' == get_theme_mod( 'woocommerce_related_count', '4' ) ) {
                remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
            }

            // Remove crossells if set to 0
            if ( '0' == get_theme_mod( 'woocommerce_cross_sells_count', '4' ) ) {
                remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
            }

            // Remove result count if disabled
            if ( ! get_theme_mod( 'woo_shop_result_count', true ) ) {
                remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
            }

            // Remove orderby if disabled
            if ( ! get_theme_mod( 'woo_shop_sort', true ) ) {
                remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
            }

        }

        /**
         * Adds image sizes for WooCommerce to the image sizes panel.
         *
         * @since   2.0.0
         * @access  public
         */
        public function add_image_sizes( $sizes ) {
            $new_sizes  = array(
                'shop_catalog'  => array(
                    'label'     => __( 'Product Entry', 'wpex' ),
                    'width'     => 'woo_entry_width',
                    'height'    => 'woo_entry_height',
                    'crop'      => 'woo_entry_image_crop',
                ),
                'shop_single'   => array(
                    'label'     => __( 'Product Post', 'wpex' ),
                    'width'     => 'woo_post_width',
                    'height'    => 'woo_post_height',
                    'crop'      => 'woo_post_image_crop',
                ),
                'shop_category'    => array(
                    'label'     => __( 'Product Category Entry', 'wpex' ),
                    'width'     => 'woo_cat_entry_width',
                    'height'    => 'woo_cat_entry_height',
                    'crop'      => 'woo_cat_entry_image_crop',
                ),
            );
            $sizes = array_merge( $sizes, $new_sizes );
            return $sizes;
        }

        /**
         * Remove general settings from Woo Admin panel.
         *
         * @since   2.0.0
         * @access  public
         */
        public function remove_general_settings( $settings ) {
            $remove = array( 'woocommerce_enable_lightbox' );
            foreach( $settings as $key => $val ) {
                if ( isset( $val['id'] ) && in_array( $val['id'], $remove ) ) {
                    unset( $settings[$key] );
                }
            }
            return $settings;
        }

        /**
         * Remove product settings from Woo Admin panel.
         *
         * @since   2.0.0
         * @access  public
         */
        public function remove_product_settings( $settings ) {
            $remove = array(
                'image_options',
                'shop_catalog_image_size',
                'shop_single_image_size',
                'shop_thumbnail_image_size',
                'woocommerce_enable_lightbox'
            );
            foreach( $settings as $key => $val ) {
                if ( isset( $val['id'] ) && in_array( $val['id'], $remove ) ) {
                    unset( $settings[$key] );
                }
            }
            return $settings;
        }

        /**
         * Register new WooCommerce sidebar.
         *
         * @since   2.0.0
         * @access  public
         */
        public function register_woo_sidebar() {
            $headings   = get_theme_mod( 'sidebar_headings', 'div' );
            $headings   = $headings ? $headings : 'div';
            register_sidebar( array (
                'name'          => __( 'WooCommerce Sidebar', 'wpex' ),
                'id'            => 'woo_sidebar',
                'before_widget' => '<div class="sidebar-box %2$s clr">',
                'after_widget'  => '</div>',
                'before_title'  => '<'. $headings .' class="widget-title">',
                'after_title'   => '</'. $headings .'>',
            ) );
        }

        /**
         * Display WooCommerce sidebar.
         *
         * @since   2.0.0
         * @access  public
         */
        public function display_woo_sidebar( $sidebar ) {
            if ( is_woocommerce() && is_active_sidebar( 'woo_sidebar' ) ) {
                $sidebar = 'woo_sidebar';
            }
            return $sidebar;
        }

        /**
         * Returns correct title for WooCommerce pages.
         *
         * @since   2.0.0
         * @access  public
         */
        public function title_config( $title ) {

            // Shop title
            if ( is_shop() ) {
                $title = get_the_title( wc_get_page_id( 'shop' ) );
                $title = $title ? $title : $title = __( 'Shop', 'wpex' );
            }

            // Product title
            elseif ( is_product() ) {
                $title = get_theme_mod( 'woo_shop_single_title', __( 'Shop', 'wpex' ) );
                $title = $title ? $title : __( 'Shop', 'wpex' );
            }

            // Return title
            return $title;

        }

        /**
         * Hooks into the wpex_display_page_header and returns false if page header is disabled via the customizer.
         *
         * @since   2.0.0
         * @access  public
         */
        public function display_page_header( $return ) {
            if ( is_shop() && ! get_theme_mod( 'woo_shop_title', true ) ) {
                $return = false;
            }
            return $return;
        }

        /**
         * Tweaks the post layouts for WooCommerce archives and single product posts.
         *
         * @since   2.0.0
         * @access  public
         */
        public function layouts( $class ) {
            if ( wpex_is_woo_shop() ) {
                $class = get_theme_mod( 'woo_shop_layout', 'full-width' );
            } elseif ( wpex_is_woo_tax() ) {
                $class = get_theme_mod( 'woo_shop_layout', 'full-width' );
            } elseif ( wpex_is_woo_single() ) {
                $class = get_theme_mod( 'woo_product_layout', 'full-width' );
            }
            return $class;
        }

        /**
         * Remove WooCommerce styles not needed for this theme.
         *
         * @since   2.0.0
         * @access  public
         *
         * @link    http://docs.woothemes.com/document/disable-the-default-stylesheet/
         */
        public function remove_styles( $enqueue_styles ) {

            unset( $enqueue_styles['woocommerce-layout'] );
            unset( $enqueue_styles['woocommerce_prettyPhoto_css'] );
            return $enqueue_styles;

        }

        /**
         * Remove WooCommerce scripts.
         *
         *
         * @since   2.0.0
         * @access  public
         */
        public function remove_scripts() {

            wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
            wp_dequeue_script( 'prettyPhoto' );
            wp_dequeue_script( 'prettyPhoto-init' );
            
        }

        /**
         * Add Custom WooCommerce CSS.
         *
         *
         * @since   2.0.0
         * @access  public
         */
        public function add_custom_css() {

            // General WooCommerce Custom CSS
            wp_enqueue_style( 'wpex-woocommerce', WPEX_CSS_DIR_URI .'wpex-woocommerce.css' );

            // WooCommerce Responsiveness
            if ( wpex_is_responsive() ) {
                wp_enqueue_style( 'wpex-woocommerce-responsive', WPEX_CSS_DIR_URI .'wpex-woocommerce-responsive.css', array( 'wpex-woocommerce' ) );
            }

        }

        /**
         * Edit Default image sizes.
         *
         * @since   2.0.0
         * @access  public
         */
        public function image_sizes() {
            
            update_option( 'shop_catalog_image_size', array(
                'width'     => '9999',
                'height'    => '9999',
                'crop'      => 0
            ) );

            update_option( 'shop_single_image_size', array(
                'width'     => '9999',
                'height'    => '9999',
                'crop'      => 0
            ) );

            update_option( 'shop_thumbnail_image_size', array(
                'width'     => '9999',
                'height'    => '9999',
                'crop'      => 1
            ) );

        }

        /**
         * Remove shop title.
         *
         * @since   2.0.0
         * @access  public
         */
        public function remove_title() {
            return false;
        }

        /**
         * Change onsale text.
         *
         * @since   2.0.0
         * @access  public
         */
        public function onsale_text( $text, $post, $_product ) {
            return '<span class="onsale">'. __( 'Sale', 'wpex' ) .'</span>';
        }

        /**
         * Change products per row for the main shop.
         *
         * @since   2.0.0
         * @access  public
         */
        public function loop_shop_columns() {
            return get_theme_mod( 'woocommerce_shop_columns', '4' );
        }

        /**
         * Change products per row for upsells.
         *
         * @since   2.0.0
         * @access  public
         */
        public function upsell_display() {
            woocommerce_upsell_display(
                get_theme_mod( 'woocommerce_upsells_count', '4' ),
                get_theme_mod( 'woocommerce_upsells_columns', '4' )
            );
        }

        /**
         * Change products per row for crossells.
         *
         * @since   2.0.0
         * @access  public
         */
        public function cross_sell_display() {
            woocommerce_cross_sell_display(
                get_theme_mod( 'woocommerce_cross_sells_count', '2' ),
                get_theme_mod( 'woocommerce_cross_sells_columns', '2' )
            );
        }

        /**
         * Change category thumbnail.
         *
         * @since   2.0.0
         * @access  public
         */
        public function subcategory_thumbnail( $category ) {

            // Get attachment id
            $attachment = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );

            // Return thumbnail if attachment is defined
            if ( $attachment ) {

                wpex_post_thumbnail( array(
                    'attachment'    => $attachment,
                    'size'          => 'shop_category',
                    'alt'           => wpex_get_esc_title(),
                ) );

            }

            // Display placeholder
            else {

                echo '<img src="'. wc_placeholder_img_src() .'" alt="'. __( 'Placeholder Image', 'wpex' ) .'" />';

            }

        }

        /**
         * Alter the related product arguments.
         *
         * @since   2.0.0
         * @access  public
         */
        public function related_product_args() {
            global $product, $orderby, $related;
            $args = array(
                'posts_per_page'    => get_theme_mod( 'woocommerce_related_count', '4' ),
                'columns'           => get_theme_mod( 'woocommerce_related_columns', '4' ),
            );
            return $args;
        }

        /**
         * Adds an opening div "product-inner" around product entries.
         *
         * @since   2.0.0
         * @access  public
         */
        public function add_shop_loop_item_inner_div() {
            echo '<div class="product-inner clr">';
        }

        /**
         * Closes the "product-inner" div around product entries.
         *
         * @since   2.0.0
         * @access  public
         */
        public function close_shop_loop_item_inner_div() {
            echo '</div><!-- .product-inner .clr -->';
        }

        /**
         * Clearfloats after single product summary.
         *
         * @since   2.0.0
         * @access  public
         */
        public static function clear_product_images_summary_floats() {
            echo '<div class="clear"></div>';
        }

        /**
         * Adds an out of stock tag to the products.
         *
         * @since   2.0.0
         * @access  public
         */
        public function add_shop_loop_item_out_of_stock_badge() {
            if ( function_exists( 'wpex_woo_product_instock' ) && ! wpex_woo_product_instock() ) { ?>
                <div class="outofstock-badge">
                    <?php echo apply_filters( 'wpex_woo_outofstock_text', __( 'Out of Stock', 'wpex' ) ); ?>
                </div><!-- .product-entry-out-of-stock-badge -->
            <?php }
        }

        /**
         * Returns our product thumbnail from our template parts based on selected style in theme mods.
         *
         * @since   2.0.0
         * @access  public
         */
        public function loop_product_thumbnail() {
            if ( function_exists( 'wc_get_template' ) ) {
                $style = get_theme_mod( 'woo_product_entry_style', 'image-swap' );
                wc_get_template(  'loop/thumbnail/'. $style .'.php' );
            }
        }

        /**
         * Tweaks pagination arguments.
         *
         * @since   2.0.0
         * @access  public
         */
        public function pagination_args( $args ) {
            $args['prev_text']  = '<i class="fa fa-angle-left"></i>';
            $args['next_text']  = '<i class="fa fa-angle-right"></i>';
            return $args;
        }

        /**
         * Alter continue shoping URL.
         *
         * @since   2.0.0
         * @access  public
         */
        public function continue_shopping_redirect( $return_to ) {
            $shop_id = woocommerce_get_page_id( 'shop' );
            if ( function_exists( 'icl_object_id' ) ) {
                $shop_id = icl_object_id( $shop_id, 'page' );
            }
            if ( $shop_id ) {
                $return_to = get_permalink( $shop_id );
            }
            return $return_to;
        }

        /**
         * Hooks into the wpex_has_post_slider function and returns true for the shop if
         * a slider is defined via the customizer.
         *
         * @since   2.0.0
         * @access  public
         */
        public function display_shop_slider( $return ) {
            if ( is_shop() && get_theme_mod( 'woo_shop_slider' ) ) {
                $return = true;
            }
            return $return;
        }

        /**
         * The shop post slider
         *
         * @since   2.0.0
         * @access  public
         * @see     wpex_post_slider_shortcode()
         */
        public function shop_slider_shortcode( $slider ) {
            if ( is_shop() && ! $slider ) {
                $slider = get_theme_mod( 'woo_shop_slider' );
            }
            return $slider;
        }

        /**
         * Alters subheading for the shop.
         *
         * @since   2.0.0
         * @access  public
         */
        public function alter_subheadings( $subheading ) {

            // Woo Taxonomies
            if ( wpex_is_woo_tax() ) {
                if ( 'under_title' == get_theme_mod( 'woo_category_description_position', 'under_title' ) ) {
                    $subheading = term_description();
                } else {
                    $subheading = NULL;
                }
            }

            // Orderby, search...etc
            if ( is_shop() ) {
                if ( ! empty( $_GET['s'] ) ) {
                    $subheading = __( 'Search results for:', 'wpex' ) .' <span>&quot;'. $_GET['s'] .'&quot;</span>';
                }
            }

            // Return subheading
            return $subheading;

        }

        /**
         * Alters subheading for the shop.
         *
         * @since   2.0.0
         * @access  public
         */
        public function term_description_above_loop( $return ) {

            // Check if enabled
            if ( wpex_is_woo_tax() && 'above_loop' == get_theme_mod( 'woo_category_description_position' ) ) {
                return true;
            }

            // Return bool
            return $return;

        }

        /**
         * Enable post social share if enabled.
         *
         * @since   2.0.0
         * @access  public
         */
        public function post_social_share( $return ) {
            if ( is_singular( 'product' ) && get_theme_mod( 'social_share_woo', false ) ) {
                $return = true;
            }
            return $return;
        }

        /**
         * Adds social sharing to the bottom of the posts
         *
         * @since   2.0.0
         * @access  public
         * @return  bool
         */
        public static function social_share() {
            wpex_social_share();
        }

        /**
         * Add classes to WooCommerce product entries.
         *
         * @since   2.0.0
         * @access  public
         *
         * @link    http://codex.wordpress.org/Function_Reference/post_class
         */
        public function add_product_entry_classes( $classes ) {
            global $product, $woocommerce_loop;
            if ( $product && $woocommerce_loop ) {
                $classes[] = 'col';
                $classes[] = wpex_grid_class( $woocommerce_loop['columns'] );
            }
            return $classes;
        }

        /**
         * Add classes to WooCommerce product entries.
         *
         * @since   2.0.0
         * @access  public
         *
         * @link    http://docs.woothemes.com/document/change-add-to-cart-button-text/
         */
        public function custom_single_add_to_cart_text() {
            return __( 'Add To Cart', 'wpex' ) .'<span class="fa fa-chevron-right"></span>';
        }

        /**
         * Disables the next/previous links if disabled via the customizer.
         *
         * @since   2.0.0
         * @access  public
         * @return  bool
         */
        public function next_prev( $return ) {
            if ( is_woocommerce() && is_singular( 'product' ) && ! get_theme_mod( 'woo_next_prev', true ) ) {
                $return = false;
            }
            return $return;
        }

    }

}
$wpex_woocommerce_config = new WPEX_WooCommerce_Config();
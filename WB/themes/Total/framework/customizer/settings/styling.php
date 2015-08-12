<?php
/**
 * This class adds styling (color) options to the WordPress
 * Theme Customizer and outputs the needed CSS to the header
 * 
 * @package     Total
 * @subpackage  Customizer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.6.0
 * @version     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPEX_Theme_Customizer_Styling' ) ) {
    class WPEX_Theme_Customizer_Styling {

        /*-----------------------------------------------------------------------------------*/
        /*  - Constructor
        /*-----------------------------------------------------------------------------------*/
        public function __construct() {

            // Register settings
            add_action( 'customize_register', array( $this , 'register' ) );

            // Reset CSS cache when the customizer is saved
            add_action( 'customize_save_after', array( $this, 'reset_cache' ) );

            // Add custom CSS to the wp_head via the wpex_head_css filter
            add_action( 'wpex_head_css' , array( $this, 'header_output' ), 40 );

            // Clear cache based on GET variable
            if ( ! empty( $_GET['clear_css_cache'] ) ) {
                $this->reset_cache();
            }

        }

        /**
         * Defines the array of styling options
         *
         * @since   2.0.0
         * @access  public
         * @var     array $array An array of styling options to loop through.
         */
        public function styling_options() {

            $array = array();

            /*-----------------------------------------------------*/
            /*  - Layouts
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'            => 'boxed_padding',
                'type'          => 'text',
                'label'         => __( 'Boxed Layout Padding', 'wpex' ),
                'element'       => '.boxed-main-layout #outer-wrap',
                'style'         => 'padding',
                'section'       => 'wpex_layout_boxed',
                'description'   => __( 'Default:', 'wpex' ) .' 40px 30px',
                'transport'     => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Toggle Bar
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'        => 'toggle_bar_bg',
                'type'      => 'color',
                'label'     => __( 'Content Background', 'wpex' ),
                'element'   => '#toggle-bar-wrap',
                'style'     => 'background-color',
                'section'   => 'wpex_togglebar_styling',
            );
            $array[] = array(
                'id'        => 'toggle_bar_color',
                'type'      => 'color',
                'label'     => __( 'Content Color', 'wpex' ),
                'element'   => '#toggle-bar-wrap, #toggle-bar-wrap strong',
                'style'     => 'color',
                'section'   => 'wpex_togglebar_styling',
            );

            // Toggle bar button
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_togglebar_styling',
            );
            $array[] = array(
                'id'        => 'toggle_bar_btn_bg',
                'transport' => 'refresh',
                'type'      => 'color',
                'label'     => __( 'Button Background', 'wpex' ),
                'element'   => '.toggle-bar-btn',
                'style'     => array( 'border-top-color', 'border-right-color' ),
                'section'   => 'wpex_togglebar_styling',
            );
            $array[] = array(
                'id'        => 'toggle_bar_btn_color',
                'type'      => 'color',
                'label'     => __( 'Button Color', 'wpex' ),
                'element'   => '.toggle-bar-btn span.fa',
                'style'     => 'color',
                'section'   => 'wpex_togglebar_styling',
            );
            $array[] = array(
                'id'        => 'toggle_bar_btn_hover_bg',
                'type'      => 'color',
                'label'     => __( 'Button Hover Background', 'wpex' ),
                'element'   => '.toggle-bar-btn:hover',
                'style'     => array( 'border-top-color', 'border-right-color' ),
                'section'   => 'wpex_togglebar_styling',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'toggle_bar_btn_hover_color',
                'type'      => 'color',
                'label'     => __( 'Button Hover Color', 'wpex' ),
                'element'   => '.toggle-bar-btn:hover span.fa',
                'style'     => 'color',
                'section'   => 'wpex_togglebar_styling',
                'transport' => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Top Bar
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'        => 'top_bar_bg',
                'type'      => 'color',
                'label'     => __( 'Background', 'wpex' ),
                'element'   => '#top-bar-wrap',
                'style'     => 'background-color',
                'section'   => 'wpex_topbar_styling',
            );
            $array[] = array(
                'id'        => 'top_bar_border',
                'type'      => 'color',
                'label'     => __( 'Borders', 'wpex' ),
                'element'   => '#top-bar-wrap',
                'style'     => 'border-color',
                'section'   => 'wpex_topbar_styling',
            );
            $array[] = array(
                'id'        => 'top_bar_text',
                'type'      => 'color',
                'label'     => __( 'Color', 'wpex' ),
                'element'   => '#top-bar-wrap, #top-bar-content strong',
                'style'     => 'color',
                'section'   => 'wpex_topbar_styling',
            );

            // Top bar link colors
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_topbar_styling',
            );
            $array[] = array(
                'id'        => 'top_bar_link_color',
                'type'      => 'color',
                'label'     => __( 'Link Color', 'wpex' ),
                'element'   => '#top-bar-content a, #top-bar-social-alt a',
                'style'     => 'color',
                'section'   => 'wpex_topbar_styling',
            );
            $array[] = array(
                'id'        => 'top_bar_link_color_hover',
                'type'      => 'color',
                'label'     => __( 'Link Color: Hover', 'wpex' ),
                'element'   => '#top-bar-content a:hover, #top-bar-social-alt a:hover',
                'style'     => 'color',
                'section'   => 'wpex_topbar_styling',
                'transport' => 'refresh',
            );

            // Top bar social
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_topbar_styling',
            );
            $array[] = array(
                'id'        => 'top_bar_social_color',
                'type'      => 'color',
                'label'     => __( 'Social Links Color', 'wpex' ),
                'element'   => '#top-bar-social a',
                'style'     => 'color',
                'section'   => 'wpex_topbar_styling',
            );
            $array[] = array(
                'id'        => 'top_bar_social_hover_color',
                'type'      => 'color',
                'label'     => __( 'Social Links Hover Color', 'wpex' ),
                'element'   => '#top-bar-social a:hover',
                'style'     => 'color',
                'section'   => 'wpex_topbar_styling',
                'transport' => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Header
            /*-----------------------------------------------------*/

            $array[] = array(
                'id'        => 'header_top_padding',
                'type'      => 'text',
                'label'     => __( 'Header Top Padding', 'wpex' ), 
                'element'   => '#site-header-inner',
                'style'     => 'padding-top',
                'section'   => 'wpex_header_styling',
                'sanitize'  => 'px',
                'transport' => 'refresh',
            );

            $array[] = array(
                'id'            => 'header_bottom_padding',
                'type'          => 'text',
                'label'         => __( 'Header Bottom Padding', 'wpex' ), 
                'element'       => '#site-header-inner',
                'style'         => 'padding-bottom',
                'section'       => 'wpex_header_styling',
                'sanitize'      => 'px',
                'transport'     => 'refresh',
            );

            // Logo Colors
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_header_styling',
            );
            $array[] = array(
                'id'        => 'header_background',
                'type'      => 'color',
                'label'     => __( 'Header Background Color', 'wpex' ), 
                'element'   => '#site-header, .footer-has-reveal #site-header, #searchform-header-replace, .is-sticky #site-header',
                'style'     => 'background-color',
                'section'   => 'wpex_header_styling',
            );
            $array[] = array(
                'id'        => 'logo_color',
                'type'      => 'color',
                'label'     => __( 'Logo Color', 'wpex' ), 
                'element'   => '#site-logo a',
                'style'     => 'color',
                'section'   => 'wpex_header_styling',
            );
            $array[] = array(
                'id'        => 'logo_hover_color',
                'type'      => 'color',
                'label'     => __( 'Logo Hover Color', 'wpex' ), 
                'element'   => '#site-logo a:hover',
                'style'     => 'color',
                'section'   => 'wpex_header_styling',
                'transport' => 'refresh',
            );

            // Logo Icon
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_header_styling',
            );
            $array[] = array(
                'id'        => 'logo_icon_color',
                'type'      => 'color',
                'label'     => __( 'Text Logo Icon Color', 'wpex' ),
                'element'   => '#site-logo a .fa',
                'style'     => 'color',
                'section'   => 'wpex_header_styling',
            );
            $array[] = array(
                'id'        => 'logo_icon_right_margin',
                'type'      => 'text',
                'label'     => __( 'Text Logo Icon Right Margin', 'wpex' ),
                'element'   => '#site-logo a .fa',
                'style'     => 'margin-right',
                'section'   => 'wpex_header_styling',
                'sanitize'  => 'px',
                'transport' => 'refresh',
            );

            // Header Search
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_header_styling',
            );
            $array[] = array(
                'id'        => 'search_dropdown_top_border',
                'type'      => 'color',
                'label'     => __( 'Search Dropdown Top Border', 'wpex' ),
                'element'   => '#searchform-dropdown',
                'style'     => 'border-top-color',
                'section'   => 'wpex_header_styling',
            );
            $array[] = array(
                'id'        => 'main_search_overlay_top_margin',
                'type'      => 'text',
                'label'     => __( 'Search Overlay Top Margin', 'wpex' ),
                'element'   => '#searchform-overlay',
                'style'     => 'top',
                'section'   => 'wpex_header_styling',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'search_button_color',
                'type'      => 'color',
                'label'     => __( 'Search Button Color', 'wpex' ), 
                'element'   => '#site-header .site-search-toggle, #site-header .site-search-toggle:hover, #site-header .site-search-toggle:active, body #header-two-search #header-two-search-submit',
                'style'     => 'color',
                'section'   => 'wpex_header_styling',
                'important' => true,
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'search_button_background',
                'type'      => 'color',
                'label'     => __( 'Search Button Background', 'wpex' ),
                'element'   => '#site-header .site-search-toggle, #site-header .site-search-toggle:hover, #site-header .site-search-toggle:active, body #header-two-search #header-two-search-submit',
                'style'     => 'background',
                'section'   => 'wpex_header_styling',
                'transport' => 'refresh',
            );

            // Fixed Header Opacity
            $array[] = array(
                'id'            => 'fixed_header_opacity',
                'type'          => 'text',
                'label'         => __( 'Fixed header Opacity', 'wpex' ),
                'element'       => '.is-sticky #site-header, #site-header.overlay-header.is-sticky',
                'style'         => 'opacity',
                'section'       => 'wpex_header_fixed',
                'description'   =>  __( 'Enter a value from 0-1', 'wpex' ),
                'sanitize'      => 'intval',
                'transport'     => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Menu
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'        => 'menu_background',
                'type'      => 'color',
                'label'     => __( 'Background', 'wpex' ), 
                'element'   => '#site-navigation-wrap, .is-sticky .fixed-nav',
                'style'     => 'background-color',
                'section'   => 'wpex_main_menu_styling',
            );
            $array[] = array(
                'id'            => 'menu_borders',
                'type'          => 'color',
                'label'         => __( 'Borders', 'wpex' ), 
                'element'       => '#site-navigation li, #site-navigation a,
                                    #site-navigation ul, #site-navigation-wrap',
                'style'         => 'border-color',
                'section'       => 'wpex_main_menu_styling',
                'description'   => __( 'Not all menus have borders, but this setting is for those that do', 'wpex' ),
            );

            // Menu Link Colors
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_main_menu_styling',
            );
            $array[] = array(
                'id'        => 'menu_link_color',
                'type'      => 'link_color',
                'label'     => __( 'Link Color', 'wpex' ),
                'element'   => '#site-navigation .dropdown-menu > li > a',
                'style'     => 'color',
                'section'   => 'wpex_main_menu_styling',
            );
            $array[] = array(
                'id'        => 'menu_link_color_hover',
                'type'      => 'link_color',
                'label'     => __( 'Link Color: Hover', 'wpex' ),
                'element'   => '#site-navigation .dropdown-menu > li > a:hover',
                'style'     => 'color',
                'section'   => 'wpex_main_menu_styling',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'menu_link_color_active',
                'type'      => 'link_color',
                'label'     => __( 'Link Color: Current Menu Item', 'wpex' ),
                'element'   => '#site-navigation .dropdown-menu > .current-menu-item > a,
                                #site-navigation .dropdown-menu > .current-menu-parent > a,
                                #site-navigation .dropdown-menu > .current-menu-item > a:hover,
                                #site-navigation .dropdown-menu > .current-menu-parent > a:hover',
                'style'     => 'color',
                'section'   => 'wpex_main_menu_styling',
                'transport' => 'refresh',
            );

            // Link Background
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_main_menu_styling',
            );
            $array[] = array(
                'id'        => 'menu_link_background',
                'type'      => 'color',
                'label'     => __( 'Link Background', 'wpex' ),
                'element'   => '#site-navigation .dropdown-menu > li > a',
                'style'     => 'background-color',
                'section'   => 'wpex_main_menu_styling',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'menu_link_hover_background',
                'type'      => 'color',
                'label'     => __( 'Link Background: Hover', 'wpex' ),
                'element'   => '#site-navigation .dropdown-menu > li > a:hover',
                'style'     => 'background-color',
                'section'   => 'wpex_main_menu_styling',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'menu_link_active_background',
                'type'      => 'color',
                'label'     => __( 'Link Background: Current Menu Item', 'wpex' ),
                'element'   => '#site-navigation .dropdown-menu > .current-menu-item > a,
                                #site-navigation .dropdown-menu > .current-menu-parent > a,
                                #site-navigation .dropdown-menu > .current-menu-item > a:hover,
                                #site-navigation .dropdown-menu > .current-menu-parent > a:hover',
                'style'     => 'background-color',
                'section'   => 'wpex_main_menu_styling',
            );

            // Link Inner
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_main_menu_styling',
            );
            $array[] = array(
                'id'        => 'menu_link_span_background',
                'type'      => 'color',
                'label'     => __( 'Link Inner Background', 'wpex' ),
                'element'   => '#site-navigation .dropdown-menu > li > a > span.link-inner',
                'style'     => 'background-color',
                'section'   => 'wpex_main_menu_styling',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'menu_link_span_hover_background',
                'type'      => 'color',
                'label'     => __( 'Link Inner Background: Hover', 'wpex' ),
                'element'   => '#site-navigation .dropdown-menu > li > a:hover > span.link-inner',
                'style'     => 'background-color',
                'section'   => 'wpex_main_menu_styling',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'menu_link_span_active_background',
                'type'      => 'color',
                'label'     => __( 'Link Inner Background: Current Menu Item', 'wpex' ),
                'element'   => '#site-navigation .dropdown-menu > .current-menu-item > a > span.link-inner,
                                #site-navigation .dropdown-menu > .current-menu-parent > a > span.link-inner,
                                #site-navigation .dropdown-menu > .current-menu-item > a:hover > span.link-inner,
                                #site-navigation .dropdown-menu > .current-menu-parent > a:hover > span.link-inner',
                'style'     => 'background-color',
                'section'   => 'wpex_main_menu_styling',
                'transport' => 'refresh',
            );

            // Menu Dropdowns
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_main_menu_styling',
            );
            $array[] = array(
                'id'        => 'dropdown_menu_background',
                'type'      => 'color',
                'label'     => __( 'Dropdowns Background', 'wpex' ), 
                'element'   => '#site-navigation .dropdown-menu ul',
                'style'     => 'background-color',
                'section'   => 'wpex_main_menu_styling',
            );
            $array[] = array(
                'id'        => 'dropdown_menu_pointer_bg',
                'type'      => 'color',
                'label'     => __( 'Dropdowns Pointer Background', 'wpex' ), 
                'element'   => '.navbar-style-one .dropdown-menu ul:after',
                'style'     => 'border-bottom-color',
                'section'   => 'wpex_main_menu_styling',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'dropdown_menu_pointer_border',
                'type'      => 'color',
                'label'     => __( 'Dropdowns Pointer Border', 'wpex' ), 
                'element'   => '.navbar-style-one .dropdown-menu ul:before',
                'style'     => 'border-bottom-color',
                'section'   => 'wpex_main_menu_styling',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'            => 'menu_dropdown_top_border_color',
                'type'          => 'color',
                'label'         => __( 'Dropdowns Top Border', 'wpex' ), 
                'element'       => 'body #site-navigation-wrap.nav-dropdown-top-border .dropdown-menu > li > ul',
                'style'         => 'border-top-color',
                'section'       => 'wpex_main_menu_styling',
                'description'   => __( 'Used only if "Top Border" is enabled in the Menu "General" settings.', 'wpex' ),
            );
            $array[] = array(
                'id'        => 'dropdown_menu_borders',
                'type'      => 'color',
                'label'     => __( 'Menu Dropdown Borders', 'wpex' ), 
                'element'   => '#site-navigation .dropdown-menu ul, #site-navigation .dropdown-menu ul li, #site-navigation .dropdown-menu ul li a',
                'style'     => 'border-color',
                'section'   => 'wpex_main_menu_styling',
            );
            $array[] = array(
                'id'        => 'dropdown_menu_link_color',
                'type'      => 'link_color',
                'label'     => __( 'Dropdown Link Color', 'wpex' ),
                'element'   => '#site-navigation .dropdown-menu ul > li > a',
                'style'     => 'color',
                'section'   => 'wpex_main_menu_styling',
            );
            $array[] = array(
                'id'        => 'dropdown_menu_link_color_hover',
                'type'      => 'link_color',
                'label'     => __( 'Dropdown Link Color: Hover', 'wpex' ),
                'element'   => '#site-navigation .dropdown-menu ul > li > a:hover',
                'style'     => 'color',
                'section'   => 'wpex_main_menu_styling',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'dropdown_menu_link_color_active',
                'type'      => 'link_color',
                'label'     => __( 'Dropdown Link Color: Current Menu Item', 'wpex' ),
                'element'   => '#site-navigation .dropdown-menu ul > .current-menu-item > a',
                'style'     => 'color',
                'section'   => 'wpex_main_menu_styling',
            );
            $array[] = array(
                'id'        => 'dropdown_menu_link_hover_bg',
                'type'      => 'color_gradient',
                'label'     => __( 'Dropdown Link Background: Hover', 'wpex' ), 
                'subtitle'  => __( 'Select your custom hex color.', 'wpex' ),
                'element'   => '#site-navigation .dropdown-menu ul > li > a:hover',
                'style'     => 'background-color',
                'section'   => 'wpex_main_menu_styling',
                'transport' => 'refresh',
            );

            // Menu Megamenu
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_main_menu_styling',
            );
            $array[] = array(
                'id'        => 'mega_menu_title',
                'type'      => 'color',
                'label'     => __( 'Megamenu Subtitle Color', 'wpex' ), 
                'element'   => '.sf-menu > li.megamenu > ul.sub-menu > .menu-item-has-children > a',
                'style'     => 'color',
                'section'   => 'wpex_main_menu_styling',
            );

            /*-----------------------------------------------------*/
            /*  - Mobile Icons
            /*-----------------------------------------------------*/

            $array[] = array(
                'id'        => 'mobile_menu_icon_size',
                'type'      => 'text',
                'label'     => __( 'Font Size', 'wpex' ),
                'element'   => '#mobile-menu a',
                'style'     => 'font-size',
                'sanitize'  => 'px',
                'section'   => 'wpex_mobile_menu_icons_styling',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'mobile_menu_icon_color',
                'type'      => 'color',
                'label'     => __( 'Color', 'wpex' ),
                'element'   => '#mobile-menu a',
                'style'     => 'color',
                'section'   => 'wpex_mobile_menu_icons_styling',
            );
            $array[] = array(
                'id'        => 'mobile_menu_icon_color_hover',
                'type'      => 'color',
                'label'     => __( 'Color: Hover', 'wpex' ),
                'element'   => '#mobile-menu a:hover',
                'style'     => 'color',
                'section'   => 'wpex_mobile_menu_icons_styling',
                'transport' => 'refresh',
            );

            // Icons Menu BG
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_mobile_menu_icons_styling',
            );

            $array[] = array(
                'id'        => 'mobile_menu_icon_background',
                'type'      => 'color',
                'label'     => __( 'Background', 'wpex' ),
                'element'   => '#mobile-menu a',
                'style'     => 'background-color',
                'section'   => 'wpex_mobile_menu_icons_styling',
            );

            $array[] = array(
                'id'        => 'mobile_menu_icon_background_hover',
                'type'      => 'color',
                'label'     => __( 'Background: Hover', 'wpex' ),
                'element'   => '#mobile-menu a:hover',
                'style'     => 'background-color',
                'section'   => 'wpex_mobile_menu_icons_styling',
                'transport' => 'refresh',
            );

            // Icons Menu Border
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_mobile_menu_icons_styling',
            );

            $array[] = array(
                'id'        => 'mobile_menu_icon_border',
                'type'      => 'color',
                'label'     => __( 'Border', 'wpex' ),
                'element'   => '#mobile-menu a',
                'style'     => 'border-color',
                'section'   => 'wpex_mobile_menu_icons_styling',
            );

            $array[] = array(
                'id'        => 'mobile_menu_icon_border_hover',
                'type'      => 'color',
                'label'     => __( 'Border: Hover', 'wpex' ),
                'element'   => '#mobile-menu a:hover',
                'style'     => 'border-color',
                'section'   => 'wpex_mobile_menu_icons_styling',
                'transport' => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Sidr Menu
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'        => 'mobile_menu_sidr_background',
                'type'      => 'color',
                'label'     => __( 'Background', 'wpex' ),
                'element'   => '#sidr-main',
                'style'     => 'background-color',
                'section'   => 'wpex_sidr_styling',
            );
            $array[] = array(
                'id'        => 'mobile_menu_sidr_borders',
                'type'      => 'color',
                'label'     => __( 'Borders', 'wpex' ),
                'element'   => '#sidr-main li, #sidr-main ul',
                'style'     => 'border-color',
                'section'   => 'wpex_sidr_styling',
            );

            // Sidr Links
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_sidr_styling',
            );
            $array[] = array(
                'id'        => 'mobile_menu_links',
                'type'      => 'color',
                'label'     => __( 'Links', 'wpex' ),
                'element'   => '.sidr a, .sidr-class-dropdown-toggle',
                'style'     => 'color',
                'section'   => 'wpex_sidr_styling',
            );
            $array[] = array(
                'id'        => 'mobile_menu_links_hover',
                'type'      => 'color',
                'label'     => __( 'Links: Hover', 'wpex' ),
                'element'   => '.sidr a:hover, .sidr-class-dropdown-toggle:hover, .sidr-class-dropdown-toggle .fa, .sidr-class-menu-item-has-children.active > a, .sidr-class-menu-item-has-children.active > a > .sidr-class-dropdown-toggle',
                'style'     => 'color',
                'section'   => 'wpex_sidr_styling',
                'transport' => 'refresh',
            );

            // Sidr Search
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_sidr_styling',
            );
            $array[] = array(
                'id'        => 'mobile_menu_sidr_search_color',
                'type'      => 'color',
                'label'     => __( 'Searchbar Color', 'wpex' ),
                'element'   => '.sidr-class-mobile-menu-searchform input',
                'style'     => 'color',
                'section'   => 'wpex_sidr_styling',
            );
            $array[] = array(
                'id'        => 'mobile_menu_sidr_search_bg',
                'type'      => 'color',
                'label'     => __( 'Searchbar Background', 'wpex' ),
                'element'   => '.sidr-class-mobile-menu-searchform input',
                'style'     => 'background-color',
                'section'   => 'wpex_sidr_styling',
            );

            /*-----------------------------------------------------*/
            /*  - Toggle Menu
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'        => 'toggle_mobile_menu_background',
                'type'      => 'color',
                'label'     => __( 'Background', 'wpex' ),
                'element'   => '.mobile-toggle-nav',
                'style'     => 'background-color',
                'section'   => 'wpex_toggle_mobile_menu_styling',
            );
            $array[] = array(
                'id'        => 'toggle_mobile_menu_borders',
                'type'      => 'color',
                'label'     => __( 'Borders', 'wpex' ),
                'element'   => '.mobile-toggle-nav a',
                'style'     => 'border-color',
                'section'   => 'wpex_toggle_mobile_menu_styling',
            );
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_toggle_mobile_menu_styling',
            );
            $array[] = array(
                'id'        => 'toggle_mobile_menu_links',
                'type'      => 'color',
                'label'     => __( 'Links', 'wpex' ),
                'element'   => '.mobile-toggle-nav a',
                'style'     => 'color',
                'section'   => 'wpex_toggle_mobile_menu_styling',
            );
            $array[] = array(
                'id'        => 'toggle_mobile_menu_links_hover',
                'type'      => 'color',
                'label'     => __( 'Links: Hover', 'wpex' ),
                'element'   => '.mobile-toggle-nav a:hover',
                'style'     => 'color',
                'section'   => 'wpex_toggle_mobile_menu_styling',
                'transport' => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Footer Widgets
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'            => 'footer_padding',
                'type'          => 'text',
                'label'         => __( 'Padding', 'wpex' ),
                'element'       => '#footer-inner',
                'style'         => 'padding',
                'section'       => 'wpex_footer_styling',
                'description'   => __( 'Format: top right bottom left.', 'wpex' ),
            );
            $array[] = array(
                'id'        => 'footer_background',
                'type'      => 'color',
                'label'     => __( 'Background', 'wpex' ),
                'element'   => '#footer',
                'style'     => 'background-color',
                'section'   => 'wpex_footer_styling',
            );
            $array[] = array(
                'id'        => 'footer_color',
                'type'      => 'color',
                'label'     => __( 'Color', 'wpex' ),
                'element'   => '#footer, #footer p, #footer li a:before',
                'style'     => 'color',
                'section'   => 'wpex_footer_styling',
            );
            $array[] = array(
                'id'        => 'footer_borders',
                'type'      => 'color',
                'label'     => __( 'Li & Calendar Borders', 'wpex' ),
                'element'   => '#footer li, #footer #wp-calendar thead th, #footer #wp-calendar tbody td',
                'style'     => 'border-color',
                'section'   => 'wpex_footer_styling',
            );

            // Footer - Links
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_footer_styling',
            );
            $array[] = array(
                'id'        => 'footer_link_color',
                'type'      => 'color',
                'label'     => __( 'Links', 'wpex' ),
                'element'   => '#footer a',
                'style'     => 'color',
                'section'   => 'wpex_footer_styling',
            );
            $array[] = array(
                'id'        => 'footer_link_color_hover',
                'type'      => 'color',
                'label'     => __( 'Links: Hover', 'wpex' ),
                'element'   => '#footer a:hover',
                'style'     => 'color',
                'section'   => 'wpex_footer_styling',
                'transport' => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Footer Bottom
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'            => 'bottom_footer_text_align',
                'type'          => 'text_align',
                'label'         => __( 'Text Align', 'wpex' ),
                'element'       => '#footer-bottom',
                'style'         => 'text-align',
                'section'       => 'wpex_footer_bottom_styling',
                'description'   => __( 'If you have disabled the footer menu this option is perfect for centering your copyright information.', 'wpex' ),
            );
            $array[] = array(
                'id'            => 'bottom_footer_padding',
                'type'          => 'text',
                'label'         => __( 'Padding', 'wpex' ),
                'element'       => '#footer-bottom',
                'style'         => 'padding',
                'section'       => 'wpex_footer_bottom_styling',
                'description'   => __( 'Format: top right bottom left.', 'wpex' ),
            );
            $array[] = array(
                'id'        => 'bottom_footer_background',
                'type'      => 'color',
                'label'     => __( 'Background', 'wpex' ),
                'element'   => '#footer-bottom',
                'style'     => 'background-color',
                'section'   => 'wpex_footer_bottom_styling',
            );
            $array[] = array(
                'id'        => 'bottom_footer_color',
                'type'      => 'color',
                'label'     => __( 'Color', 'wpex' ),
                'element'   => '#footer-bottom, #footer-bottom p',
                'style'     => 'color',
                'section'   => 'wpex_footer_bottom_styling',
            );

            // Footer bottom links
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_footer_bottom_styling',
            );
            $array[] = array(
                'id'        => 'bottom_footer_link_color',
                'type'      => 'color',
                'label'     => __( 'Links', 'wpex' ),
                'element'   => '#footer-bottom a',
                'style'     => 'color',
                'section'   => 'wpex_footer_bottom_styling',
            );
            $array[] = array(
                'id'        => 'bottom_footer_link_color_hover',
                'type'      => 'color',
                'label'     => __( 'Links: Hover', 'wpex' ),
                'element'   => '#footer-bottom a:hover',
                'style'     => 'color',
                'section'   => 'wpex_footer_bottom_styling',
                'transport' => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Scroll Top
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'        => 'scroll_top_border_radius',
                'type'      => 'text',
                'label'     => __( 'Border Radius', 'wpex' ),
                'element'   => '#site-scroll-top',
                'style'     => 'border-radius',
                'section'   => 'wpex_scroll_up_button_styling',
                'transport' => 'refresh',
            );

            // Scroll Top bg
            $array[] = array(
                'id'        => 'scroll_top_bg',
                'type'      => 'color',
                'label'     => __( 'Background', 'wpex' ),
                'element'   => '#site-scroll-top',
                'style'     => 'background-color',
                'section'   => 'wpex_scroll_up_button_styling',
            );
            $array[] = array(
                'id'        => 'scroll_top_bg_hover',
                'type'      => 'color',
                'label'     => __( 'Background: Hover', 'wpex' ),
                'element'   => '#site-scroll-top:hover',
                'style'     => 'background-color',
                'section'   => 'wpex_scroll_up_button_styling',
                'transport' => 'refresh',
            );

            // Scroll Top Border
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_scroll_up_button_styling',
            );
            $array[] = array(
                'id'        => 'scroll_top_border',
                'type'      => 'color',
                'label'     => __( 'Border', 'wpex' ),
                'element'   => '#site-scroll-top',
                'style'     => 'border-color',
                'section'   => 'wpex_scroll_up_button_styling',
            );
            $array[] = array(
                'id'        => 'scroll_top_border_hover',
                'type'      => 'color',
                'label'     => __( 'Border: Hover', 'wpex' ),
                'element'   => '#site-scroll-top:hover',
                'style'     => 'border-color',
                'section'   => 'wpex_scroll_up_button_styling',
                'transport' => 'refresh',
            );

            // Scroll Top Color
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_scroll_up_button_styling',
            );
            $array[] = array(
                'id'        => 'scroll_top_color',
                'type'      => 'color',
                'label'     => __( 'Text Color', 'wpex' ),
                'element'   => '#site-scroll-top',
                'style'     => 'color',
                'section'   => 'wpex_scroll_up_button_styling',
            );
            $array[] = array(
                'id'        => 'scroll_top_color_hover',
                'type'      => 'color',
                'label'     => __( 'Text Color: Hover', 'wpex' ),
                'element'   => '#site-scroll-top:hover',
                'style'     => 'color',
                'section'   => 'wpex_scroll_up_button_styling',
                'transport' => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Callout
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'        => 'footer_callout_bg',
                'type'      => 'color',
                'label'     => __( 'Background', 'wpex' ),
                'element'   => '#footer-callout-wrap',
                'style'     => 'background-color',
                'section'   => 'wpex_callout_styling',
            );
            $array[] = array(
                'id'        => 'footer_callout_border',
                'type'      => 'color',
                'label'     => __( 'Border Color', 'wpex' ),
                'element'   => '#footer-callout-wrap',
                'style'     => 'border-color',
                'section'   => 'wpex_callout_styling',
            );
            $array[] = array(
                'id'        => 'footer_callout_color',
                'type'      => 'color',
                'label'     => __( 'Text Color', 'wpex' ),
                'element'   => '#footer-callout-wrap',
                'style'     => 'color',
                'section'   => 'wpex_callout_styling',
            );

            // Callout text links
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_callout_styling',
            );
            $array[] = array(
                'id'        => 'footer_callout_link_color',
                'type'      => 'color',
                'label'     => __( 'Links', 'wpex' ),
                'element'   => '.footer-callout-content a',
                'style'     => 'color',
                'section'   => 'wpex_callout_styling',
            );
            $array[] = array(
                'id'        => 'footer_callout_link_color_hover',
                'type'      => 'color',
                'label'     => __( 'Links: Hover', 'wpex' ),
                'element'   => '.footer-callout-content a:hover',
                'style'     => 'color',
                'section'   => 'wpex_callout_styling',
                'transport' => 'refresh',
            );

            // Callout button
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_callout_styling',
            );
            $array[] = array(
                'id'        => 'callout_button_border_radius',
                'type'      => 'text',
                'label'     => __( 'Button Border Radius', 'wpex' ),
                'element'   => '#footer-callout .theme-button',
                'style'     => 'border-radius',
                'section'   => 'wpex_callout_styling',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'footer_callout_button_bg',
                'type'      => 'color',
                'label'     => __( 'Button Background', 'wpex' ),
                'element'   => '#footer-callout .theme-button',
                'style'     => 'background-color',
                'section'   => 'wpex_callout_styling',
            );
            $array[] = array(
                'id'        => 'footer_callout_button_color',
                'type'      => 'color',
                'label'     => __( 'Button Color', 'wpex' ),
                'element'   => '#footer-callout .theme-button',
                'style'     => 'color',
                'section'   => 'wpex_callout_styling',
            );
            $array[] = array(
                'id'        => 'footer_callout_button_hover_bg',
                'type'      => 'color',
                'label'     => __( 'Button: Hover Background', 'wpex' ),
                'element'   => '#footer-callout .theme-button:hover',
                'style'     => 'background-color',
                'section'   => 'wpex_callout_styling',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'footer_callout_button_hover_color',
                'type'      => 'color',
                'label'     => __( 'Button: Hover Color', 'wpex' ),
                'element'   => '#footer-callout .theme-button:hover',
                'style'     => 'color',
                'section'   => 'wpex_callout_styling',
                'transport' => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Sidebar
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'        => 'sidebar_background',
                'type'      => 'color',
                'label'     => __( 'Background', 'wpex' ),
                'element'   => '#sidebar',
                'style'     => 'background-color',
                'section'   => 'wpex_sidebar_styling',
            );
            $array[] = array(
                'id'            => 'sidebar_padding',
                'type'          => 'text',
                'label'         => __( 'Padding', 'wpex' ),
                'element'       => '#sidebar',
                'style'         => 'padding',
                'section'       => 'wpex_sidebar_styling',
                'description'   => __( 'Format: top right bottom left.', 'wpex' ),
                'transport'     => 'refresh',
            );
            $array[] = array(
                'id'            => 'sidebar_headings_color',
                'type'          => 'color',
                'label'         => __( 'Headings Color', 'wpex' ),
                'element'       => '#sidebar .widget-title, #sidebar .widget-title a',
                'style'         => 'color',
                'section'       => 'wpex_sidebar_styling',
            );
            $array[] = array(
                'id'            => 'sidebar_text_color',
                'type'          => 'color',
                'label'         => __( 'Text Color', 'wpex' ),
                'element'       => '#sidebar, #sidebar p',
                'style'         => 'color',
                'section'       => 'wpex_sidebar_styling',
            );
            $array[] = array(
                'id'            => 'sidebar_borders_color',
                'type'          => 'color',
                'label'         => __( 'Li & Calendar Borders', 'wpex' ),
                'element'       => '#sidebar li, #sidebar #wp-calendar thead th, #sidebar #wp-calendar tbody td',
                'style'         => 'border-color',
                'section'       => 'wpex_sidebar_styling',
            );

            // Sidebar links
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_sidebar_styling',
            );
            $array[] = array(
                'id'            => 'sidebar_link_color',
                'type'          => 'color',
                'label'         => __( 'Link Color', 'wpex' ),
                'element'       => '#sidebar a',
                'style'         => 'color',
                'section'       => 'wpex_sidebar_styling',
            );
            $array[] = array(
                'id'            => 'sidebar_link_color_hover',
                'type'          => 'color',
                'label'         => __( 'Link Color: Hover', 'wpex' ),
                'element'       => '#sidebar a:hover',
                'style'         => 'color',
                'section'       => 'wpex_sidebar_styling',
                'transport'     => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Page Title
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'        => 'page_header_top_padding',
                'type'      => 'text',
                'label'     => __( 'Top Padding', 'wpex' ),
                'element'   => '.page-header',
                'style'     => 'padding-top',
                'section'   => 'wpex_page_header',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'page_header_bottom_padding',
                'type'      => 'text',
                'label'     => __( 'Bottom Padding', 'wpex' ),
                'element'   => '.page-header',
                'style'     => 'padding-bottom',
                'section'   => 'wpex_page_header',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'page_header_background',
                'type'      => 'color',
                'label'     => __( 'Background', 'wpex' ),
                'element'   => '.page-header',
                'style'     => 'background-color',
                'section'   => 'wpex_page_header',
            );
            $array[] = array(
                'id'        => 'page_header_title_color',
                'type'      => 'color',
                'label'     => __( 'Text Color', 'wpex' ),
                'element'   => '.page-header-title',
                'style'     => 'color',
                'section'   => 'wpex_page_header',
            );
            $array[] = array(
                'id'        => 'page_header_top_border',
                'type'      => 'color',
                'label'     => __( 'Top Border Color', 'wpex' ),
                'element'   => '.page-header, .theme-gaps .page-header-inner',
                'style'     => 'border-top-color',
                'section'   => 'wpex_page_header',
            );
            $array[] = array(
                'id'        => 'page_header_bottom_border',
                'type'      => 'color',
                'label'     => __( 'Bottom Border Color', 'wpex' ),
                'element'   => '.page-header, .theme-gaps .page-header-inner',
                'style'     => 'border-bottom-color',
                'section'   => 'wpex_page_header',
            );

            /*-----------------------------------------------------*/
            /*  - Breadcrumbs
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'        => 'breadcrumbs_text_color',
                'type'      => 'color',
                'label'     => __( 'Text Color', 'wpex' ), 
                'element'   => '.site-breadcrumbs',
                'style'     => 'color',
                'section'   => 'wpex_breadcrumbs',
            );
            $array[] = array(
                'id'        => 'breadcrumbs_seperator_color',
                'type'      => 'color',
                'label'     => __( 'Seperator Color', 'wpex' ), 
                'element'   => '.site-breadcrumbs .sep',
                'style'     => 'color',
                'section'   => 'wpex_breadcrumbs',
            );
            $array[] = array(
                'id'        => 'breadcrumbs_link_color',
                'type'      => 'color',
                'label'     => __( 'Link Color', 'wpex' ), 
                'element'   => '.site-breadcrumbs a',
                'style'     => 'color',
                'section'   => 'wpex_breadcrumbs',
            );
            $array[] = array(
                'id'        => 'breadcrumbs_link_color_hover',
                'type'      => 'color',
                'label'     => __( 'Link Color: Hover', 'wpex' ), 
                'element'   => '.site-breadcrumbs a:hover',
                'style'     => 'color',
                'section'   => 'wpex_breadcrumbs',
                'transport' => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Links & Buttons
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'        => 'link_color',
                'type'      => 'color',
                'label'     => __( 'Links Color', 'wpex' ),
                'element'   => 'a, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, .wpex-carousel-entry-title a:hover',
                'style'     => 'color',
                'section'   => 'wpex_general_links_buttons',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'link_color_hover',
                'type'      => 'color',
                'label'     => __( 'Links Color: Hover', 'wpex' ),
                'element'   => 'a:hover',
                'style'     => 'color',
                'section'   => 'wpex_general_links_buttons',
                'transport' => 'refresh',
            );

            $array[] = array(
                'id'        => 'headings_link_color_hover',
                'type'      => 'color',
                'label'     => __( 'Headings With Links Color: Hover', 'wpex' ),
                'element'   => 'h1 a:hover, h2 a:hover, a:hover h2, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover',
                'style'     => 'color',
                'section'   => 'wpex_general_links_buttons',
            );

            // Button colors
            $array[] = array(
                'id'        => 'wpex_hr_control',
                'type'      => 'hr',
                'section'   => 'wpex_general_links_buttons',
            );
            $array[] = array(
                'id'            => 'theme_button_padding',
                'type'          => 'text',
                'label'         => __( 'Theme Button Padding', 'wpex' ),
                'element'       => 'input[type="submit"], .theme-button, button, .vcex-button.flat, .navbar-style-one .menu-button > a > span.link-inner',
                'style'         => 'padding',
                'section'       => 'wpex_general_links_buttons',
                'transport'     => 'refresh',

                'description'   => __( 'Format: top right bottom left.', 'wpex' ),
            );
            $array[] = array(
                'id'        => 'theme_button_border_radius',
                'type'      => 'text',
                'label'     => __( 'Theme Button Border Radius', 'wpex' ),
                'element'   => 'input[type="submit"], .theme-button, button, .vcex-button.flat, .navbar-style-one .menu-button > a > span.link-inner',
                'style'     => 'border-radius',
                'section'   => 'wpex_general_links_buttons',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'theme_button_color',
                'type'      => 'color',
                'label'     => __( 'Theme Button Color', 'wpex' ),
                'element'   => 'input[type="submit"], .theme-button, button, #main .tagcloud a:hover, .post-tags a:hover, .vcex-button.flat:hover,.navbar-style-one .menu-button > a > span.link-inner:hover',
                'style'     => 'color',
                'section'   => 'wpex_general_links_buttons',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'theme_button_hover_color',
                'type'      => 'color',
                'label'     => __( 'Theme Button Color: Hover', 'wpex' ),
                'element'   => 'input[type="submit"]:hover, .theme-button:hover, button:hover, .vcex-button.flat:hover, .navbar-style-one .menu-button > a > span.link-inner:hover',
                'style'     => 'color',
                'section'   => 'wpex_general_links_buttons',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'theme_button_bg',
                'type'      => 'color',
                'label'     => __( 'Theme Button Background', 'wpex' ),
                'element'   => 'input[type="submit"], .theme-button, button, .vcex-button.flat, .navbar-style-one .menu-button > a > span.link-inner',
                'style'     => 'background',
                'section'   => 'wpex_general_links_buttons',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'theme_button_hover_bg',
                'type'      => 'color',
                'label'     => __( 'Theme Button Background: Hover', 'wpex' ),
                'element'   => 'input[type="submit"]:hover, .theme-button:hover, button:hover, .vcex-button.flat:hover, .navbar-style-one .menu-button > a > span.link-inner:hover',
                'style'     => 'background',
                'section'   => 'wpex_general_links_buttons',
                'transport' => 'refresh',
                'transport' => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Forms
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'            => 'input_padding',
                'type'          => 'text',
                'label'         => __( 'Padding', 'wpex' ),
                'element'       => '.entry input[type="text"],
                                .site-content input[type="password"],
                                .site-content input[type="email"],
                                .site-content input[type="tel"],
                                .site-content input[type="url"],
                                .site-content input[type="search"],
                                .site-content textarea',
                'style'         => 'padding',
                'section'       => 'wpex_general_forms',
                'transport'     => 'refresh',
                'description'   => __( 'Format: top right bottom left.', 'wpex' ),
            );
            $array[] = array(
                'id'            => 'input_border_radius',
                'type'          => 'text',
                'label'         => __( 'Border Radius', 'wpex' ),
                'element'       => '.site-content input[type="text"],
                                .site-content input[type="password"],
                                .site-content input[type="email"],
                                .site-content input[type="tel"],
                                .site-content input[type="url"],
                                .site-content input[type="search"],
                                .site-content textarea',
                'style'         => 'border-radius',
                'section'       => 'wpex_general_forms',
                'transport'     => 'refresh',
            );
            $array[] = array(
                'id'            => 'input_font_size',
                'type'          => 'text',
                'label'         => __( 'Font-Size', 'wpex' ),
                'element'       => '.site-content input[type="text"],
                                .site-content input[type="password"],
                                .site-content input[type="email"],
                                .site-content input[type="tel"],
                                .site-content input[type="url"],
                                .site-content input[type="search"],
                                .site-content textarea',
                'style'         => 'font-size',
                'section'       => 'wpex_general_forms',
                'transport'     => 'refresh',
            );
            $array[] = array(
                'id'        => 'input_background',
                'type'      => 'color',
                'label'     => __( 'Background', 'wpex' ),
                'element'   => '.site-content input[type="text"],
                                .site-content input[type="password"],
                                .site-content input[type="email"],
                                .site-content input[type="tel"],
                                .site-content input[type="url"],
                                .site-content input[type="search"],
                                .site-content textarea',
                'style'     => 'background-color',
                'section'   => 'wpex_general_forms',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'input_border',
                'type'      => 'color',
                'label'     => __( 'Border', 'wpex' ),
                'element'   => '.site-content input[type="text"],
                                .site-content input[type="password"],
                                .site-content input[type="email"],
                                .site-content input[type="tel"],
                                .site-content input[type="url"],
                                .site-content input[type="search"],
                                .site-content textarea',
                'style'     => 'border-color',
                'section'   => 'wpex_general_forms',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'input_color',
                'type'      => 'color',
                'label'     => __( 'Color', 'wpex' ),
                'element'   => '.site-content input[type="text"],
                                .site-content input[type="password"],
                                .site-content input[type="email"],
                                .site-content input[type="tel"],
                                .site-content input[type="url"],
                                .site-content input[type="search"],
                                .site-content textarea',
                'style'     => 'color',
                'section'   => 'wpex_general_forms',
                'transport' => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - WooCommerce
            /*-----------------------------------------------------*/
            if ( WPEX_WOOCOMMERCE_ACTIVE ) {
                $array[] = array(
                    'id'        => 'onsale_bg',
                    'type'      => 'color',
                    'label'     => __( 'On Sale Background', 'wpex' ),
                    'element'   => '.woocommerce span.onsale',
                    'style'     => 'background-color',
                    'section'   => 'wpex_woocommerce_styling',
                );
                $array[] = array(
                    'id'        => 'onsale_color',
                    'type'      => 'color',
                    'label'     => __( 'On Sale Color', 'wpex' ),
                    'element'   => '.woocommerce span.onsale',
                    'style'     => 'color',
                    'section'   => 'wpex_woocommerce_styling',
                );
                $array[] = array(
                    'id'        => 'woo_product_title_link_color',
                    'type'      => 'color',
                    'label'     => __( 'Product Entry Title Color', 'wpex' ),
                    'element'   => '.woocommerce ul.products li.product h3, .woocommerce ul.products li.product h3 mark',
                    'style'     => 'color',
                    'section'   => 'wpex_woocommerce_styling',
                );
                $array[] = array(
                    'id'        => 'woo_product_title_link_color_hover',
                    'type'      => 'color',
                    'label'     => __( 'Product Entry Title Color: Hover', 'wpex' ),
                    'element'   => '.woocommerce ul.products li.product h3:hover, .woocommerce ul.products li.product h3:hover mark',
                    'style'     => 'color',
                    'section'   => 'wpex_woocommerce_styling',
                );
                $array[] = array(
                    'id'        => 'woo_price_color',
                    'type'      => 'color',
                    'label'     => __( 'Global Price Color', 'wpex' ),
                    'element'   => '.price, .amount',
                    'style'     => 'color',
                    'section'   => 'wpex_woocommerce_styling',
                );
                $array[] = array(
                    'id'        => 'woo_product_entry_price_color',
                    'type'      => 'color',
                    'label'     => __( 'Product Entry Price Color', 'wpex' ),
                    'element'   => '.woocommerce ul.products li.product .price, .woocommerce ul.products li.product .price .amount',
                    'style'     => 'color',
                    'section'   => 'wpex_woocommerce_styling',
                );
                $array[] = array(
                    'id'        => 'woo_single_price_color',
                    'type'      => 'color',
                    'label'     => __( 'Single Product Price Color', 'wpex' ),
                    'element'   => '.woocommerce .summary .price, .woocommerce .summary .amount',
                    'style'     => 'color',
                    'section'   => 'wpex_woocommerce_styling',
                );
                $array[] = array(
                    'id'        => 'woo_stars_color',
                    'type'      => 'color',
                    'label'     => __( 'Star Ratings Color', 'wpex' ),
                    'element'   => '.woocommerce p.stars a, .woocommerce .star-rating',
                    'style'     => 'color',
                    'section'   => 'wpex_woocommerce_styling',
                );
                $array[] = array(
                    'id'        => 'woo_single_tabs_active_border_color',
                    'type'      => 'color',
                    'label'     => __( 'Product Tabs Active Border Color', 'wpex' ),
                    'element'   => '.woocommerce div.product .woocommerce-tabs ul.tabs li.active a',
                    'style'     => 'border-color',
                    'section'   => 'wpex_woocommerce_styling',
                );
                $array[] = array(
                    'id'        => 'woo_button_bg',
                    'type'      => 'color',
                    'label'     => __( 'WooCommerce Button Background', 'wpex' ),
                    'element'   => '.woocommerce input#submit, .woocommerce .button, a.wc-forward',
                    'style'     => 'background-color',
                    'section'   => 'wpex_woocommerce_styling',
                    'important' => true,
                );
                $array[] = array(
                    'id'        => 'woo_button_color',
                    'type'      => 'color',
                    'label'     => __( 'WooCommerce Button Color', 'wpex' ),
                    'element'   => '.woocommerce input#submit, .woocommerce .button, a.wc-forward',
                    'style'     => 'color',
                    'section'   => 'wpex_woocommerce_styling',
                    'important' => true,
                );
                $array[] = array(
                    'id'        => 'woo_button_bg_hover',
                    'type'      => 'color',
                    'label'     => __( 'WooCommerce Button Hover: Background', 'wpex' ),
                    'element'   => '.woocommerce input#submit:hover, .woocommerce .button:hover, a.wc-forward:hover',
                    'style'     => 'background-color',
                    'section'   => 'wpex_woocommerce_styling',
                    'important' => true,
                );
                $array[] = array(
                    'id'        => 'woo_button_color_hover',
                    'type'      => 'color',
                    'label'     => __( 'WooCommerce Button Hover: Color', 'wpex' ),
                    'element'   => '.woocommerce input#submit:hover, .woocommerce .button:hover, a.wc-forward:hover',
                    'style'     => 'color',
                    'section'   => 'wpex_woocommerce_styling',
                    'important' => true,
                );
            }

            /*-----------------------------------------------------*/
            /*  - Visual Composer
            /*-----------------------------------------------------*/
            if ( WPEX_VC_ACTIVE ) {

                $array[] = array(
                    'id'            => 'vc_row_bottom_margin',
                    'type'          => 'text',
                    'default'       => '40px',
                    'label'         => __( 'Column Bottom Margin', 'wpex' ), 
                    'description'   => __( 'Enter a default bottom margin for all Visual Composer columns to help speed up development.', 'wpex' ),
                    'element'       => '.wpb_column',
                    'style'         => 'margin-bottom',
                    'section'       => 'wpex_visual_composer_styling',
                    'transport'     => 'refresh',
                );

                // Randoms
                $array[] = array(
                    'id'        => 'vcex_text_separator_two_border_color',
                    'type'      => 'color',
                    'label'     => __( 'Seperator With Text Border Color', 'wpex' ),
                    'element'   => 'body .vc_text_separator_two span',
                    'style'     => 'border-color',
                    'section'   => 'wpex_visual_composer_styling',
                );
                $array[] = array(
                    'id'        => 'vcex_text_tab_two_bottom_border',
                    'type'      => 'color',
                    'label'     => __( 'Tabs Alternative 2 Border Color', 'wpex' ),
                    'element'   => 'body .wpb_tabs.tab-style-alternative-two .wpb_tabs_nav li.ui-tabs-active a',
                    'style'     => 'border-color',
                    'section'   => 'wpex_visual_composer_styling',
                );
                $array[] = array(
                    'id'        => 'vcex_carousel_arrows',
                    'type'      => 'color',
                    'transport' => 'refresh',
                    'label'     => __( 'Carousel Arrows Highlight Color', 'wpex' ),
                    'element'   => '.wpex-carousel .owl-prev, .wpex-carousel .owl-next, .wpex-carousel .owl-prev:hover, .wpex-carousel .owl-next:hover',
                    'style'     => 'background-color',
                    'section'   => 'wpex_visual_composer_styling',
                    'transport' => 'refresh',
                );
                $array[] = array(
                    'id'        => 'vcex_pricing_featured_default',
                    'type'      => 'color',
                    'label'     => __( 'Featured Pricing Table Color', 'wpex' ),
                    'element'   => '.vcex-pricing.featured .vcex-pricing-header h5',
                    'style'     => 'background-color',
                    'section'   => 'wpex_visual_composer_styling',
                );
                $array[] = array(
                    'id'        => 'vcex_icon_box_hover_color',
                    'type'      => 'color',
                    'label'     => __( 'Icon Box Hover Color', 'wpex' ),
                    'element'   => '.vcex-icon-box-four.vcex-icon-box-with-link:hover, .vcex-icon-box-five.vcex-icon-box-with-link:hover',
                    'style'     => 'background-color',
                    'section'   => 'wpex_visual_composer_styling',
                    'transport' => 'refresh',
                    'transport' => 'refresh',
                );

                // Grid filter
                $array[] = array(
                    'id'        => 'wpex_hr_control',
                    'type'      => 'hr',
                    'section'   => 'wpex_visual_composer_styling',
                );
                $array[] = array(
                    'id'        => 'vcex_grid_filter_active_color',
                    'type'      => 'color',
                    'label'     => __( 'Grid Filter: Active Link Color', 'wpex' ),
                    'element'   => '.vcex-filter-links a:hover, .vcex-filter-links li.active a',
                    'style'     => 'color',
                    'section'   => 'wpex_visual_composer_styling',
                    'transport' => 'refresh',
                );
                $array[] = array(
                    'id'        => 'vcex_grid_filter_active_bg',
                    'type'      => 'color',
                    'label'     => __( 'Grid Filter: Active Link Background', 'wpex' ),
                    'element'   => '.vcex-filter-links a:hover, .vcex-filter-links li.active a',
                    'style'     => 'background-color',
                    'section'   => 'wpex_visual_composer_styling',
                    'transport' => 'refresh',
                );
                $array[] = array(
                    'id'        => 'vcex_grid_filter_active_border',
                    'type'      => 'color',
                    'label'     => __( 'Grid Filter: Active Link Border', 'wpex' ),
                    'element'   => '.vcex-filter-links a:hover, .vcex-filter-links li.active a',
                    'style'     => 'border-color',
                    'section'   => 'wpex_visual_composer_styling',
                    'transport' => 'refresh',
                );

                // Recent news
                $array[] = array(
                    'id'        => 'wpex_hr_control',
                    'type'      => 'hr',
                    'section'   => 'wpex_visual_composer_styling',
                );
                $array[] = array(
                    'id'        => 'vcex_recent_news_date_bg',
                    'type'      => 'color',
                    'label'     => __( 'Recent News Date: Background', 'wpex' ),
                    'element'   => '.vcex-recent-news-date span.month',
                    'style'     => 'background-color',
                    'section'   => 'wpex_visual_composer_styling',
                );
                $array[] = array(
                    'id'        => 'vcex_recent_news_date_color',
                    'type'      => 'color',
                    'label'     => __( 'Recent News Date: Color', 'wpex' ),
                    'element'   => '.vcex-recent-news-date span.month',
                    'style'     => 'color',
                    'section'   => 'wpex_visual_composer_styling',
                );


            }

            // Return array
            return $array;
        }

        /*-----------------------------------------------------------------------------------*/
        /*  - Reset Cache after customizer save
        /*-----------------------------------------------------------------------------------*/
        public function reset_cache() {
            remove_theme_mod( 'wpex_customizer_css_cache' );
        }

        /*-----------------------------------------------------------------------------------*/
        /*  - Register theme options
        /*-----------------------------------------------------------------------------------*/
        public function register ( $wp_customize ) {

            // Get enabled customizer panels
            $enabled_panels = array( 'styling' => true );
            $enabled_panels = get_option( 'wpex_customizer_panels', $enabled_panels );
            if ( empty( $enabled_panels['styling'] ) ) {
                return;
            }

            // Top Bar
            $wp_customize->add_section( 'wpex_topbar_styling' , array(
                'title'     => __( 'Styling', 'wpex' ),
                'priority'  => 999,
                'panel'     => 'wpex_topbar',
            ) );

            // Toggle Bar
            $wp_customize->add_section( 'wpex_togglebar_styling' , array(
                'title'     => __( 'Styling', 'wpex' ),
                'priority'  => 999,
                'panel'     => 'wpex_togglebar',
            ) );

            // Header
            $wp_customize->add_section( 'wpex_header_styling' , array(
                'title'     => __( 'Styling', 'wpex' ),
                'priority'  => 999,
                'panel'     => 'wpex_header',
            ) );

            // Menu
            $wp_customize->add_section( 'wpex_main_menu_styling' , array(
                'title'     => __( 'Styling: Main', 'wpex' ),
                'priority'  => 997,
                'panel'     => 'wpex_menu',
            ) );

            // Mobile Menu
            $wp_customize->add_section( 'wpex_mobile_menu_icons_styling' , array(
                'title'     => __( 'Styling: Mobile Icons Menu', 'wpex' ),
                'priority'  => 998,
                'panel'     => 'wpex_menu',
            ) );

            // Sidr
            $wp_customize->add_section( 'wpex_sidr_styling' , array(
                'title'     => __( 'Styling: Mobile Sidebar Menu', 'wpex' ),
                'priority'  => 999,
                'panel'     => 'wpex_menu',
            ) );

            // Toggle Mobile Menu
            $wp_customize->add_section( 'wpex_toggle_mobile_menu_styling' , array(
                'title'     => __( 'Styling: Mobile Toggle Menu', 'wpex' ),
                'priority'  => 9999,
                'panel'     => 'wpex_menu',
            ) );

            // Sidebar styling
            $wp_customize->add_section( 'wpex_sidebar_styling' , array(
                'title'     => __( 'Styling', 'wpex' ),
                'priority'  => 999,
                'panel'     => 'wpex_sidebar',
            ) );

            // Footer
            $wp_customize->add_section( 'wpex_footer_styling' , array(
                'title'     => __( 'Styling: Footer', 'wpex' ),
                'priority'  => 997,
                'panel'     => 'wpex_footer',
            ) );

            // Footer - Bottom
            $wp_customize->add_section( 'wpex_footer_bottom_styling' , array(
                'title'     => __( 'Styling: Footer Bottom', 'wpex' ),
                'priority'  => 998,
                'panel'     => 'wpex_footer',
            ) );

            // Footer - Back to top link
            $wp_customize->add_section( 'wpex_scroll_up_button_styling' , array(
                'title'     => __( 'Styling: Scroll Up Button', 'wpex' ),
                'priority'  => 999,
                'panel'     => 'wpex_footer',
            ) );

            // Links & Buttons
            $wp_customize->add_section( 'wpex_general_links_buttons' , array(
                'title'     => __( 'Links & Buttons', 'wpex' ),
                'priority'  => 999,
                'panel'     => 'wpex_general',
            ) );

            // Forms
            $wp_customize->add_section( 'wpex_general_forms' , array(
                'title'     => __( 'Forms', 'wpex' ),
                'priority'  => 999,
                'panel'     => 'wpex_general',
            ) );

            // Callout
            $wp_customize->add_section( 'wpex_callout_styling' , array(
                'title'     => __( 'Styling', 'wpex' ),
                'priority'  => 999,
                'panel'     => 'wpex_callout',
            ) );

            // WooCommerce
            if ( WPEX_WOOCOMMERCE_ACTIVE ) {
                $wp_customize->add_section( 'wpex_woocommerce_styling' , array(
                    'title'     => __( 'Styling', 'wpex' ),
                    'priority'  => 999,
                    'panel'     => 'wpex_woocommerce',
                ) );
            }

            // Visual Composer
            if ( WPEX_VC_ACTIVE ) {
                $wp_customize->add_section( 'wpex_visual_composer_styling' , array(
                    'title'     => __( 'Styling', 'wpex' ),
                    'priority'  => 999,
                    'panel'     => 'wpex_visual_composer',
                ) );
            }

            // Get Styling Options
            $styling_options = $this->styling_options();

            // Loop through color options and add a theme customizer setting for it
            $count = 0;
            foreach( $styling_options as $option ) {

                // Get vals
                $count++;
                $id             = $option[ 'id' ];
                $default        = isset( $option[ 'default' ] ) ? $option[ 'default' ] : '';
                $transport      = isset( $option[ 'transport' ] ) ? $option[ 'transport' ] : 'postMessage';
                $type           = isset( $option[ 'type' ] ) ? $option[ 'type' ] : 'color';
                $section        = isset( $option[ 'section' ] ) ? $option[ 'section' ] : 'wpex_styling_other';
                $description    = isset( $option[ 'description' ] ) ? $option[ 'description' ] : '';

                /* Check theme mod and set transport to refresh when value is set to fix a bug with the clear button
                if ( 'postMessage' == $transport && get_theme_mod( $option[ 'id' ] ) ) {
                    $transport = 'refresh';
                }*/

                // Set all transports to refresh...too many WP bugs, lets see how people react
                $transport = 'refresh';

                // Setting
                if ( 'hr' == $type ) {
                    $id = 'wpex_hr_control[ '. $count .' ]';
                }
                $wp_customize->add_setting( $id, array(
                    'type'              => 'theme_mod',
                    'default'           => $default,
                    'transport'         => $transport,
                    'sanitize_callback' => false,
                ) );

                // Control
                if ( 'hr' == $type ) {
                    $wp_customize->add_control( new WPEX_HR_Control( $wp_customize, $id, array(
                        'label'         => '',
                        'section'       => $section,
                        'settings'      => $id,
                        'priority'      => $count,
                    ) ) );
                } elseif ( 'text' == $type ) {
                    $wp_customize->add_control( $option[ 'id' ], array(
                        'label'         => $option[ 'label' ],
                        'section'       => $section,
                        'settings'      => $id,
                        'priority'      => $count,
                        'type'          => 'text',
                        'description'   => $description,
                    ) );
                } elseif( 'text_align' == $type ) {
                    $wp_customize->add_control( $option[ 'id' ], array(
                        'label'         => $option[ 'label' ],
                        'section'       => $section,
                        'settings'      => $id,
                        'priority'      => $count,
                        'type'          => 'select',
                        'description'   => $description,
                        'choices'       => array(
                            'default'   => __( 'Default','wpex' ),
                            'left'      => __( 'Left','wpex' ),
                            'right'     => __( 'Right','wpex' ),
                            'center'    => __( 'Center','wpex' ),
                        ),
                    ) );
                } else {
                    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, array(
                        'label'         => $option[ 'label' ],
                        'section'       => $section,
                        'settings'      => $id,
                        'priority'      => $count,
                        'description'   => $description,
                    ) ) );
                }
            }
        }

        /*-----------------------------------------------------------------------------------*/
        /*  - Output CSS
        /*-----------------------------------------------------------------------------------*/
        public function header_output( $output ) {

            // Get cached CSS output
            $data   = get_theme_mod( 'wpex_customizer_css_cache', false );
            $css    = '';

            // Remove mod in the customizer
            if ( is_customize_preview() ) {
                $data = '';
            }

            // If theme mod cache empty or is live customizer loop through elements and set output
            if ( ! $data || 'empty' == $data ) {

                // Get all color options
                $styling_options = $this->styling_options();

                foreach( $styling_options as $option ) {

                    // Get option type
                    $type = isset( $option[ 'type' ] ) ? $option[ 'type' ] : 'color';

                    // Seperator doesn't need styling
                    if ( 'hr' == $type ) {
                        continue;
                    }

                    $element        = $option[ 'element' ];
                    $style          = $option[ 'style' ];
                    $default        = isset( $option[ 'default' ] ) ? $option[ 'default' ] : '';
                    $sanitize       = isset( $option[ 'sanitize' ] ) ? $option[ 'sanitize' ] : '';
                    $media_query    = isset( $option[ 'media_query' ] ) ? $option[ 'media_query' ] : '';
                    $important      = isset( $option[ 'important' ] ) ? true : false;
                    $theme_mod      = get_theme_mod( $option[ 'id' ], $default );

                    // Output CSS
                    if ( $theme_mod ) {

                        // Fix some weird wp bug
                        if ( is_array( $theme_mod ) ) {
                            continue;
                        }

                        // Add !important tag
                        if ( $important ) {
                            $important = ' !important;';
                        }

                        // Sanitize data
                        if ( 'px' == $sanitize ) {
                            $theme_mod = intval( $theme_mod ) .'px';
                        }
                        if ( 'border-radius' == $sanitize ) {
                            $theme_mod = wpex_sanitize_data( $theme_mod, 'border_radius' );
                        }

                        // Media Query
                        if ( $media_query ) {
                            $css .= $media_query .' {';
                                $css .= $element .'{ '. $style .':'. $theme_mod . $important .'; }';
                            $css .= '}';
                        }

                        // Standard Output
                        else {
                            if ( is_array( $style ) ) {
                                foreach ( $style as $style_item ) {
                                    $css .= $element .'{ '. $style_item .':'. $theme_mod . $important .'; }';
                                }
                            } else {
                                $css .= $element .'{ '. $style .':'. $theme_mod . $important .'; }';
                            }
                        }

                    }
                }
            }

            // Set cache or get cache if not in customizer
            if ( ! is_customize_preview() ) {
                // Get Cache
                if ( $data ) {
                    $css = get_theme_mod( 'wpex_customizer_css_cache' );
                }
                // Set Cache
                else {
                    if ( $css ) {
                        $css = wpex_minify_css( $css );
                        set_theme_mod( 'wpex_customizer_css_cache', $css );
                        $css = get_theme_mod( 'wpex_customizer_css_cache' );
                    } else {
                        set_theme_mod( 'wpex_customizer_css_cache', 'empty' );
                    }
                }
            }

            // Output CSS in head if not empty
            if ( $css && 'empty' != $css ) {
                $output .= '/*CUSTOMIZER STYLING*/'. $css;
            }

            // Return $output
            return $output;

        } // End header_output function
    }
}
new WPEX_Theme_Customizer_Styling(); 
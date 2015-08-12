<?php
/**
 * Deprecated functions
 *
 * @package		Total
 * @subpackage	Framework
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link 		http://www.wpexplorer.com
 * @since		Total 1.6.0
 */


/*-----------------------------------------------------------------------------------*/
/*  - Rename old functions for better consistancy
/*-----------------------------------------------------------------------------------*/
function wpex_is_page_header_enabled( $post_id = NULL ) {
	return wpex_has_page_header( $post_id );
}
function wpex_footer_reveal_enabled( $post_id = '' ) {
	return wpex_has_footer_reveal( $post_id );
}
function wpex_display_callout( $post_id = '' ) {
	return wpex_has_callout( $post_id );
}
function wpex_display_page_header() {
	wpex_page_header();
}
function wpex_display_page_header_title() {
	wpex_page_header_title();
}
function wpex_is_top_bar_enabled() {
	return wpex_has_top_bar();
}
function wpex_header_layout() {
	// Do nothing, new function wpex_site_header is added via hook
}
function wpex_toggle_bar_active() {
	return wpex_has_togglebar();
}
function wpex_toggle_bar_btn() {
	return wpex_toggle_bar_button();
}
function wpex_get_post_layout_class() {
	return wpex_post_layout();
}
function wpex_overlay_classname() {
	return wpex_overlay_classes();
}
function wpex_img_animation_classes() {
	return wpex_entry_image_animation_classes();
}

/*-----------------------------------------------------------------------------------*/
/*  - Display Deprecated notices
/*-----------------------------------------------------------------------------------*/
function wpex_image() {
	_deprecated_function( 'wpex_image', '2.0.0', 'wpex_get_post_thumbnail' );
}
function wpex_mobile_menu() {
	_deprecated_function( 'wpex_mobile_menu', '2.0.0', 'wpex_mobile_menu_icons' );
}
function wpex_post_has_composer() {
	_deprecated_function( 'wpex_post_has_composer', '2.0.0', 'wpex_has_composer' );
}
function wpex_display_header() {
	_deprecated_function( 'wpex_display_header', '2.0.0', 'wpex_has_header' );
}
function wpex_display_footer() {
	_deprecated_function( 'wpex_display_footer', '2.0.0', 'wpex_has_footer' );
}
function wpex_display_footer_widgets() {
	_deprecated_function( 'wpex_display_footer_widgets', '2.0.0', 'wpex_has_footer_widgets' );
}
function wpex_page_title() {
	_deprecated_function( 'wpex_page_title', '2.0.0', 'wpex_title' );
}
function wpex_breadcrumbs_enabled() {
	_deprecated_function( 'wpex_breadcrumbs_enabled', '2.0.0', 'wpex_has_breadcrumbs' );
}

function wpex_post_subheading() {
	_deprecated_function( 'wpex_post_subheading', '2.0.0', 'wpex_page_header_subheading' );
}

function wpex_hook_header_before_default() {
	_deprecated_function( 'wpex_hook_header_before_default', '2.0.0' );
}

function wpex_hook_header_inner_default() {
	_deprecated_function( 'wpex_hook_header_inner_default', '2.0.0' );
}

function wpex_hook_header_bottom_default() {
	_deprecated_function( 'wpex_hook_header_bottom_default', '2.0.0' );
}

function wpex_hook_main_top_default() {
	_deprecated_function( 'wpex_hook_main_top_default', '2.0.0' );
}

function wpex_hook_sidebar_inner_default() {
	_deprecated_function( 'wpex_hook_sidebar_inner_default', '2.0.0' );
}

function wpex_hook_footer_before_default() {
	_deprecated_function( 'wpex_hook_footer_before_default', '2.0.0' );
}

function wpex_hook_footer_inner_default() {
	_deprecated_function( 'wpex_hook_footer_inner', '2.0.0' );
}

function wpex_hook_footer_after_default() {
	_deprecated_function( 'wpex_hook_footer_after', '2.0.0' );
}

function wpex_hook_wrap_after_default() {
	_deprecated_function( 'wpex_hook_wrap_after_default', '2.0.0' );
}

function wpex_theme_setup() {
	_deprecated_function( 'wpex_theme_setup', '1.6.0' );
}

function wpex_get_template_part() {
	_deprecated_function( 'wpex_get_template_part', '1.6.0', 'get_template_part' );
}

function wpex_active_post_types() {
	_deprecated_function( 'wpex_active_post_types', '1.6.0' );
}

function wpex_jpeg_quality() {
	_deprecated_function( 'wpex_jpeg_quality', '1.6.0' );
}

function wpex_favicons() {
	_deprecated_function( 'wpex_favicons', '1.6.0' );
}

function wpex_get_woo_product_first_cat() {
	_deprecated_function( 'wpex_get_woo_product_first_cat', '1.6.0' );
}

function wpex_global_config() {
	_deprecated_function( 'wpex_global_config', '1.6.0' );
}

function wpex_supports() {
	_deprecated_function( 'wpex_supports', '1.6.0' );
}

function wpex_ie8_css() {
	_deprecated_function( 'wpex_ie8_css', '1.6.0' );
}

function wpex_html5() {
	_deprecated_function( 'wpex_html5', '1.6.0' );
}

function wpex_load_scripts() {
	_deprecated_function( 'wpex_load_scripts', '1.6.0' );
}

function wpex_remove_wp_ver_css_js() {
	_deprecated_function( 'wpex_remove_wp_ver_css_js', '1.6.0' );
}

function wpex_output_css() {
	_deprecated_function( 'wpex_output_css', '1.6.0' );
}

function wpex_header_output() {
	_deprecated_function( 'wpex_header_output', '1.6.0', 'wpex_header_layout' );
}

function wpex_footer_copyright() {
	_deprecated_function( 'wpex_footer_copyright', '1.6.0', 'get_template_part' );
}

function wpex_topbar_output() {
	_deprecated_function( 'wpex_topbar_output', '1.6.0', 'get_template_part' );
}

function wpex_top_bar_social() {
	_deprecated_function( 'wpex_top_bar_social', '1.6.0', 'get_template_part' );
}

function wpex_portfolio_single_media() {
	_deprecated_function( 'wpex_portfolio_single_media', '1.6.0', 'get_template_part' );
}

function wpex_portfolio_related() {
	_deprecated_function( 'wpex_portfolio_related', '1.6.0', 'get_template_part' );
}

function wpex_portfolio_entry_media() {
	_deprecated_function( 'wpex_portfolio_entry_media', '1.6.0', 'get_template_part' );
}

function wpex_portfolio_entry_content() {
	_deprecated_function( 'wpex_portfolio_entry_content', '1.6.0', 'get_template_part' );
}

function wpex_staff_entry_media() {
	_deprecated_function( 'wpex_staff_entry_media', '1.6.0', 'get_template_part' );
}

function wpex_staff_related() {
	_deprecated_function( 'wpex_staff_related', '1.6.0', 'get_template_part' );
}

function wpex_blog_related() {
	_deprecated_function( 'wpex_blog_related', '1.6.0', 'get_template_part' );
}

function wpex_blog_entry_display() {
	_deprecated_function( 'wpex_blog_entry_display', '1.6.0', 'get_template_part' );
}

function wpex_blog_entry_image() {
	_deprecated_function( 'wpex_blog_entry_image', '1.6.0', 'get_template_part' );
}

function wpex_post_entry_author_avatar() {
	_deprecated_function( 'wpex_post_entry_author_avatar', '1.6.0', 'get_template_part' );
}

function wpex_blog_entry_title() {
	_deprecated_function( 'wpex_blog_entry_title', '1.6.0', 'get_template_part' );
}

function wpex_blog_entry_header() {
	_deprecated_function( 'wpex_blog_entry_header', '1.6.0', 'get_template_part' );
}

function wpex_blog_entry_content() {
	_deprecated_function( 'wpex_blog_entry_content', '1.6.0', 'get_template_part' );
}

function wpex_blog_entry_media() {
	_deprecated_function( 'wpex_blog_entry_media', '1.6.0', 'get_template_part' );
}

function wpex_blog_entry_link_format_image() {
	_deprecated_function( 'wpex_blog_entry_link_format_image', '1.6.0', 'get_template_part' );
}

function wpex_post_readmore_link() {
	_deprecated_function( 'wpex_post_readmore_link', '1.6.0', 'get_template_part' );
}

function wpex_blog_entry_video() {
	_deprecated_function( 'wpex_blog_entry_video', '1.6.0', 'get_template_part' );
}

function wpex_blog_entry_audio() {
	_deprecated_function( 'wpex_blog_entry_audio', '1.6.0', 'get_template_part' );
}

function wpex_post_meta() {
	_deprecated_function( 'wpex_post_meta', '1.6.0', 'get_template_part' );
}

function wpex_post_entry_classes() {
	_deprecated_function( 'wpex_post_entry_classes', '1.6.0' );
}
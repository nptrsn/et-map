<?php
/**
 * Setup theme hooks
 *
 * @package     Total
 * @subpackage  Framework
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.0.0
 */


/**
 * Array of theme hooks
 *
 * @since Total 2.0.0
 */
function wpex_theme_hooks() {
    return array(
        'wpex_hook_topbar_before',
        'wpex_hook_topbar_after',
        'wpex_hook_header_before',
        'wpex_hook_header_after',
        'wpex_hook_header_top',
        'wpex_hook_header_inner',
        'wpex_hook_header_bottom',
        'wpex_hook_wrap_before',
        'wpex_hook_wrap_after',
        'wpex_hook_wrap_top',
        'wpex_hook_wrap_bottom',
        'wpex_hook_main_before',
        'wpex_hook_main_after',
        'wpex_hook_main_top',
        'wpex_hook_main_bottom',
        'wpex_hook_primary_before',
        'wpex_hook_primary_after',
        'wpex_hook_content_before',
        'wpex_hook_content_top',
        'wpex_hook_content_bottom',
        'wpex_hook_content_after',
        'wpex_hook_sidebar_before',
        'wpex_hook_sidebar_after',
        'wpex_hook_sidebar_top',
        'wpex_hook_sidebar_bottom',
        'wpex_hook_sidebar_inner',
        'wpex_hook_footer_before',
        'wpex_hook_footer_after',
        'wpex_hook_footer_top',
        'wpex_hook_footer_bottom',
        'wpex_hook_footer_inner',
        'wpex_hook_main_menu_before',
        'wpex_hook_main_menu_after',
        'wpex_hook_main_menu_top',
        'wpex_hook_main_menu_bottom',
        'wpex_hook_page_header_before',
        'wpex_hook_page_header_after',
        'wpex_hook_page_header_top',
        'wpex_hook_page_header_inner',
        'wpex_hook_page_header_bottom',
        'wpex_hook_social_share_before',
        'wpex_hook_social_share_after',
        'wpex_hook_social_share_inner',
    );
}


/**
 * Topbar Hooks
 *
 * @since Total 2.0.0
 */
function wpex_hook_topbar_before() {
    do_action( 'wpex_hook_topbar_before' );
}
function wpex_hook_topbar_after() {
    do_action( 'wpex_hook_topbar_after' );
}


/**
 * Main Header Hooks
 *
 * @since Total 1.0.0
 */
function wpex_hook_header_before() {
    do_action( 'wpex_hook_header_before' );
}
function wpex_hook_header_after() {
    do_action( 'wpex_hook_header_after' );
}
function wpex_hook_header_top() {
    do_action( 'wpex_hook_header_top' );
}
function wpex_hook_header_inner() {
    do_action( 'wpex_hook_header_inner' );
}
function wpex_hook_header_bottom() {
    do_action( 'wpex_hook_header_bottom' );
}


/**
 * Wrap Hooks
 *
 * @since Total 1.0.0
 */
function wpex_hook_wrap_before() {
    do_action( 'wpex_hook_wrap_before' );
}
function wpex_hook_wrap_after() {
    do_action( 'wpex_hook_wrap_after' );
}
function wpex_hook_wrap_top() {
    do_action( 'wpex_hook_wrap_top' );
}
function wpex_hook_wrap_bottom() {
    do_action( 'wpex_hook_wrap_bottom' );
}


/**
 * Main Hooks
 *
 * @since Total 1.0.0
 */
function wpex_hook_main_before() {
    do_action( 'wpex_hook_main_before' );
}
function wpex_hook_main_after() {
    do_action( 'wpex_hook_main_after' );
}
function wpex_hook_main_top() {
    do_action( 'wpex_hook_main_top' );
}
function wpex_hook_main_bottom() {
    do_action( 'wpex_hook_main_bottom' );
}


/**
 * Primary Hooks
 *
 * @since Total 2.0.0
 */
function wpex_hook_primary_before() {
    do_action( 'wpex_hook_primary_before' );
}
function wpex_hook_primary_after() {
    do_action( 'wpex_hook_primary_after' );
}


/**
 * Content Hooks
 *
 * @since Total 1.0.0
 */
function wpex_hook_content_before() {
    do_action( 'wpex_hook_content_before' );
}
function wpex_hook_content_top() {
    do_action( 'wpex_hook_content_top' );
}
function wpex_hook_content_bottom() {
    do_action( 'wpex_hook_content_bottom' );
}
function wpex_hook_content_after() {
    do_action( 'wpex_hook_content_after' );
}


/**
 * Sidebar Hooks
 *
 * @since Total 1.0.0
 */
function wpex_hook_sidebar_before() {
    do_action( 'wpex_hook_sidebars_before' );
}
function wpex_hook_sidebar_after() {
    do_action( 'wpex_hook_sidebars_after' );
}
function wpex_hook_sidebar_top() {
    do_action( 'wpex_hook_sidebar_top' );
}
function wpex_hook_sidebar_bottom() {
    do_action( 'wpex_hook_sidebar_bottom' );
}
function wpex_hook_sidebar_inner() {
    do_action( 'wpex_hook_sidebar_inner' );
}


/**
 * Footer Hooks
 *
 * @since Total 1.0.0
 */
function wpex_hook_footer_before() {
    do_action( 'wpex_hook_footer_before' );
}
function wpex_hook_footer_after() {
    do_action( 'wpex_hook_footer_after' );
}
function wpex_hook_footer_top() {
    do_action( 'wpex_hook_footer_top' );
}
function wpex_hook_footer_bottom() {
    do_action( 'wpex_hook_footer_bottom' );
}
function wpex_hook_footer_inner() {
    do_action( 'wpex_hook_footer_inner' );
}


/**
 * Main Menu Hooks
 *
 * @since Total 1.0.0
 */
function wpex_hook_main_menu_before() {
    do_action( 'wpex_hook_main_menu_before' );
}
function wpex_hook_main_menu_after() {
    do_action( 'wpex_hook_main_menu_after' );
}
function wpex_hook_main_menu_top() {
    do_action( 'wpex_hook_main_menu_top' );
}
function wpex_hook_main_menu_bottom() {
    do_action( 'wpex_hook_main_menu_bottom' );
}


/**
 * Page Header Hooks
 *
 * @since Total 1.0.0
 */
function wpex_hook_page_header_before() {
    do_action( 'wpex_hook_page_header_before' );
}
function wpex_hook_page_header_after() {
    do_action( 'wpex_hook_page_header_after' );
}
function wpex_hook_page_header_top() {
    do_action( 'wpex_hook_page_header_top' );
}
function wpex_hook_page_header_inner() {
    do_action( 'wpex_hook_page_header_inner' );
}
function wpex_hook_page_header_bottom() {
    do_action( 'wpex_hook_page_header_bottom' );
}
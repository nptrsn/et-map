<?php
/*
Plugin Name: Faster Appearance - Menus
Plugin URI: http://sevenspark.com
Description: Fix the bottleneck created by accessibility enhancements to the Appearance > Menus screen in WordPress 3.6
Version: 0.1.1
Author: Chris Mavricos, SevenSpark
Author URI: http://sevenspark.com
License: GPLv2
Copyright 2013  Chris Mavricos, SevenSpark http://sevenspark.com
*/


// Only needed in the admin
if( ! is_admin() ) {
	return;
}

function fam_swap_core_script(){
	global $wp_scripts;
	$custom_script_url = get_template_directory_uri() .'/framework/classes/faster-menu-dashboard/faster-menu-dashboard.js';
	$wp_scripts->registered['nav-menu']->src = $custom_script_url;
	return;
}
add_action( 'admin_enqueue_scripts', 'fam_swap_core_script' , 3 );
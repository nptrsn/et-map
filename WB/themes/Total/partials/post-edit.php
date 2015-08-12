<?php
/**
 * Edit post link
 *
 * @package     Total
 * @subpackage  Partials
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

if ( ! wpex_has_post_edit() ) {
	return;
}

// Edit text
if ( is_page() ) {
    $edit_text = __( 'Edit This Page', 'wpex' );
} else {
    $edit_text = __( 'Edit This Post', 'wpex' );
}

// Display edit post link
edit_post_link(
    $edit_text,
    '<div class="post-edit clr">', ' <a href="#" class="hide-post-edit" title="'. __( 'Hide Post Edit Links', 'wpex' ) .'"><span class="fa fa-times"></span></a></div>'
); ?>
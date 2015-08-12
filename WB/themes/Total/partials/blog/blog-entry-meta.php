<?php
/**
 * Blog entry meta
 *
 * @package		Total
 * @subpackage	Partials/Blog
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.6.0
 * @version		1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if disabled
if ( ! get_theme_mod( 'blog_entry_meta', true ) ) {
	return;
}

// Get meta sections
$sections = wpex_blog_entry_meta_sections();

// Return if sections are empty
if ( empty( $sections ) ) {
	return;
}

// Add class for meta with title
$classes = 'meta clr';
if ( 'custom_text' == get_theme_mod( 'blog_single_header', 'custom_text' ) ) {
	$classes .= ' meta-with-title';
} ?>

<ul class="<?php echo $classes; ?>">

	<?php if ( in_array( 'date', $sections ) ) : ?>
		<li class="meta-date"><span class="fa fa-clock-o"></span><span class="updated"><?php echo get_the_date(); ?></span></li>
	<?php endif; ?>

	<?php if ( in_array( 'author', $sections ) ) : ?>
		<li class="meta-author"><span class="fa fa-user"></span><span class="vcard author"><?php the_author_posts_link(); ?></span></li>
	<?php endif; ?>

	<?php if ( in_array( 'categories', $sections ) ) : ?>
		<li class="meta-category"><span class="fa fa-folder-o"></span><?php the_category( ', ', get_the_ID() ); ?></li>
	<?php endif; ?>

	<?php if ( in_array( 'comments', $sections ) && comments_open() && ! post_password_required() ): ?>
		<li class="meta-comments comment-scroll"><span class="fa fa-comment-o"></span><?php comments_popup_link( __( '0 Comments', 'wpex' ), __( '1 Comment',  'wpex' ), __( '% Comments', 'wpex' ), 'comments-link' ); ?></li>
	<?php endif; ?>

</ul><!-- .<?php echo $classes; ?> -->
<?php
/**
 * Footer bottom content
 *
 * @package		Total
 * @subpackage	Partials/Footer
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.6.0
 * @version		1.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get global object
global $wpex_theme;

// Return if callout is disabled
if ( ! $wpex_theme->has_footer_callout ) {
	return;
}

// Get Content
if ( $wpex_theme->post_id && $meta = get_post_meta( $wpex_theme->post_id, 'wpex_callout_text', true ) ) {
	$content = $meta;
} else {
	$content = get_theme_mod( 'callout_text', 'I am the footer call-to-action block, here you can add some relevant/important information about your company or product. I can be disabled in the theme options.' );
}

// Bail if content is empty
if ( ! $content ) {
	return;
}

// Get link
if ( $wpex_theme->post_id && $meta = get_post_meta( $wpex_theme->post_id, 'wpex_callout_link', true ) ) {
	$link = $meta;
} else {
	$link = get_theme_mod( 'callout_link', 'http://www.wpexplorer.com' );
}

// Get link text
if ( $wpex_theme->post_id && $meta = get_post_meta( $wpex_theme->post_id, 'wpex_callout_link_txt', true ) ) {
	$link_text = $meta;
} else {
	$link_text	= get_theme_mod( 'callout_link_txt', 'Get In Touch' );
}

// If link is defined set target and rel
if ( $link ) {

	// Link target
	$target	= get_theme_mod( 'callout_button_target', 'blank' );
	$target	= ( 'blank' == $target ) ? ' target="_blank"' : '';

	// Link rel
	$rel	= get_theme_mod( 'callout_button_rel', false );
	$rel	= ( 'nofollow' == $rel ) ? ' rel="nofollow"' : '';

}

// Translate Theme mods
$content	= wpex_translate_theme_mod( 'callout_text', $content );
$link		= wpex_translate_theme_mod( 'callout_link', $link );
$link_text	= wpex_translate_theme_mod( 'callout_link_txt', $link_text ); ?>
	
<div id="footer-callout-wrap" class="clr <?php echo get_theme_mod( 'callout_visibility', 'always-visible' ); ?>">
	<div id="footer-callout" class="clr container">
		<div id="footer-callout-left" class="footer-callout-content clr <?php if ( ! $link ) echo 'full-width'; ?>">
			<?php
			// Echo the footer callout text
			echo do_shortcode( $content ); ?>
		</div><!-- #footer-callout-left -->
		<?php
		// Display footer callout button if callout link & text options are not blank in the admin
		if ( $link && $link_text ) : ?>
			<div id="footer-callout-right" class="footer-callout-button clr">
				<a href="<?php echo esc_url( $link ); ?>" class="theme-button footer-callout-button" title="<?php echo esc_attr( $link_text ); ?>"<?php echo $target; ?><?php echo $rel; ?>><?php echo $link_text; ?></a>
			</div><!-- #footer-callout-right -->
		<?php endif; ?>
	</div><!-- #footer-callout -->
</div><!-- #footer-callout-wrap -->	
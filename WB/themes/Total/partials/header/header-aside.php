<?php
/**
 * Header aside content used in Header Style Two, Three and Four
 *
 * @package		Total
 * @subpackage	Partials/Header
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.6.0
 * @version		2.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Global object
global $wpex_theme;

// Get header style
$header_style = $wpex_theme->header_style;

// Return for header style 1
if ( 'one' == $header_style ) {
	return;
}

// Get header aside content
$content = get_theme_mod( 'header_aside' );

// WPML translations
$copyright = wpex_translate_theme_mod( 'header_aside', $content );

// Check if we should display the header aside
if ( $content || ( get_theme_mod( 'main_search', true ) && 'two' == $header_style ) ) :

	// Add classes
	$classes = 'clr';
	if ( $header_style ) {
		$classes .= ' header-'. $header_style .'-aside';
	} ?>

	<aside id="header-aside" class="<?php echo $classes; ?>">

		<div class="header-aside-content clr">

			<?php echo do_shortcode( $content ); ?>

		</div><!-- .header-aside-content -->

		<?php
		// Show header search field if enabled in the theme options panel and it's header style 2
		if ( get_theme_mod( 'main_search', true ) && 'two' == $header_style ) : ?>

			<div id="header-two-search" class="clr">

				<form method="get" class="header-two-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
					<input type="search" id="header-two-search-input" name="s" value="<?php _e( 'search', 'wpex' ); ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/>
					<button type="submit" value="" id="header-two-search-submit" />
						<span class="fa fa-search"></span>
					</button>
				</form><!-- #header-two-searchform -->

			</div><!-- #header-two-search -->

		<?php endif; ?>

	</aside><!-- #header-two-aside -->

<?php endif; ?>
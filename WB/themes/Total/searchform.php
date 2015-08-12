<?php
/**
 * The template for displaying search forms
 *
 * @package     Total
 * @subpackage  Templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.0.0
 * @version     2.0.0
 */ ?>

<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="search" class="field" name="s" placeholder="<?php _e( 'search', 'wpex' ); ?>" />
    <button type="submit" class="searchform-submit">
		<span class="fa fa-search"></span>
	</button>
</form><!-- .searchform -->
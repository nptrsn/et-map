<?php
/**
 * The Header for our theme
 * See @ framework/hooks/actions.php for all actions attached to your header hooks.
 *
 * IMPORTANT :	There isn't any need to modify this template file, most edits can't be done via hooks
 * 				and filters	or the partial template parts at partials/header/.
 *
 * @package		Total
 * @subpackage	Templates
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.0.0
 * @version		2.0.0
 */ ?>
 
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<!-- Begin Body -->
<body <?php body_class(); ?>>

<div id="outer-wrap" class="clr">

	<?php wpex_hook_wrap_before(); ?>

	<div id="wrap" class="clr">

		<?php wpex_hook_wrap_top(); ?>

		<?php wpex_hook_main_before(); ?>

		<div id="main" class="site-main clr">

			<?php wpex_hook_main_top(); ?>
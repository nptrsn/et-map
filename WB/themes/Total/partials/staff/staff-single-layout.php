<?php
/**
 * Staff single layout
 *
 * @package		Total
 * @subpackage	Partials/Staff
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 2.0.0
 * @version		1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<?php get_template_part( 'partials/staff/staff-single', 'media' ); ?>
<?php get_template_part( 'partials/staff/staff-single', 'content' ); ?>
<?php get_template_part( 'partials/social', 'share' ); ?>
<?php get_template_part( 'partials/staff/staff-single', 'comments' ); ?>
<?php get_template_part( 'partials/staff/staff-single', 'related' ); ?>
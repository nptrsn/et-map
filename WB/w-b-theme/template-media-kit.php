<?php
/**
 * Template Name: Media Kit
 * File: template-media-kit.php
*/
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php the_content(); ?>

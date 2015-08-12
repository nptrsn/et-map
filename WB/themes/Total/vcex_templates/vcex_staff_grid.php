<?php
/**
 * Output for the staff grid Visual Composer module
 *
 * @package     Total
 * @subpackage  vcex_templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 2.0.0
 * @version     2.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Not needed in admin ever
if ( is_admin() ) {
	return;
}

// Extract shortcode attributes
$atts = shortcode_atts( array(
	'unique_id'                     => '',
	'term_slug'                     => '',
	'classes'                       => '',
	'columns_gap'                   => '',
	'visibility'                    => '',
	'css_animation'                 => '',
	'post_type'                     => 'staff',
	'tax_query'                     => '',
	'include_categories'            => '',
	'exclude_categories'            => '',
	'posts_per_page'                => '12',
	'grid_style'                    => 'fit_columns',
	'masonry_layout_mode'           => '',
	'filter_speed'                  => '',
	'masonry_layout_mode'           => '',
	'equal_heights_grid'            => '',
	'columns'                       => '',
	'columns_responsive'            => '',
	'order'                         => '',
	'orderby'                       => '',
	'orderby_meta_key'              => '',
	'filter'                        => '',
	'filter_taxonomy'               => 'staff_category',
	'center_filter'                 => '',
	'img_crop'                      => '',
	'img_size'                      => '',
	'img_width'                     => '',
	'img_height'                    => '',
	'thumb_link'                    => 'post',
	'thumb_lightbox_gallery'        => '',
	'thumb_lightbox_title'          => '',
	'thumb_lightbox_caption'        => '',
	'img_filter'                    => '',
	'title'                         => 'true',
	'title_link'                    => 'post',
	'excerpt'                       => 'true',
	'excerpt_length'                => '15',
	'custom_excerpt_trim'           => '',
	'read_more'                     => '',
	'readmore_style'                => 'flat',
	'readmore_background'           => '',
	'readmore_style_color'          => '',
	'readmore_color'                => '',
	'readmore_hover_color'          => '',
	'readmore_hover_background'     => '',
	'readmore_size'                 => '',
	'readmore_padding'              => '',
	'readmore_margin'               => '',
	'readmore_border_radius'        => '',
	'read_more_text'                => __( 'read more', 'wpex' ),
	'readmore_rarr'                 => '',
	'pagination'                    => 'false',
	'filter_content'                => 'false',
	'social_links'                  => '',
	'offset'                        => 0,
	'taxonomy'                      => '',
	'terms'                         => '',
	'img_hover_style'               => '',
	'img_rendering'                 => '',
	'all_text'                      => __( 'All', 'wpex' ),
	'overlay_style'                 => '',
	'entry_media'                   => '',
	'content_heading_margin'        => '',
	'content_heading_weight'        => '',
	'content_heading_transform'     => '',
	'content_heading_line_height'   => '',
	'content_background'            => '',
	'content_margin'                => '',
	'content_font_size'             => '',
	'content_padding'               => '',
	'content_border'                => '',
	'content_color'                 => '',
	'content_opacity'               => '',
	'content_heading_color'         => '',
	'content_heading_size'          => '',
	'content_alignment'             => '',
	'readmore_background'           => '',
	'readmore_color'                => '',
	'position'                      => '',
	'position_size'                 => '',
	'position_margin'               => '',
	'position_color'                => '',
	'single_column_style'           => '',
	'show_categories'               => '',
	'show_first_category_only'      => '',
	'lightbox_skin'                 => '',
	'categories_margin'             => '',
	'categories_font_size'          => '',
), $atts );

// Extract shortcode atts
extract( $atts );

// Fallback for term slug
if ( $term_slug ) {
	$include_categories = $term_slug;
}

// Build the WordPress query
$my_query = vcex_build_wp_query( $atts );

// Output posts
if ( $my_query->have_posts() ) :

	// Sanitize data & declare main variables
	$inline_js          = array();
	$grid_data          = array();
	$is_isotope         = false;
	$title              = ( 'false' != $title ) ? true : false;
	$excerpt            = ( 'false' != $excerpt ) ? true : false;
	$read_more          = ( 'false' != $read_more ) ? true : false;
	$excerpt_length     = $excerpt_length ? $excerpt_length : '30';
	$excerpt_length     = ( ! $excerpt ) ? '0' : $excerpt_length;
	$entry_media        = ( 'false' != $entry_media ) ? true : false;
	$center_filter      = 'yes' == $center_filter ? ' center' : '';
	$all_text           = $all_text ? $all_text : __( 'All', 'wpex' );
	$css_animation      = $css_animation ? $this->getCSSAnimation( $css_animation ) : '';
	$filter             = ( 'true' == $filter ) ? true : false;
	$css_animation      = ( $filter ) ? false : $css_animation;
	$overlay_style      = $overlay_style ? $overlay_style : 'none';
	$equal_heights_grid = ( 'true' == $equal_heights_grid ) ? true : false;
	$equal_heights_grid = ( $equal_heights_grid && $columns > '1' ) ? true : false;

	// Load custom lightbox skin
	if ( $lightbox_skin ) {
		vcex_enque_style( 'ilightbox', $lightbox_skin );
	}

	// Enable Isotope
	if ( $filter || 'masonry' == $grid_style || 'no_margins' == $grid_style ) {
		$is_isotope         = true;
		$equal_heights_grid = false;
	}

	// No need for masonry if not enough columns and filter is disabled
	if ( ! $filter && 'masonry' == $grid_style ) {
		$post_count = count( $my_query->posts );
		if ( $post_count <= $columns ) {
			$is_isotope = false;
		}
	}

	// Add inline js
	if ( $is_isotope ) {
		$inline_js[] = 'isotope';
	}
	if ( 'lightbox' == $thumb_link ) {
		$inline_js[] = 'ilightbox';
	}
	if ( $readmore_hover_color || $readmore_hover_background ) {
		$inline_js[] = 'data_hover';
	}
	if ( $equal_heights_grid ) {
		$inline_js[] = 'equal_heights';
	}
	if ( $inline_js ) {
		vcex_inline_js( $inline_js );
	}

	// Wrap classes
	$wrap_classes = array( 'vcex-staff-grid-wrap', 'clr' );
	if ( $visibility ) {
		$wrap_classes[] = $visibility;
	}
	if ( $classes ) {
		$wrap_classes[] = vcex_get_extra_class( $classes );
	}
	$wrap_classes = implode( ' ', $wrap_classes );

	// Grid classes
	$grid_classes = array( 'wpex-row', 'vcex-staff-grid', 'clr' );
	if ( $columns_gap ) {
		$grid_classes[] = 'gap-'. $columns_gap;
	}
	if ( $is_isotope ) {
		$grid_classes[] = 'vcex-isotope-grid';
	}
	if ( 'no_margins' == $grid_style ) {
		$grid_classes[] = 'vcex-no-margin-grid';
	}
	if ( 'left_thumbs' == $single_column_style ) {
		$grid_classes[] = 'left-thumbs';
	}
	if ( $equal_heights_grid ) {
		$grid_classes[] = 'match-height-grid';
	}
	if ( 'true' == $thumb_lightbox_gallery ) {
		$grid_classes[] = ' lightbox-group';
		if ( $lightbox_skin ) {
			$grid_data[] = 'data-skin="'. $lightbox_skin .'"';
		}
		$lightbox_single_class = ' lightbox-group-item';
	} else {
		$lightbox_single_class = ' wpex-lightbox';
	}
	$grid_classes = implode( ' ', $grid_classes );

	// Grid data attributes
	if ( $is_isotope && $filter ) {
		if ( 'no_margins' != $grid_style && $masonry_layout_mode ) {
			$grid_data[] = 'data-layout-mode="'. $masonry_layout_mode .'"';
		}
		if ( $filter_speed ) {
			$grid_data[] = 'data-transition-duration="'. $filter_speed .'"';
		} elseif ( '0' == $filter_speed ) {
			$grid_data[] = 'data-transition-duration="0.0"';
		}
	}
	if ( ! $filter ) {
		$grid_data[] = 'data-transition-duration="0.0"';
	}
	if ( 'no_margins' == $grid_style && ! $filter ) {
		$grid_data[] = 'data-transition-duration="0.0"';
	}
	$grid_data = implode( ' ', $grid_data );

	// Media classes
	$media_classes = array( 'staff-entry-media' );
	if ( $img_filter ) {
		$media_classes[] = wpex_image_filter_class( $img_filter );
	}
	if ( $img_hover_style ) {
		$media_classes[] = wpex_image_hover_classes( $img_hover_style );
	}
	if ( $img_rendering ) {
		$media_classes[] = wpex_image_rendering_class( $img_rendering );
	}
	if ( 'none' != $overlay_style ) {
		$media_classes[] = wpex_overlay_classes( $overlay_style );
	}
	$media_classes = implode( ' ', $media_classes );

	// Content Design
	$content_style = vcex_inline_style( array(
		'background'    => $content_background,
		'padding'       => $content_padding,
		'margin'        => $content_margin,
		'border'        => $content_border,
		'color'         => $content_color,
		'opacity'       => $content_opacity,
		'text_align'    => $content_alignment,
	) );

	// Heading Design
	$heading_style = vcex_inline_style( array(
		'margin'            => $content_heading_margin,
		'font_size'         => $content_heading_size,
		'color'             => $content_heading_color,
		'font_weight'       => $content_heading_weight,
		'text_transform'    => $content_heading_transform,
		'line_height'       => $content_heading_line_height,
	) );

	// Heading Link style
	$heading_link_style = vcex_inline_style( array(
		'color' => $content_heading_color,
	) );

	// Position design
	if ( 'true' == $position ) {
		$position_style = vcex_inline_style( array(
			'font_size' => $position_size,
			'margin'    => $position_margin,
			'color'     => $position_color,
		) );
	}

	// Categories design
	if ( 'true' == $show_categories ) {
		$categories_style = vcex_inline_style( array(
			'margin'    => $categories_margin,
			'font_size' => $categories_font_size,
		) );
	}

	// Excerpt style
	if ( $excerpt ) {
		$excerpt_style = vcex_inline_style( array(
			'font_size' => $content_font_size,
		) );
	}

	// Readmore design
	if ( $read_more ) {

		// Readmore classes
		$readmore_classes   = array( 'vcex-button', 'animate-on-hover' );
		if ( $readmore_hover_color || $readmore_hover_background ) {
			$readmore_classes[] = 'wpex-data-hover';
		}
		$readmore_classes[] = $readmore_style;
		$readmore_classes[] = $readmore_style_color;
		$readmore_classes   = implode( ' ', $readmore_classes );

		// Readmore style
		$readmore_style = vcex_inline_style( array(
			'background'    => $readmore_background,
			'color'         => $readmore_color,
			'font_size'     => $readmore_size,
			'padding'       => $readmore_padding,
			'border_radius' => $readmore_border_radius,
			'margin'        => $readmore_margin,
		) );

		// Readmore data
		$readmore_data = array();
		if ( $readmore_hover_color ) {
			$readmore_data[] = 'data-hover-color="'. $readmore_hover_color .'"';
		}
		if ( $readmore_hover_background ) {
			$readmore_data[] = 'data-hover-background="'. $readmore_hover_background .'"';
		}
		$readmore_data = ' '. implode( ' ', $readmore_data );
	} ?>

	<div class="<?php echo $wrap_classes; ?>">
	
		<?php
		// Display filter links
		if ( $filter && taxonomy_exists( 'staff_category' ) ) : ?>

			<?php
			// Define filter args
			$args = vcex_grid_filter_args( $atts );

			// Get filter terms
			$terms = get_terms( 'staff_category', $args ); ?>

			<?php if ( $terms && count( $terms ) > '1' ) : ?>

				<ul class="vcex-staff-filter vcex-filter-links clr<?php echo $center_filter; ?>">
					<li class="active"><a href="#" data-filter="*"><span><?php echo $all_text; ?></span></a></li>
					<?php foreach ( $terms as $term ) : ?>
						<li class="filter-cat-<?php echo $term->term_id; ?>"><a href="#" data-filter=".cat-<?php echo $term->term_id; ?>"><?php echo $term->name; ?></a></li>
					<?php endforeach; ?>
				</ul><!-- .vcex-staff-filter -->

			<?php endif; ?>

		<?php endif; ?>

		<div class="<?php echo $grid_classes; ?>"<?php vcex_unique_id( $unique_id ); ?><?php echo $grid_data; ?>>
			<?php
			// Define counter var to clear floats
			$count = 0;

			// Start loop
			while ( $my_query->have_posts() ) :

				// Get post from query
				$my_query->the_post();

				// Create new post object
				$post = new stdClass();

				// Post Data
				$post->ID           = get_the_ID();
				$post->permalink    = wpex_get_permalink( $post->ID );
				$post->excerpt      = '';

				// Post Excerpt
				if ( $excerpt || 'true' == $thumb_lightbox_caption ) {
					$post->excerpt = vcex_get_excerpt( $excerpt_length );
				}

				// Add to the counter var
				$count++;

				// Add classes to the entries
				$entry_classes = array( 'staff-entry' );
				$entry_classes[] = 'span_1_of_'. $columns;
				if ( 'false' == $columns_responsive ) {
					$entry_classes[] = 'nr-col';
				} else {
					$entry_classes[] = 'col';
				}
				if ( $count ) {
					$entry_classes[] = 'col-'. $count;
				}
				if ( $read_more ) {
					$entry_classes[] = 'has-readmore';
				}
				if ( $css_animation ) {
					$entry_classes[] = $css_animation;
				}
				if ( $is_isotope ) {
					$entry_classes[] = 'vcex-isotope-entry';
				}
				if ( 'no_margins' == $grid_style ) {
					$entry_classes[] = 'vcex-no-margin-entry';
				}
				if ( taxonomy_exists( 'staff_category' ) ) {
					$post_terms = get_the_terms( $post->ID, 'staff_category' );
					if ( $post_terms ) {
						foreach ( $post_terms as $post_term ) {
							$entry_classes[] = 'cat-'. $post_term->term_id;
						}
					}
				} ?>

				<div <?php post_class( $entry_classes ); ?>>

					<?php
					//Featured Image
					if ( $entry_media && has_post_thumbnail() ) : ?>

						<div class="<?php echo $media_classes; ?>">
							<?php if ( ! in_array( $thumb_link, array( 'none', 'nowhere' ) ) ) : ?>
								
								<?php
								// Lightbox link
								if ( $thumb_link == 'lightbox' ) : ?>

									<?php
									// Lightbox data
									if ( 'lightbox' == $thumb_link ) {

										// Define variable
										$lightbox_data = array();

										// Add lightbox skin style
										if ( $lightbox_skin && 'true' !== $thumb_lightbox_gallery ) {
											$lightbox_data[] = 'data-skin="'. $lightbox_skin .'"';
										}

										// Add lightbox title
										if ( 'true' == $thumb_lightbox_title ) {
											$lightbox_data[] = 'data-title="'. wpex_get_esc_title() .'"';
										}

										// Lightbox Excerpt
										if ( 'true' == $thumb_lightbox_caption && $post->excerpt ) {
											$lightbox_data[] = 'data-caption="'. str_replace( '"',"'", $post->excerpt ) .'"';
										}

										// Turn lightbox data into string
										$lightbox_data = ' '. implode( ' ', $lightbox_data );

									} ?>

									<a href="<?php wpex_lightbox_image(); ?>" title="<?php wpex_esc_title(); ?>" class="staff-entry-media-link<?php echo $lightbox_single_class; ?>"<?php echo $lightbox_data; ?>>

								<?php else : ?>

									<a href="<?php echo $post->permalink; ?>" title="<?php wpex_esc_title(); ?>" class="staff-entry-media-link">

								<?php endif; ?>
							
							<?php endif; ?>

								<?php
								// Output post thumbnail
								wpex_post_thumbnail( array(
									'size'      => $img_size,
									'crop'      => $img_crop,
									'width'     => $img_width,
									'height'    => $img_height,
									'alt'       => wpex_get_esc_title(),
								) ); ?>

							<?php
							// Close link and output inside overlay HTML
							if ( ! in_array( $thumb_link, array( 'none', 'nowhere' ) ) ) : ?>

								<?php
								// Inner Overlay
								wpex_overlay( 'inside_link', $overlay_style ); ?>

								</a>

							<?php endif; ?>

							<?php
							// Outside Overlay
							wpex_overlay( 'outside_link', $overlay_style ); ?>

						</div><!-- .staff-media -->

					<?php endif; ?>

					<?php
					// Display details
					if ( 'true' == $title || 'true' == $excerpt || 'true' == $read_more || 'true' == $position ) : ?>

						<div class="staff-entry-details clr" <?php echo $content_style; ?>>

							<?php
							// Equal height div
							if ( $equal_heights_grid && ! $is_isotope ) echo '<div class="match-height-content">'; ?>

							<?php
							// Display the title
							if ( 'true' == $title ) : ?>

								<h2 class="staff-entry-title entry-title"<?php echo $heading_style; ?>>

									<?php
									// Display title and link to post
									if ( 'post' == $title_link ) : ?>

										<a href="<?php echo $post->permalink; ?>" title="<?php wpex_esc_title(); ?>"<?php echo $heading_link_style; ?>><?php the_title(); ?></a>

									<?php
									// Display title and link to lightbox
									elseif ( 'lightbox' == $title_link ) : ?>

										<a href="<?php wpex_lightbox_image(); ?>" title="<?php wpex_esc_title(); ?>"<?php echo $heading_link_style; ?>><?php the_title(); ?></a>

									<?php
									// Display title without link
									else : ?>

										<?php the_title(); ?>

									<?php endif; ?>

								</h2><!-- .staff-entry-title -->

							<?php endif; ?>

							<?php
							// Display staff member position
							if ( 'true' == $position && $get_position = get_post_meta( $post->ID, 'wpex_staff_position', true ) ) : ?>

								<div class="staff-entry-position" <?php echo $position_style; ?>>
									<?php echo $get_position; ?>
								</div><!-- .staff-entry-position -->

							<?php endif; ?>

							<?php
							// Display categories
							if ( 'true' == $show_categories ) : ?>

								<div class="staff-entry-categories clr"<?php echo $categories_style; ?>>
									<?php if ( $show_first_category_only ) { ?>
										<?php wpex_first_term_link( $post->ID, 'staff_category' ); ?>
									<?php } else { ?>
										<?php wpex_list_post_terms( 'staff_category', true, true ); ?>
									<?php } ?>
								</div><!-- .staff-entry-categories -->

							<?php endif; ?>

							<?php
							// Display excerpt and readmore
							if ( $post->excerpt ) : ?>

								<div class="staff-entry-excerpt clr"<?php echo $excerpt_style; ?>>
									<?php echo $post->excerpt; ?>
								</div><!-- .staff-entry-excerpt -->

							<?php endif; ?>

							<?php
							// Display social links
							if ( 'true' == $social_links ) : ?>

								<?php echo wpex_get_staff_social(); ?>

							<?php endif; ?>

							<?php
							// Display Readmore
							if ( $read_more && $read_more_text ) : ?>

								<div class="staff-entry-readmore-wrap clr">

									<a href="<?php echo $post->permalink; ?>" title="<?php echo esc_attr( $read_more_text ); ?>" rel="bookmark" class="<?php echo $readmore_classes; ?>"<?php echo $readmore_style; ?><?php echo $readmore_data; ?>>
										<?php echo $read_more_text; ?>
										<?php if ( 'true' == $readmore_rarr ) { ?>
											<span class="vcex-readmore-rarr"><?php echo wpex_element( 'rarr' ); ?></span>
										<?php } ?>
									</a>

								</div><!-- .staff-entry-readmore-wrap -->

							<?php endif; ?>

							<?php
							// Close Equal height div
							if ( $equal_heights_grid && ! $is_isotope ) echo '</div>'; ?>

						</div><!-- .staff-entry-details -->

					<?php endif; // End staff entry details check ?>

				</div><!-- .staff-entry -->

				<?php
				// Reset counter
				if ( $count == $columns )  $count = ''; ?>

			<?php endwhile; ?>

		</div><!-- .vcex-staff-grid -->
					
		<?php
		// Display pagination if enabled
		if ( 'true' == $pagination ) : ?>
			<?php wpex_pagination( $my_query ); ?>
		<?php endif; ?>

	</div><!-- <?php echo $wrap_classes; ?> -->

	<?php
	// Remove post object from memory
	$post = null;

	// Reset the post data to prevent conflicts with WP globals
	wp_reset_postdata(); ?>

<?php
// If no posts are found display message
else : ?>

	<?php
	// Display no posts found error if function exists
	echo vcex_no_posts_found_message( $atts ); ?>

<?php
// End post check
endif; ?>
<?php
/**
 * Featured area content.
 *
 * @package Checathlon
 */

// Get featured area content.
$featured_area = esc_attr( checathlon_get_fp_featured_content() );

if ( 'jetpack-portfolio' === $featured_area ) :

	// Jetpack portfolio query.
	$featured_content_args = apply_filters( 'checathlon_front_page_jetpack_portfolios', array(
		'post_type'      => 'jetpack-portfolio',
		'posts_per_page' => 2,
		'no_found_rows'  => true,
	) );

elseif ( 'portfolio-project' === $featured_area ) :

	// Portfolio project query.
	$featured_content_args = apply_filters( 'checathlon_front_page_portfolio_projects', array(
		'post_type'      => 'portfolio_project',
		'posts_per_page' => 2,
		'no_found_rows'  => true,
	) );

elseif ( 'download' === $featured_area ) :

	// Downloads query.
	$featured_content_args = apply_filters( 'checathlon_front_page_downloads', array(
		'post_type'      => 'download',
		'posts_per_page' => 2,
		'no_found_rows'  => true,
	) );

	// Show from download_tag.
	if ( get_theme_mod( 'featured_area_downloads_tag' ) ) :
		$featured_content_args['tax_query'] = array(
			array(
				'taxonomy' => 'download_tag',
				'field'    => 'slug',
				'terms'    => esc_attr( get_theme_mod( 'featured_area_downloads_tag' ) ),
			),
		);
	endif;

elseif ( 'select-pages' === $featured_area ) :

	// Selected pages query.
	$featured_content_args = apply_filters( 'checathlon_front_page_selected_pages', array(
		'post_type'      => 'page',
		'post__in'       => checathlon_featured_pages(),
		'posts_per_page' => checathlon_how_many_selected_pages(),
		'no_found_rows'  => true,
		'orderby'        => 'post__in',
	) );

endif;

// Featured Content Query.
$featured_content = new WP_Query( $featured_content_args );

// Output featured area.
if ( 'nothing' !== $featured_area && $featured_content->have_posts() ) : ?>

	<div id="front-page-featured-area" class="front-page-featured-area front-page-area">

	<?php echo checathlon_get_featured_area_title_html(); ?>

		<div class="grid-wrapper grid-wrapper-2">

			<?php
				while ( $featured_content->have_posts() ) : $featured_content->the_post();

					if ( 'jetpack-portfolio' === $featured_area ) :
						get_template_part( 'template-parts/content', 'jetpack-portfolio' );
					elseif ( 'portfolio-project' === $featured_area ) :
						get_template_part( 'template-parts/content', 'portfolio_project' );
					elseif ( 'download' === $featured_area ) :
						get_template_part( 'template-parts/content', 'download' );
					elseif ( 'select-pages' === $featured_area ) :
						get_template_part( 'template-parts/content', 'page' );
					endif;

				endwhile;
			?>

		</div><!-- .grid-wrapper -->
	</div><!-- .front-page-featured-area -->

<?php
	endif; // End loop.
	wp_reset_postdata(); // Reset post data.

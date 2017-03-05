<?php
/**
 * Testimonials area content.
 *
 * @package Checathlon
 */

// Toot testimonial plugin (or any other standard) wins over Jetpack testimonial.
$testimonial_post_type = post_type_exists( 'testimonial' ) ? 'testimonial' : 'jetpack-testimonial';

// Testimonials Query.
$testimonials = new WP_Query( apply_filters( 'checathlon_front_page_testimonials', array(
	'post_type'      => $testimonial_post_type,
	'posts_per_page' => 3,
	'no_found_rows'  => true,
) ) );

if ( $testimonials->have_posts() && ! checathlon_get_fp_hide_testimonials() ) : ?>

	<div id="front-page-testimonial-area" class="front-page-testimonial-area front-page-area">

		<?php echo checathlon_get_testimonial_area_title_html(); ?>

		<div class="grid-wrapper grid-wrapper-3 grid-wrapper-testimonial">

			<?php
				while ( $testimonials->have_posts() ) : $testimonials->the_post();

					get_template_part( 'template-parts/content', 'jetpack-testimonial' );

				endwhile;
			?>

		</div><!-- .grid-wrapper -->

	</div><!-- .front-page-testimonial-area -->

<?php
	endif; // End loop.
	wp_reset_postdata(); // Reset post data.

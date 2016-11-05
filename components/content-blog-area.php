<?php
/**
 * Blog area content.
 *
 * @package Checathlon
 */

// Blog Query.
$blog_posts = new WP_Query( apply_filters( 'checathlon_front_page_posts', array(
	'post_type'      => 'post',
	'posts_per_page' => 2,
	'no_found_rows'  => true,
) ) );

if ( $blog_posts->have_posts() && ! checathlon_get_fp_hide_blog_posts() ) : ?>

	<div id="front-page-blog-area" class="front-page-blog-area front-page-area">

	<?php echo checathlon_get_blog_area_title_html() ; ?>

		<div class="blog-wrapper">

			<?php
				while ( $blog_posts->have_posts() ) : $blog_posts->the_post();

					get_template_part( 'template-parts/content', '' );

				endwhile;
			?>

		</div><!-- .blog-wrapper -->
	</div><!-- .front-page-blog-area -->

<?php
	endif; // End loop.
	wp_reset_postdata(); // Reset post data.

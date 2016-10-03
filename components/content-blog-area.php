<?php
/**
 * Blog area content.
 *
 * @package Checathlon
 */

// Blog Query.
$posts = new WP_Query( apply_filters( 'checathlon_front_page_posts', array(
	'post_type'      => 'post',
	'posts_per_page' => 2,
	'no_found_rows'  => true,
) ) );

if ( $posts->have_posts() && ! checathlon_get_fp_hide_blog_posts() ) : ?>
				
	<div id="front-page-blog-area" class="front-page-blog-area front-page-area">
					
	<?php echo checathlon_get_blog_area_title_html() ; ?>
					
		<div class="blog-wrapper">			

			<?php
				while ( $posts->have_posts() ) : $posts->the_post();
			
					get_template_part( 'template-parts/content', '' );
				
				endwhile;
			?>

		</div><!-- .blog-wrapper -->
	</div><!-- .front-page-blog-area -->

<?php
	endif; // End loop.
	wp_reset_postdata(); // Reset post data.
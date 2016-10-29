<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Checathlon
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			// Previous/next post navigation.
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next', 'checathlon' ) . checathlon_get_svg( array( 'icon' => 'arrow-circle-right' ) ) . '</span> ' .
					'<span class="screen-reader-text">' . esc_html__( 'Next post:', 'checathlon' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . checathlon_get_svg( array( 'icon' => 'arrow-circle-left' ) ) . esc_html__( 'Previous', 'checathlon' ) . '</span> ' .
					'<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'checathlon' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			get_template_part( 'widget-areas/sidebar', 'after-content' );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

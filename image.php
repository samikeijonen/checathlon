<?php
/**
 * The template for displaying images.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Checathlon
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry-inner-singular">

						<header class="entry-header page-header text-center">
							<?php the_title( '<h1 class="entry-title title-font no-margin-bottom text-italic">', '</h1>' ); ?>
						</header><!-- .entry-header -->

						<div class="entry-media">
						<?php
							if ( has_excerpt() ) :
								$src = wp_get_attachment_image_src( get_the_ID(), 'full' );
								echo img_caption_shortcode( array( 'align' => 'aligncenter', 'width' => esc_attr( $src[1] ), 'caption' => get_the_excerpt() ), wp_get_attachment_image( get_the_ID(), 'full', false ) );
							else :
								echo wp_get_attachment_image( get_the_ID(), 'full', false, array( 'class' => 'aligncenter' ) );
							endif;
						?>
					</div><!-- .entry-media -->

						<div class="entry-inner-singular-wrapper">

							<div class="entry-inner-content">
								<div class="entry-content">
								<?php
									the_content();
								?>
								</div><!-- .entry-content -->
							</div><!-- .entry-inner-content -->

						</div><!-- .entry-inner-singular-wrapper -->

				</div><!-- .entry-inner-singular -->

			</article><!-- #post-## -->

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

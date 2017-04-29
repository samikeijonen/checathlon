<?php
/**
 * Template Name: Pricing Page
 *
 * This is the page template for displaying Pricing Widgets.
 *
 * @package Checathlon
 */

get_header(); ?>

	<div id="primary" class="content-area main-padding">
		<main id="main" class="site-main main-width" role="main">

			<?php
			while ( have_posts() ) : the_post();
			?>

				<header class="page-header">

					<?php the_title( '<h1 class="page-title title-font no-margin-bottom text-center text-italic">', '</h1>' ); ?>

					<?php
					// Check subtitle.
					$subtitle = '';
					if ( function_exists( 'get_the_subtitle' ) ) :
						$subtitle = get_the_subtitle();
					endif;

					// Get page content.
					$content = trim( get_the_content() );

					// Show content if there is, and there is no subtitle.
					if ( '' !== $content && '' === $subtitle ) : ?>
						<div class="entry-team-page-content archive-description text-center soft-color">
							<?php the_content(); ?>
						</div><!-- .entry-team-page-content -->
					<?php endif; ?>

				</header><!-- .page-header -->

				<?php get_template_part( 'widget-areas/sidebar', 'pricing-page' ); // Load pricing table widgets.

				// Content if there is Subtitle.
				if ( '' !== $content && '' !== $subtitle ) : ?>
					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
				<?php endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

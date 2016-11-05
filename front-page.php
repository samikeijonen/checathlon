<?php
/**
 * Front Page Template
 *
 * This is the template for displaying Front Page.
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
					$content = trim( get_the_content() ); // Get page content.
					if( '' !== $content ) : ?>
						<div class="entry-front-page-content archive-description text-center soft-color">
							<?php the_content(); ?>
						</div><!-- .entry-front-page-content -->
					<?php endif; ?>

				</header><!-- .page-header -->

			<?php
			endwhile; // End of the loop.

			// Load service and pricing table widgets.
			get_template_part( 'template-parts/content', 'service-pricing-area' );

			// Load featured area.
			get_template_part( 'template-parts/content', 'featured-area' );

			// Load featured area.
			get_template_part( 'template-parts/content', 'testimonials-area' );

			// Load Front Page Widget area.
			get_template_part( 'widget-areas/sidebar', 'front-page' );

			// Load blog area
			get_template_part( 'template-parts/content', 'blog-area' );

			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

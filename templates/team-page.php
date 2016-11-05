<?php
/**
 * Template Name: Team Page
 *
 * This is the page template for displaying Child Pages as of this page wich are used as team page.
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
						<div class="entry-team-page-content archive-description text-center soft-color">
							<?php the_content(); ?>
						</div><!-- .entry-team-page-content -->
					<?php endif; ?>

				</header><!-- .page-header -->

				<?php get_template_part( 'template-parts/content', 'team-page' ); // Load template-parts/content-team-page.php template.

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

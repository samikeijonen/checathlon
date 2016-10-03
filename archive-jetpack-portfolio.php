<?php
/**
 * The template for displaying archive pages for Jetpack portfolios.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Checathlon
 */

get_header(); ?>

	<div id="primary" class="content-area main-padding">
		<main id="main" class="site-main main-width" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					// Get Jetpack options for portfolios.
					$jetpack_portfolio_title   = get_option( 'jetpack_portfolio_title' );
					$jetpack_portfolio_content = get_option( 'jetpack_portfolio_content' );
					
					// Use Jetpack portfolio title if it's set.
					if( isset( $jetpack_portfolio_title ) && $jetpack_portfolio_title ) :
						echo '<h1 class="page-title title-font no-margin-bottom text-center text-italic">' .esc_html( $jetpack_portfolio_title ) . '</h1>';
					else :
						the_archive_title( '<h1 class="page-title title-font no-margin-bottom text-center text-italic">', '</h1>' );
					endif;
					
					// Use Jetpack portfolio content if it's set.
					if( isset( $jetpack_portfolio_content ) && $jetpack_portfolio_content ) :
						echo '<div class="archive-description text-center soft-color">' . wp_kses_post( $jetpack_portfolio_content ) . '</div>';
					else :
						the_archive_description( '<div class="archive-description text-center soft-color">', '</div>' );
					endif;
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			echo '<div class="grid-wrapper grid-wrapper-2">';
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Type-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;
			echo '</div><!-- .grid-wrapper -->';

			// Previous/next page navigation. Function is located in inc/template-tags.php.
			checathlon_posts_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

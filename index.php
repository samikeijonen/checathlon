<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Checathlon
 */

get_header(); ?>

	<div id="primary" class="content-area main-padding">
		<main id="main" class="site-main main-width" role="main">

		<?php
		if ( have_posts() ) :
		
			$description = get_bloginfo( 'description', 'display' );
			if ( is_home() && is_front_page() && $description && ! is_paged() || is_customize_preview() ) : ?>
				<header class="page-header">
					<p class="site-description page-title no-margin-bottom text-center text-italic"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				</header>
			<?php
			endif;

			if ( is_home() && ! is_front_page() && ! is_paged() ) : ?>
				<header class="page-header">
					<h1 class="page-title no-margin-bottom text-center text-italic"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			if ( is_home() ) :
				echo '<div class="blog-wrapper">';
			endif;
			
				while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

				endwhile;
				
			if ( is_home() && ! is_front_page() ) :
				echo '</div><!-- .blog-wrapper -->';
			endif;

			// Previous/next page navigation. Function is located in inc/template-tags.php.
			checathlon_posts_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

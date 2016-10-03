<?php
/**
 * Template Name: Account Page
 *
 * User needs to be logged in to see content of this page.
 *
 * @package Checathlon
 */

get_header(); ?>

	<div id="primary" class="content-area main-padding">
		<main id="main" class="site-main main-width" role="main">

			<?php
				while ( have_posts() ) : the_post();
				
					if ( is_user_logged_in() ) :
						get_template_part( 'template-parts/content', 'page' ); // Load template-parts/content-page.php template.
					else : ?>
						<header class="page-header">
							<?php the_title( '<h1 class="page-title title-font no-margin-bottom text-center text-italic">', '</h1>' ); ?>
						</header><!-- .page-header -->
						<div class="entry-login-form entry-content">
							<p class="soft-color text-center">
								<?php esc_html_e( 'You must be logged in to view the content of this page.', 'checathlon' ); ?>
							</p>
							<?php wp_login_form(); ?>
							<p class="login-lost-password no-margin-bottom">
								<a href="<?php echo wp_lostpassword_url( esc_url( get_permalink() ) ); ?>"><?php esc_html_e( 'Lost password?', 'checathlon' ); ?></a>
							</p>
						</div><!-- .entry-login-form -->
					<?php
					endif;
					
				endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

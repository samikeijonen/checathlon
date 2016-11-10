<?php
/**
 * The board template file.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Checathlon
 */

get_header(); ?>

	<div id="primary" class="content-area main-padding">
		<main id="main" class="site-main main-width" role="main">
			<div class="mb-wrapper">

				<?php
				/*
				 * Action hook for the plugin to output its content. Technically, what this will
				 * do is load one of the `content-*.php` template parts for the specific page
				 * that is being viewed. Themes can either overwrite those template parts or
				 * overwrite this entire template.
				 */
				do_action( 'mb_theme_compat' );
				?>

			</div><!-- .mb-wrapper -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

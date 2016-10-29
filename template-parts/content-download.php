<?php
/**
 * Template part for displaying downloads.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Checathlon
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( is_singular() && ! checathlon_is_featured_page() && ! checathlon_is_front_page() ) : // If single. ?>

		<div class="entry-inner-singular">

			<header class="entry-header page-header text-center">
				<?php the_title( '<h1 class="entry-title title-font no-margin-bottom text-italic">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<?php checathlon_post_thumbnail( $post_thumbnail = 'checathlon-singular' ) ?>

			<div class="entry-inner-singular-wrapper">

				<?php get_template_part( 'widget-areas/sidebar', 'downloads' ); // Loads the sidebar-downloads.php template.?>

				<div class="entry-inner-content">
					<div class="entry-content">
						<?php
							the_content();
						?>
					</div><!-- .entry-content -->
				</div><!-- .entry-inner-content -->

			</div><!-- .entry-inner-singular-wrapper -->

		</div><!-- .entry-inner-singular -->

	<?php else : ?>

		<div class="entry-inner-wrapper">

		<?php
			// Get featured image as post background image.
			$checathlon_bg = checathlon_post_background( 'medium_large' );
		?>
		<div class="entry-header-bg"<?php if ( has_post_thumbnail() ) echo ' style="background-image:url(' . esc_url( $checathlon_bg ) . ');"' ?>>
			<?php the_title( '<a class="entry-header-bg-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark"><span class="screen-reader-text">' . esc_html__( 'Continue reading', 'checathlon' ) . ' ', '</span></a>' ); ?>
		</div>

		<div class="entry-inner">

			<header class="entry-header">
				<?php
					get_template_part( 'entry-meta' );
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				?>
			</header><!-- .entry-header -->

			<div class="entry-summary">
				<?php
					echo '<p class="product-price-p product-price soft-color medium-font-weight">' . chucathlon_get_download_price() . '</p>';

					the_excerpt();
				?>
			</div><!-- .entry-summary -->

		</div><!-- .entry-inner -->

		<?php
			get_template_part( 'entry-product-info' );
		?>

	</div><!-- .entry-inner-wrapper -->

	<?php endif; // End check single. ?>

</article><!-- #post-## -->

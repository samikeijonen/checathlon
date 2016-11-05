<?php
/**
 * Template part for displaying Jetpack portfolios.
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

			<div class="entry-inner-content">
				<div class="entry-content">
					<?php
						the_content();

						wp_link_pages( array(
							'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'checathlon' ),
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
							'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'checathlon' ) . ' </span>%',
							'separator'   => '<span class="screen-reader-text">,</span> ',
						) );
					?>
				</div><!-- .entry-content -->
			</div><!-- .entry-inner-content -->

		</div><!-- .entry-inner-singular -->

	<?php else : ?>

		<div class="entry-inner-wrapper">

			<?php
				// Get featured image as post background image.
				echo checathlon_get_bg_header( array( 'size' => 'checathlon-product', 'icon' => 'star' ) );
			?>

		<div class="entry-inner">

			<header class="entry-header">
				<?php
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				?>
			</header><!-- .entry-header -->

			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->

		</div><!-- .entry-inner -->

	</div><!-- .entry-inner-wrapper -->

	<?php endif; // End check single. ?>

</article><!-- #post-## -->

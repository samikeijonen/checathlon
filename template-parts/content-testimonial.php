<?php
/**
 * Template part for displaying Toot testimonials.
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

			<?php checathlon_post_thumbnail( $post_thumbnail = 'checathlon-small' ) ?>

			<div class="entry-inner-content">
				<div class="entry-content">
				<?php
					the_content();
				?>
				</div><!-- .entry-content -->
			</div><!-- .entry-inner-content -->

			<?php get_template_part( 'misc/entry', 'footer' ); // Loads the misc/entry-footer.php file. ?>

		</div><!-- .entry-inner-singular -->

	<?php else : ?>

		<div class="entry-inner-wrapper">

			<div class="entry-inner">

				<?php echo checathlon_get_svg( array( 'icon' => 'quotes-left' ) ); ?>

				<div class="entry-summary">
				<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->

			</div><!-- .entry-inner -->

			<div class="entry-thumbnail">
				<?php
				if ( ! has_post_thumbnail() ) :
					echo '<span class="testimonial-icon-wrapper">' . checathlon_get_svg( array( 'icon' => 'user' ) ) . '</span>';
				else :
					checathlon_post_thumbnail( $post_thumbnail = 'checathlon-small' );
				endif;

				echo '<span class="testimonial-title-wrapper">';
				the_title( '<h2 class="entry-title text-italic no-margin-bottom">', '</h2>' );

				if ( function_exists( 'the_subtitle' ) ) :
					the_subtitle( '<p class="job-title testimonial-job-title no-margin-bottom">', '</p>' );
				endif;
				echo '</span>';
				?>
			</div><!-- .entry-thumbnail -->

		</div><!-- .entry-inner-wrapper -->

	<?php endif; // End check single. ?>

</article><!-- #post-## -->

<?php
/**
 * Child pages content in Team Page template.
 *
 * @package Checathlon
 */

// Child pages area
$child_pages = new WP_Query( apply_filters( 'checathlon_team_page_arguments', array(
	'post_type'              => 'page',
	'orderby'                => 'menu_order',
	'order'                  => 'ASC',
	'post_parent'            => $post->ID,
	'posts_per_page'         => 500,
	'no_found_rows'          => true,
	'update_post_meta_cache' => false,
) ) );

if ( $child_pages->have_posts() ) : ?>

	<div class="grid-wrapper grid-wrapper-3 justify-content-center">

		<?php while ( $child_pages->have_posts() ) : $child_pages->the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="entry-inner-wrapper">

					<?php
						// Get featured image as post background image.
						echo checathlon_get_bg_header( array( 'size' => 'checathlon-team', 'icon' => 'user' ) );
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

			</article><!-- #post-## -->

		<?php endwhile; ?>

	</div><!-- .grid-wrapper -->

<?php
	endif; // End loop.
	wp_reset_postdata(); // Reset post data.

<?php 
/**
 * Content for blog archive type of pages.
 *
 * @package Checathlon
 */
 
		$checathlon_bg = checathlon_post_background(); // Get featured image as post background image. ?>
		
		<div class="entry-inner-bg"<?php if ( false !== $checathlon_bg ) echo ' style="background-image:url(' . esc_url( $checathlon_bg ) . ');"' ?>>
			
			<?php // Display SVG icon if there is no featured image.
				if ( ! has_post_thumbnail() ) :
					echo checathlon_get_svg( array( 'icon' => 'edit' ) );
				endif;
			?>
			
			<div class="entry-inner">
		
				<header class="entry-header">
					<?php
						get_template_part( 'entry-meta' );
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					?>
				</header><!-- .entry-header -->
		
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
			
				<?php
					get_template_part( 'entry-comment' );
				?>
			
			</div><!-- .entry-inner -->
		</div><!-- .entry-inner-bg -->
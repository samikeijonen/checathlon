<?php
/**
 * Template part for displaying Custom Content Portfolios.
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

					get_template_part( 'misc/entry', 'portfolio-info' );
				?>

				<?php
					$meta  = '';
					$meta .= ccp_get_project_client(     array( 'wrap' => '<li %s><span class="project-key">' . esc_html__( 'Client',    'checathlon' ) . '</span> %s</li>' ) );
					$meta .= ccp_get_project_location(   array( 'wrap' => '<li %s><span class="project-key">' . esc_html__( 'Location',  'checathlon' ) . '</span> %s</li>' ) );
					$meta .= ccp_get_project_start_date( array( 'wrap' => '<li %s><span class="project-key">' . esc_html__( 'Started',   'checathlon' ) . '</span> %s</li>' ) );
					$meta .= ccp_get_project_end_date(   array( 'wrap' => '<li %s><span class="project-key">' . esc_html__( 'Completed', 'checathlon' ) . '</span> %s</li>' ) );
				?>

				<?php if ( $meta ) : ?>
					<ul class="project-meta"><?php echo $meta; ?></ul>
				<?php endif; ?>

				</div><!-- .entry-content -->
			</div><!-- .entry-inner-content -->

			<footer class="entry-footer clear">
				<?php
					checathlon_post_terms( array( 'taxonomy' => 'portfolio_category', 'before' => '<div class="entry-terms-wrapper entry-categories-wrapper clear"><span class="screen-reader-text">' . esc_html__( 'Categories:', 'checathlon' ) . ' </span><span class="icon-wrapper">' . checathlon_get_svg( array( 'icon' => 'folder-open' ) ) . '</span>', 'after' => '</div>' ) );
					checathlon_post_terms( array( 'taxonomy' => 'portfolio_tag', 'before' => '<div class="entry-terms-wrapper entry-tags-wrapper clear"><span class="screen-reader-text">' . esc_html__( 'Tags:', 'checathlon' ) . ' </span><span class="icon-wrapper">' . checathlon_get_svg( array( 'icon' => 'tag' ) ) . '</span>', 'after' => '</div>' ) );
				?>
			</footer><!-- .entry-footer -->

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

		<?php
			get_template_part( 'misc/entry', 'portfolio-info' );
		?>

	</div><!-- .entry-inner-wrapper -->

	<?php endif; // End check single. ?>

</article><!-- #post-## -->

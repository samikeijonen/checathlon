<?php
/**
 * Entry for displaying project info like link to project.
 *
 * @package Checathlon
 */

if ( function_exists( 'ccp_get_project_url' ) && ! empty( $project_url = ccp_get_project_url() ) ) :
?>
	<div class="entry-portfolio-info entry-product-info soft-color medium-font-weight">
		<div class="entry-portfolio-info-wrapper entry-product-info-wrapper">
			<?php
				/* Translators: The %s is the post title shown to screen readers. */
				$text = sprintf( esc_attr__( 'Visit project %s', 'checathlon' ), '<span class="screen-reader-text">' . get_the_title() ) .  '</span>';
				$more = sprintf( '<p class="no-margin-bottom"><a class="button" href="%s">%s</a></p>', esc_url( $project_url ), $text );
				echo $more;
			?>
		</div><!-- .entry-portfolio-info-wrapper -->
	</div><!-- .entry-portfolio-info -->
<?php endif;

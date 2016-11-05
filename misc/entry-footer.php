<?php
/**
 * Entry footer.
 *
 * @package Checathlon
 */
?>

<?php if ( 'post' == get_post_type() ) : ?>

	<footer class="entry-footer clear">
		<?php
			checathlon_post_terms( array( 'taxonomy' => 'category', 'before' => '<div class="entry-terms-wrapper entry-categories-wrapper clear"><span class="screen-reader-text">' . esc_html__( 'Categories:', 'checathlon' ) . ' </span><span class="icon-wrapper">' . checathlon_get_svg( array( 'icon' => 'folder-open' ) ) . '</span>', 'after' => '</div>' ) );
			checathlon_post_terms( array( 'taxonomy' => 'post_tag', 'before' => '<div class="entry-terms-wrapper entry-tags-wrapper clear"><span class="screen-reader-text">' . esc_html__( 'Tags:', 'checathlon' ) . ' </span><span class="icon-wrapper">' . checathlon_get_svg( array( 'icon' => 'tag' ) ) . '</span>', 'after' => '</div>' ) );
		?>
	</footer><!-- .entry-footer -->

<?php endif;

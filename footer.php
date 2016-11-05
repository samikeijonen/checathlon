<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Checathlon
 */

?>

	</div><!-- #content -->

	<?php
		get_template_part( 'widget-areas/sidebar', 'before-footer' ); // Loads the sidebar-before-footer.php template.
		get_template_part( 'widget-areas/sidebar', 'footer' );        // Loads the sidebar-footer.php template.
	?>

	<?php if ( ! get_theme_mod( 'hide_footer_text' ) ) : ?>
		<footer id="colophon" class="site-footer main-padding text-center smaller-font-size" role="contentinfo">

			<div class="site-info main-width">
			<?php
				if ( get_theme_mod( 'footer_text' ) ) :
					echo checathlon_get_footer_text_html(); // Echo custom footer text.
				else :
					checathlon_default_footer_text();
				endif; ?>
			</div><!-- .site-info -->

		</footer><!-- #colophon -->
	<?php endif; ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

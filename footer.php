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

	<footer id="colophon" class="site-footer main-padding text-center smaller-font-size" role="contentinfo">

		<div class="site-info main-width">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'checathlon' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'checathlon' ), 'WordPress' ); ?></a>
			<span class="sep"> &middot; </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s', 'checathlon' ), 'Checathlon', '<a href="https://foxland.fi/">Sami Keijonen</a>' ); ?>
		</div><!-- .site-info -->

	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

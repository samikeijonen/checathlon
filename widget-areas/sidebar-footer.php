<?php
/**
 * The area containing the footer widget areas, social menu and site title.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Checathlon
 */
 
if ( checathlon_edd_is_checkout() ) :
	return;
endif;
?>

<div class="footer-widgets-wrapper footer-widgets main-padding">
	<div class="wrapper main-width">
		<div class="grid-wrapper">
			
			<div class="site-title-desc-footer-wrapper">
				<p class="site-title site-title-footer no-margin-bottom title-font"><?php bloginfo( 'name' ); ?></p>
				<?php
				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description site-description-footer no-margin-bottom"><?php echo $description; ?></p>
				<?php endif; ?>
			</div><!-- .site-title-desc-footer-wrapper -->
			
			<?php
			if( is_active_sidebar( 'sidebar-6' ) ) : ?>
				<aside id="footer-area-1" class="footer-area-1 footer-widget-area" role="complementary">
					<?php dynamic_sidebar( 'sidebar-6' ); ?>
				</aside><!-- .widget-area -->
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'sidebar-7' ) ) : ?>
				<aside id="footer-area-2" class="footer-area-2 footer-widget-area" role="complementary">
					<?php dynamic_sidebar( 'sidebar-7' ); ?>
				</aside><!-- .widget-area -->
			<?php endif; ?>
		
			<?php
				get_template_part( 'menus/menu', 'social' ); // Loads the menus/menu-social.php template.
			?>
		
		</div><!-- .grid-wrapper -->
	</div><!-- .wrapper -->
</div><!-- .footer-widgets-wrapper -->

<?php
/**
 * The area containing the before footer widget areas.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Checathlon
 */

if ( ! checathlon_has_before_footer_widgets() || checathlon_edd_is_checkout() ) {
	return;
}
?>

<div class="before-footer-widgets-wrapper footer-widgets main-padding">
	<div class="wrapper main-width text-center">
	
		<?php 
			if( $before_footer_area_title = get_theme_mod( 'before_footer_area_title' ) ) :
				echo '<h2 class="page-title before-footer-widgets-title">' . esc_html( $before_footer_area_title ) . '</h2>';
			endif;
		?>
	
		<div class="grid-wrapper">

		<?php if( is_active_sidebar( 'sidebar-3' ) ) : ?>
			<aside id="before-footer-area-1" class="before-footer-area-1 widget-area" role="complementary">
				<?php
					$icon_1 = checathlon_get_before_footer_icon_1();
					echo checathlon_get_svg( array( 'icon' => esc_attr( $icon_1 ) ) );
					dynamic_sidebar( 'sidebar-3' );
				?>
			</aside><!-- .widget-area -->
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
			<aside id="before-footer-area-2" class="before-footer-area-2 widget-area" role="complementary">
				<?php
					$icon_2 = checathlon_get_before_footer_icon_2();
					echo checathlon_get_svg( array( 'icon' => esc_attr( $icon_2 ) ) );
					dynamic_sidebar( 'sidebar-4' );
				?>
			</aside><!-- .widget-area -->
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
			<aside id="before-footer-area-3" class="before-footer-area-3 widget-area" role="complementary">
				<?php
					$icon_3 = checathlon_get_before_footer_icon_3();
					echo checathlon_get_svg( array( 'icon' => esc_attr( $icon_3 ) ) );
					dynamic_sidebar( 'sidebar-5' );
				?>
			</aside><!-- .widget-area -->
		<?php endif; ?>
		
		</div><!-- .grid-wrapper -->
	</div><!-- .wrapper -->
</div><!-- .before-footer-widgets-wrapper -->

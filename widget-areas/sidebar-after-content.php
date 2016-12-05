<?php
/**
 * After content widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Checathlon
 */

// Show downloads area if we are on checkout page and cart is empty.
if ( checathlon_edd_is_checkout_cart_empty() && get_theme_mod( 'show_downloads_empty_cart' ) ) :
	get_template_part( 'template-parts/content', 'downloads-area' );
endif;

// Bail if there are no widget or we are on checkout page.
if ( ! checathlon_has_after_content_widgets() || checathlon_edd_is_checkout() ) :
	return;
endif;
?>

<aside id="secondary" class="widget-area after-content-widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</aside><!-- #secondary -->

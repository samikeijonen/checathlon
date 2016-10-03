<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Checathlon
 */

if ( ! is_active_sidebar( 'sidebar-1' ) || ( function_exists( 'edd_is_checkout' ) && ( edd_is_checkout() || edd_is_success_page() ) ) ) :
	return;
endif;
?>

<aside id="main-sidebar" class="main-sidebar widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->

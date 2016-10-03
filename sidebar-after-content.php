<?php
/**
 * After content widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Checathlon
 */

if ( ! checathlon_has_after_content_widgets() || checathlon_edd_is_checkout() ) :
	return;
endif;
?>

<aside id="secondary" class="widget-area after-content-widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</aside><!-- #secondary -->

<?php
/**
 * Front Page widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Checathlon
 */

if ( ! checathlon_has_front_page_widgets() ) :
	return;
endif;
?>

<aside id="front-page-widget-area" class="widget-area front-page-widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-8' ); ?>
</aside><!-- .front-page-widget-area -->

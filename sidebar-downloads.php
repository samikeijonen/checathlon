<?php
/**
 * The sidebar containing widget area for downloads.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Checathlon
 */

if ( ! is_active_sidebar( 'sidebar-10' ) ) :
	return;
endif;
?>

<aside id="main-sidebar" class="main-sidebar downloads-sidebar widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-10' ); ?>
</aside><!-- #secondary -->

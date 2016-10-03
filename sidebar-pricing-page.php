<?php
/**
 * Pricing Page widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Checathlon
 */

if ( ! checathlon_has_service_pricing_widgets() ) :
	return;
endif;
?>

<div class="grid-wrapper grid-wrapper-3 justify-content-center">
	<?php dynamic_sidebar( 'sidebar-9' ); ?>
</div><!-- .grid-wrapper -->
<?php
/**
 * Service and Pricing widgets.
 *
 * @package Checathlon
 */

// Load service and pricing table widgets.
if ( ! checathlon_get_fp_hide_service_pricing() && checathlon_has_service_pricing_widgets() ) : ?>
	<div id="front-page-pricing-area" class="front-page-pricing-area front-page-area">
		<?php
			echo checathlon_get_pricing_area_title_html();
			get_template_part( 'widget-areas/sidebar', 'pricing-page' );
		?>
	</div><!-- .front-page-pricing-area -->
<?php endif;

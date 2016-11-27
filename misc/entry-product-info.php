<?php
/**
 * Entry for displaying product info like price.
 *
 * @package Checathlon
 */

if ( ! function_exists( 'edd_get_purchase_link' ) ) :
	return;
endif;
?>
<div class="entry-product-info">
	<div class="entry-product-info-wrapper grid-same-line align-items-end">
		<span class="product-purchase-link">
			<?php
				if ( edd_has_variable_prices( get_the_ID() ) || checathlon_edd_is_purchace_link_hidden() ) :
					echo '<a class="button" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . esc_html__( 'Details', 'checathlon' ) . '</a>';
				else :
					echo edd_get_purchase_link( apply_filters( 'checathlon_purchace_link',
						array(
							'price' => 0 // turn the price off
						)
					) );
				endif;
			?>
		</span>
		<span class="product-price soft-color medium-font-weight">
		<?php
			echo checathlon_download_get_demo_link();
		?>
		</span>
	</div><!-- .entry-product-info-wrapper -->
</div><!-- .entry-product-info -->

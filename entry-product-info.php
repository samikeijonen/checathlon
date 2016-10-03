<?php 
/**
 * Entry for displaying product info like price.
 *
 * @package Checathlon
 */
 
if ( ! function_exists( 'edd_price' ) ) :
	return;
endif;
?>
<div class="entry-product-info">
	<div class="entry-product-info-wrapper grid-same-line align-items-end">
		<span class="product-purchase-link">
			<?php
				if( edd_has_variable_prices( get_the_ID() ) ) :
					echo '<a class="button" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . esc_html__( 'Details', 'checathlon' ) . '</a>';
				else :
					echo edd_get_purchase_link( apply_filters( 'checathlon_purchace_link',
						array(  
							'price' => 0 // turn the price off
						)
					) );
				endif;
				// echo '<a class="demo-link button button-secondary" href="#">Demo</a>';
			?>
		</span>
		<span class="product-price soft-color medium-font-weight">
		<?php
			echo chucathlon_download_get_demo_link();
		?>
		</span>
	</div><!-- .entry-product-info-wrapper -->
</div><!-- .entry-product-info -->
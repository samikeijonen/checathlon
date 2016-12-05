<?php
/**
 * Functions and filters that run when the Easy Digital Downloads plugin is active.
 *
 * @package Checathlon
 */

// Disable plugin styles.
add_filter( 'edd_get_option_disable_styles', '__return_true' );

/**
 * Dequeue scripts and styles.
 */
function checathlon_edd_scripts() {

	// Remove dashicons from the checkout page. Padlock is added as a SVG icon.
	if ( checathlon_edd_is_checkout() && is_ssl() ) {
		wp_dequeue_style( 'dashicons' );
	}

}
add_action( 'wp_enqueue_scripts', 'checathlon_edd_scripts' );

/**
 * Output download price.
 *
 * Works with variable prices and free products.
 *
 * @since  1.0.0
 * @return string
 */
function checathlon_get_download_price() {
	// Set price.
	$price = '';

	if ( edd_has_variable_prices( get_the_ID() ) ) :
		$price = '<span class="screen-reader-text">' . esc_html__( 'Price:', 'checathlon' ) . ' </span>' . edd_price_range( get_the_ID() );
	elseif ( '0' != edd_get_download_price( get_the_ID() ) && ! edd_has_variable_prices( get_the_ID() ) ) :
		$price = '<span class="screen-reader-text">' . esc_html__( 'Price:', 'checathlon' ) . ' </span>';
		$price .= edd_price( get_the_ID(), false );
	else :
		$price = esc_html__( 'Free', 'checathlon' );
	endif;

	return $price;
}

/**
 * Set same template for all 'download' categories and tags.
 *
 * @since  1.0.0
 * @return string $template
 */
function checathlon_download_category_template( $template ) {

	if ( is_tax( 'download_category' ) || is_tax( 'download_tag' ) || is_tax( 'edd_download_info_feature' ) ) {

		$new_template = locate_template( array( 'archive-download.php' ) );
		if ( '' != $new_template ) {
			return $new_template ;
		}

	}

	return $template;
}
add_filter( 'taxonomy_template', 'checathlon_download_category_template', 99 );

/**
 * Custom empty cart text.
 *
 * @since  1.0.0
 * @return string message
 */
function checathlon_empty_cart_message( $message ) {
	$message = checathlon_get_empty_cart_text_html();

	return $message;
}
add_filter( 'edd_empty_cart_message', 'checathlon_empty_cart_message' );

/**
 * Get download demo link url.
 *
 * @since  1.0.0
 * @return string
 */
function checathlon_download_get_demo_link_url() {

	// Set demo link url.
	$demo_link_url = '';

	// Bail if EDD Download Info Plugin is not around.
	if( ! function_exists( 'edd_download_info_get_download_demo_link' ) ) {
		return $demo_link_url;
	}

	// Get demo link url from EDD Download Info.
	$demo_link_valid_url = edd_download_info_get_download_demo_link();

	// Return demo link url.
	if( isset( $demo_link_valid_url ) && $demo_link_valid_url ) {
		$demo_link_url = $demo_link_valid_url;
	}

	return $demo_link_url;

}

/**
 * Get download demo link.
 *
 * @since  1.0.0
 * @return string
 */
function checathlon_download_get_demo_link() {
	// Set demo link.
	$demo_link = '';

	// Check if we have demo link.
	if( '' !== checathlon_download_get_demo_link_url() ) {
		$demo_link = '<a class="demo-link button button-secondary" href="' . esc_url( checathlon_download_get_demo_link_url() ) . '">' . esc_html__( 'Demo', 'checathlon' ) . '</a>';
	}

	// Return demo link.
	return $demo_link;
}

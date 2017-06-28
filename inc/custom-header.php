<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Checathlon
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses checathlon_header_style()
 */
function checathlon_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'checathlon_custom_header_args', array(
		'default-image'      => '',
		'default-text-color' => '1f1f1f',
		'width'              => 1920,
		'height'             => 500,
		'flex-height'        => true,
		'wp-head-callback'   => 'checathlon_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'checathlon_custom_header_setup', 15 );

/**
 * Styles the header image and text displayed on the blog.
 *
 * @see checathlon_custom_header_setup().
 */
function checathlon_header_style() {
	// Header text color.
	$header_color = get_header_textcolor();

	// Header image.
	$header_image = esc_url( get_header_image() );

	// Jetpack testimonial image.
	$jetpack_options = get_theme_mod( 'jetpack_testimonials' );
	$jetpack_testimonial_featured_image = $jetpack_options['featured-image'];
	if ( is_post_type_archive( 'jetpack-testimonial' ) && isset( $jetpack_testimonial_featured_image ) && $jetpack_testimonial_featured_image ) {
		$header_image_id = $jetpack_testimonial_featured_image;
		$header_image    = esc_url( checathlon_attachment_url( $size = 'full', $id = $header_image_id ) );
	}

	// Jetpack portfolio image.
	$jetpack_portfolio_featured_image = get_option( 'jetpack_portfolio_featured_image' );
	if ( is_post_type_archive( 'jetpack-portfolio' ) && isset( $jetpack_portfolio_featured_image ) && $jetpack_portfolio_featured_image ) {
		$header_image_id = $jetpack_portfolio_featured_image;
		$header_image    = esc_url( checathlon_attachment_url( $size = 'full', $id = $header_image_id ) );
	}

	// Start header styles.
	$style = '';

	// When to show header image (em).
	$min_width = absint( apply_filters( 'checathlon_header_bg_show', 1 ) );

	// Don't show header image in singular views.
	if ( checathlon_hide_header_image() ) {
		$header_image = '';
	}

	// Header images styles.
	if ( ! empty( $header_image ) || ! checathlon_edd_is_checkout() ) {
		$style .= "@media screen and (min-width: {$min_width}em) { .custom-header-image .site-header-wrap { background-image: url({$header_image}) } }";
	}

	// Site title styles.
	if ( display_header_text() ) {
		$style .= ".site-title a, .site-title a:visited { color: #{$header_color} }";
	}

	if ( ! display_header_text() ) {
		$style .= ".site-title { clip: rect(1px, 1px, 1px, 1px); position: absolute; }";
	}

	// Echo styles if it's not empty.
	if ( ! empty( $style ) ) {
		echo "\n" . '<style type="text/css" id="custom-header-css">' . trim( $style ) . '</style>' . "\n";
	}

}

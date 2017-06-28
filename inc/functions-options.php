<?php
/**
 * Functions dealing with theme options.
 *
 * @package Checathlon
 */

/**
 * This is a wrapper function for core WP's `get_theme_mod()` function. Core doesn't
 * provide a filter hook for the default value (useful for child themes). The purpose
 * of this function is to provide that additional filter hook. To filter the final
 * theme mod, use the core `theme_mod_{$name}` filter hook.
 *
 * @since  1.0.0
 *
 * @author    Justin Tadlock <justin@justintadlock.com>
 * @copyright Copyright (c) 2013 - 2016, Justin Tadlock
 * @link      http://themehybrid.com/themes/extant
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * @param     string $name    Theme mod ID.
 * @param     mixed  $default Theme mod default.
 * @return    mixed
 */
function checathlon_get_theme_mod( $name, $default = false ) {
	return get_theme_mod( $name, apply_filters( "checathlon_theme_mod_{$name}_default", $default ) );
}

/**
 * Returns the before footer widget area title.
 *
 * @since  1.0.0
 *
 * @return string
 */
function checathlon_get_before_footer_area_title() {
	return checathlon_get_theme_mod( 'before_footer_area_title', '' );
}

/**
 * Returns the before footer widget area title html.
 *
 * @since  1.0.0
 *
 * @return string
 */
function checathlon_get_before_footer_area_title_html() {
	if ( checathlon_get_before_footer_area_title() ) {
		return '<h2 class="page-title before-footer-widgets-title">' . esc_html( checathlon_get_before_footer_area_title() ) . '</h2>';
	}
}

/**
 * Returns the before footer widget area icon 1 theme mod.
 *
 * @since  1.0.0
 *
 * @return string
 */
function checathlon_get_before_footer_icon_1() {
	return checathlon_get_theme_mod( 'before_footer_widget_icon_1', 'paint-brush' );
}

/**
 * Returns the before footer widget area icon 2 theme mod.
 *
 * @since  1.0.0
 *
 * @return string
 */
function checathlon_get_before_footer_icon_2() {
	return checathlon_get_theme_mod( 'before_footer_widget_icon_2', 'rocket' );
}

/**
 * Returns the before footer widget area icon 3 theme mod.
 *
 * @since  1.0.0
 *
 * @return string
 */
function checathlon_get_before_footer_icon_3() {
	return checathlon_get_theme_mod( 'before_footer_widget_icon_3', 'bolt' );
}

/**
 * Returns the default featured content theme mod in Front Page.
 *
 * @since  1.0.0
 *
 * @return string
 */
function checathlon_get_fp_featured_content() {
	return checathlon_get_theme_mod( 'front_page_featured', 'select-pages' );
}

/**
 * Returns the Front Page first widget color.
 *
 * @since  1.0.0
 *
 * @return string
 */
function checathlon_get_fp_1_widget_bg_color() {
	return checathlon_get_theme_mod( 'first_widget_bg_color', '#3b3b3b' );
}

/**
 * Returns the Front Page first widget default color.
 *
 * @since  1.0.0
 *
 * @return string
 */
function checathlon_get_fp_1_widget_default_bg_color() {
	return apply_filters( 'checathlon_first_widget_bg_default_color', '#3b3b3b' );
}

/**
 * Returns the Front Page first widget color opacity.
 *
 * @since  1.0.0
 *
 * @return integer
 */
function checathlon_get_fp_1_widget_bg_color_opacity() {
	return checathlon_get_theme_mod( 'first_widget_bg_color_opacity', 95 );
}

/**
 * Returns the Front Page Service and Pricing hiding.
 *
 * @since  1.0.0
 *
 * @return integer
 */
function checathlon_get_fp_hide_service_pricing() {
	return checathlon_get_theme_mod( 'hide_service_pricing', '' );
}

/**
 * Returns the Front Page Testimonials hiding.
 *
 * @since  1.0.0
 *
 * @return integer
 */
function checathlon_get_fp_hide_testimonials() {
	return checathlon_get_theme_mod( 'hide_testimonials', '' );
}

/**
 * Returns the Front Page Testimonials hiding.
 *
 * @since  1.0.0
 *
 * @return integer
 */
function checathlon_get_fp_hide_blog_posts() {
	return checathlon_get_theme_mod( 'hide_blog_posts', '' );
}

/**
 * Returns featured area title.
 *
 * @since  1.0.0
 *
 * @return string
 */
function checathlon_get_featured_area_title() {
	return checathlon_get_theme_mod( 'featured_area_title', esc_html__( 'Products', 'checathlon' ) );
}

/**
 * Returns featured area title html.
 *
 * @since  1.0.0
 *
 * @return string
 */
function checathlon_get_featured_area_title_html() {
	if ( checathlon_get_featured_area_title() ) {
		return '<h2 class="front-page-featured-title front-page-title widget-title">' . esc_html( checathlon_get_featured_area_title() ) . '</h2>';
	}
}

/**
 * Returns downloads featured area title.
 *
 * @since  1.0.0
 *
 * @return string
 */
function checathlon_get_downloads_featured_area_title() {
	return checathlon_get_theme_mod( 'downloads_featured_area_title', esc_html__( 'Products', 'checathlon' ) );
}

/**
 * Returns downloads featured area title html.
 *
 * @since  1.0.0
 *
 * @return string
 */
function checathlon_get_downloads_featured_area_title_html() {
	if ( checathlon_get_downloads_featured_area_title() ) {
		return '<h2 class="downloads-featured-title front-page-title widget-title">' . esc_html( checathlon_get_downloads_featured_area_title() ) . '</h2>';
	}
}

/**
 * Returns pricing area title.
 *
 * @since  1.0.0
 *
 * @return string
 */
function checathlon_get_pricing_area_title() {
	return ( function_exists( 'pll__' ) ) ? pll__( checathlon_get_theme_mod( 'pricing_area_title', esc_html__( 'Pricing', 'checathlon' ) ) ) : checathlon_get_theme_mod( 'pricing_area_title', esc_html__( 'Pricing', 'checathlon' ) );
}

/**
 * Returns pricing area title html.
 *
 * @since  1.0.0
 *
 * @return string
 */
function checathlon_get_pricing_area_title_html() {
	if ( checathlon_get_pricing_area_title() ) {
		return '<h2 class="front-page-pricing-title front-page-title widget-title">' . esc_html( checathlon_get_pricing_area_title() ) . '</h2>';
	}
}

/**
 * Returns testimonial area title.
 *
 * @since  1.0.0
 *
 * @return string
 */
function checathlon_get_testimonial_area_title() {
	return ( function_exists( 'pll__' ) ) ? pll__( checathlon_get_theme_mod( 'testimonial_area_title', esc_html__( 'Testimonials', 'checathlon' ) ) ) : checathlon_get_theme_mod( 'testimonial_area_title', esc_html__( 'Testimonials', 'checathlon' ) );
}

/**
 * Returns testimonial area title html.
 *
 * @since  1.0.0
 *
 * @return string
 */
function checathlon_get_testimonial_area_title_html() {
	if ( checathlon_get_testimonial_area_title() ) {
		return '<h2 class="front-page-testimonial-title front-page-title widget-title">' . esc_html( checathlon_get_testimonial_area_title() ) . '</h2>';
	}
}

/**
 * Returns blog area title.
 *
 * @since  1.0.0
 *
 * @return string
 */
function checathlon_get_blog_area_title() {
	return ( function_exists( 'pll__' ) ) ? pll__( checathlon_get_theme_mod( 'blog_area_title', esc_html__( 'Recent blog posts', 'checathlon' ) ) ) : checathlon_get_theme_mod( 'blog_area_title', esc_html__( 'Recent blog posts', 'checathlon' ) );
}

/**
 * Returns blog area title html.
 *
 * @since  1.0.0
 *
 * @return string
 */
function checathlon_get_blog_area_title_html() {
	if ( checathlon_get_blog_area_title() ) {
		return '<h2 class="front-page-blog-title front-page-title widget-title">' . esc_html( checathlon_get_blog_area_title() ) . '</h2>';
	}
}

/**
 * Returns footer text.
 *
 * @since  1.0.0
 *
 * @return string
 */
function checathlon_get_footer_text() {
	return ( function_exists( 'pll__' ) ) ? pll__( checathlon_get_theme_mod( 'footer_text' ) ) : checathlon_get_theme_mod( 'footer_text' );
}

/**
 * Returns empty cart text.
 *
 * @since  1.0.0
 *
 * @return string
 */
function checathlon_get_empty_cart_text() {
	return checathlon_get_theme_mod( 'empty_cart_text' );
}

/**
 * Returns footer text html.
 *
 * @since  1.0.0
 *
 * @return string
 */
function checathlon_get_footer_text_html() {
	if ( checathlon_get_footer_text() ) {
		return wp_kses_post( checathlon_get_footer_text() );
	} else {
		return checathlon_default_footer_text();
	}
}

/**
 * Returns empty cart text html.
 *
 * @since  1.0.0
 *
 * @return string
 */
function checathlon_get_empty_cart_text_html() {
	if ( checathlon_get_empty_cart_text() ) {
		return '<div class="edd_empty_cart">' . wpautop( wp_kses_post( checathlon_get_empty_cart_text() ) ) . '</div>';
	} else {
		return '<div class="edd_empty_cart">' . esc_html__( 'Your cart is empty', 'checathlon' ) . '</div>';
	}
}

/**
 * Returns the Front Page selected pages count.
 *
 * @since  1.0.0
 *
 * @return integer
 */
function checathlon_how_many_selected_pages() {
	return apply_filters( 'checathlon_how_many_selected_pages', 6 );
}

/**
 * Returns featured pages selected from the Customizer.
 *
 * @since  1.0.0
 *
 * @return array
 */
function checathlon_featured_pages() {

	$k = 1;

	// Set empty array of featured pages.
	$checathlon_featured_pages = array();

	// How many pages to show.
	$how_many_pages = checathlon_how_many_selected_pages();

	// Loop all the featured pages.
	while ( $k <= absint ( $how_many_pages ) ) { // Begins the loop through found pages from customize settings.

		$checathlon_page_id = absint( get_theme_mod( 'featured_page_' . $k ) );

			// Add selected featured pages in array.
			if ( 0 !== $checathlon_page_id || ! empty( $checathlon_page_id ) ) { // Check if page is selected.
				$checathlon_featured_pages[] = $checathlon_page_id;
			}

		$k++;

	}

	// Return featured pages.
	return $checathlon_featured_pages;
}

/**
 * Convert HEX to RGB.
 *
 * @author    Twenty Fifteen
 * @copyright Automattic
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * @since  1.0.0
 * @param  string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array  Array containing RGB (red, green, and blue) values for the given
 *                HEX code, empty array otherwise.
 */
function checathlon_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) == 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) == 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Sanitizes a hex color.
 *
 * Returns either '', a 3 or 6 digit hex color (with #), or nothing.
 * This replicates the Core function which is only available in the Customizer.
 *
 * @since 1.0.0
 *
 * @param  string $color
 * @return string|void
 */
function checathlon_sanitize_hex_color( $color ) {
	if ( '' === $color ) {
		return '';
	}

	// 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
		return $color;
	}

}

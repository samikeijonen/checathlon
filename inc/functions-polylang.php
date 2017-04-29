<?php
/**
 * Polylang Plugin related functions.
 *
 * @package Checathlon
 */

/**
 * Register strings for translation.
 */
if ( function_exists( 'pll_register_string' ) ) {
	// Titles.
	pll_register_string( esc_html__( 'Pricing area title', 'checathlon' ), get_theme_mod( 'pricing_area_title' ), 'checathlon' );
	pll_register_string( esc_html__( 'Testimonial area title', 'checathlon' ), get_theme_mod( 'testimonial_area_title' ), 'checathlon' );
	pll_register_string( esc_html__( 'Blog area title', 'checathlon' ), get_theme_mod( 'blog_area_title' ), 'checathlon' );

	// Footer.
	pll_register_string( esc_html__( 'Footer text', 'checathlon' ), get_theme_mod( 'footer_text' ), 'checathlon', true );
}

<?php
/**
 * Checathlon Theme Customizer.
 *
 * @package Checathlon
 */

/**
 * Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function checathlon_customize_register( $wp_customize ) {

	// Add the theme panel.
	$wp_customize->add_panel(
		'theme',
		array(
			'title'    => esc_html__( 'Theme Settings', 'checathlon' ),
			'priority' => 10
		)
	);

	// Load different part of the Customizer.
	require_once( get_template_directory() . '/inc/customizer/settings-front-page.php' );
	require_once( get_template_directory() . '/inc/customizer/settings-front-page-featured.php' );

	// PostMessage settings.
	$wp_customize->get_setting( 'blogname' )->transport               = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport       = 'postMessage';
	$wp_customize->get_setting( 'featured_area_title' )->transport    = 'postMessage';
	$wp_customize->get_setting( 'pricing_area_title' )->transport     = 'postMessage';
	$wp_customize->get_setting( 'testimonial_area_title' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blog_area_title' )->transport        = 'postMessage';

	// Set partial refresh.
	if ( isset( $wp_customize->selective_refresh ) ) {

		// Partial refresh for site title.
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => function() {
				return bloginfo( 'name' );
			},
		) );

		// Partial refresh for site description.
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => function() {
				return bloginfo( 'description' );
			},
		) );

		// Partial refresh for featured area title.
		$wp_customize->selective_refresh->add_partial( 'featured_area_title', array(
			'selector'            => '.front-page-featured-title',
			'render_callback'     => function() {
				return checathlon_get_featured_area_title_html();
			},
		) );

		// Partial refresh for pricing area title.
		$wp_customize->selective_refresh->add_partial( 'pricing_area_title', array(
			'selector'            => '.front-page-pricing-title',
			'render_callback'     => function() {
				return checathlon_get_pricing_area_title_html();
			},
		) );

		// Partial refresh for testimonial area title.
		$wp_customize->selective_refresh->add_partial( 'testimonial_area_title', array(
			'selector'            => '.front-page-testimonial-title',
			'render_callback'     => function() {
				return checathlon_get_testimonial_area_title_html();
			},
		) );

		// Partial refresh for blog area title.
		$wp_customize->selective_refresh->add_partial( 'blog_area_title', array(
			'selector'            => '.front-page-blog-title',
			'render_callback'     => function() {
				return checathlon_get_blog_area_title_html();
			},
		) );

		// Partial refresh for footer text.
		$wp_customize->selective_refresh->add_partial( 'footer_text', array(
			'selector'            => '.site-info',
			'render_callback'     => function() {
				return checathlon_get_footer_text_html();
			},
		) );

	}

}
add_action( 'customize_register', 'checathlon_customize_register' );

/**
 * Sanitize the checkbox value.
 *
 * @since 1.0.0
 *
 * @param  string $input checkbox.
 * @return string (1 or null).
 */
function checathlon_sanitize_checkbox( $input ) {
	return ( 1 == $input ) ? 1 : '';
}

/**
 * Sanitizes the footer content on the customize screen. Users with the 'unfiltered_html' cap can post
 * anything. For other users, wp_filter_post_kses() is ran over the setting.
 *
 * @since 1.0.0
 */
function checathlon_sanitize_textarea( $setting, $object ) {

	// Make sure we kill evil scripts from users without the 'unfiltered_html' cap.
	if ( 'footer_text' === $object->id && ! current_user_can( 'unfiltered_html' ) ) {
		$setting = stripslashes( wp_filter_post_kses( addslashes( $setting ) ) );
	}

	// Return the sanitized setting.
	return $setting;

}

/**
 * Enqueues front-end CSS from the Customizer.
 *
 * @since 1.0.0
 * @see   wp_add_inline_style()
 */
function checathlon_customizer_css() {

	// Get first widget background image, color and opacity.
	$fp_1_widget_bg            = get_theme_mod( 'first_widget_bg' );
	$fp_1_widget_color         = checathlon_get_fp_1_widget_bg_color();
	$fp_1_widget_color_opacity = checathlon_get_fp_1_widget_bg_color_opacity();

	// Sanitize values.
	$fp_1_widget_bg                = esc_url( $fp_1_widget_bg );
	$fp_1_widget_color             = checathlon_sanitize_hex_color( $fp_1_widget_color );
	$fp_1_widget_color_opacity     = absint( $fp_1_widget_color_opacity );
	$fp_1_widget_color_opacity_dec = $fp_1_widget_color_opacity / 100;

	// Convert hex color to rgba.
	$fp_1_widget_color_rgb = checathlon_hex2rgb( $fp_1_widget_color );

	// Red, green, and blue.
	$red   = $fp_1_widget_color_rgb['red'];
	$green = $fp_1_widget_color_rgb['green'];
	$blue  = $fp_1_widget_color_rgb['blue'];

	// Content bg styles.
	$bg_color_css = '';

	if ( $fp_1_widget_bg ) {

		$bg_color_css .= "
			.front-page-widget-area .widget:first-of-type,
			.after-content-widget-area .widget:first-of-type {
				background: linear-gradient( rgba( {$red}, {$green}, {$blue}, {$fp_1_widget_color_opacity_dec}), rgba( {$red}, {$green}, {$blue}, {$fp_1_widget_color_opacity_dec}) ),
				rgba( {$red}, {$green}, {$blue}, {$fp_1_widget_color_opacity_dec}) url({$fp_1_widget_bg}) no-repeat center;
				background-size: auto, cover;
			}";

	}

	// Add inline styles.
	if ( ! empty( $bg_color_css ) ) {
		wp_add_inline_style( 'checathlon-style', $bg_color_css );
	}

}
add_action( 'wp_enqueue_scripts', 'checathlon_customizer_css' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function checathlon_customize_preview_js() {
	wp_enqueue_script( 'checathlon_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20160926', true );
}
add_action( 'customize_preview_init', 'checathlon_customize_preview_js' );

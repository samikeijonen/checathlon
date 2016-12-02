<?php
/**
 * Theme Customizer for Front Page Template.
 *
 * @package Checathlon
 */

	// Add the front-page section.
	$wp_customize->add_section(
		'front-page',
		array(
			'title'           => esc_html__( 'Front Page', 'checathlon' ),
			'description'     => esc_html__( 'In this section you can modify Front Page Template.', 'checathlon' ),
			'priority'        => 10,
			'panel'           => 'theme',
			'active_callback' => 'checathlon_is_front_page_template',
		)
	);

	// Hide service and pricing section setting.
	$wp_customize->add_setting(
		'hide_service_pricing',
		array(
			'default'           => checathlon_get_fp_hide_service_pricing(),
			'sanitize_callback' => 'checathlon_sanitize_checkbox',
		)
	);

	// Hide service and pricing section control.
	$wp_customize->add_control(
		'hide_service_pricing',
		array(
			'label'       => esc_html__( 'Hide Service and Pricing Section', 'checathlon' ),
			'section'     => 'front-page',
			'priority'    => 5,
			'type'        => 'checkbox',
		)
	);

	// Hide testimonials setting.
	$wp_customize->add_setting(
		'hide_testimonials',
		array(
			'default'           => checathlon_get_fp_hide_testimonials(),
			'sanitize_callback' => 'checathlon_sanitize_checkbox',
		)
	);

	// Hide testimonials control.
	$wp_customize->add_control(
		'hide_testimonials',
		array(
			'label'       => esc_html__( 'Hide Testimonials', 'checathlon' ),
			'section'     => 'front-page',
			'priority'    => 6,
			'type'        => 'checkbox',
		)
	);

	// Hide blog posts setting.
	$wp_customize->add_setting(
		'hide_blog_posts',
		array(
			'default'           => checathlon_get_fp_hide_blog_posts(),
			'sanitize_callback' => 'checathlon_sanitize_checkbox',
		)
	);

	// Hide blog posts control.
	$wp_customize->add_control(
		'hide_blog_posts',
		array(
			'label'       => esc_html__( 'Hide Blog Posts', 'checathlon' ),
			'section'     => 'front-page',
			'priority'    => 7,
			'type'        => 'checkbox',
		)
	);

	/**
	 * Titles for Front Page sections.
	 *
	 */

	// Pricing area title setting.
	$wp_customize->add_setting(
		'pricing_area_title',
		array(
			'default'           => checathlon_get_pricing_area_title(),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	// Featured area title control.
	$wp_customize->add_control(
		'pricing_area_title',
		array(
			'label'           => esc_html__( 'Pricing area title', 'checathlon' ),
			'section'         => 'front-page',
			'priority'        => 20,
			'type'            => 'text',
			'active_callback' => 'checathlon_show_pricing_title',
		)
	);

	// Testimonial area title setting.
	$wp_customize->add_setting(
		'testimonial_area_title',
		array(
			'default'           => checathlon_get_testimonial_area_title(),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	// Testimonial area title control.
	$wp_customize->add_control(
		'testimonial_area_title',
		array(
			'label'           => esc_html__( 'Testimonial area title', 'checathlon' ),
			'section'         => 'front-page',
			'priority'        => 30,
			'type'            => 'text',
			'active_callback' => 'checathlon_show_testimonial_title',
		)
	);

	// Blog area title setting.
	$wp_customize->add_setting(
		'blog_area_title',
		array(
			'default'           => checathlon_get_blog_area_title(),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	// Blog area title control.
	$wp_customize->add_control(
		'blog_area_title',
		array(
			'label'           => esc_html__( 'Blog area title', 'checathlon' ),
			'section'         => 'front-page',
			'priority'        => 40,
			'type'            => 'text',
			'active_callback' => 'checathlon_show_blog_title',
		)
	);

/**
 * Checks when to show pricing area title.
 *
 * @since  1.0.0
 *
 * @param  WP_Customize_Control
 * @return boolean
 */
function checathlon_show_pricing_title( $control ) {

	return (  1 != $control->manager->get_setting( 'hide_service_pricing' )->value() );

}

/**
 * Checks when to show testimonial area title.
 *
 * @since  1.0.0
 *
 * @param  WP_Customize_Control
 * @return boolean
 */
function checathlon_show_testimonial_title( $control ) {

	return (  1 != $control->manager->get_setting( 'hide_testimonials' )->value() );

}

/**
 * Checks when to show blog area title.
 *
 * @since  1.0.0
 *
 * @param  WP_Customize_Control
 * @return boolean
 */
function checathlon_show_blog_title( $control ) {

	return (  1 != $control->manager->get_setting( 'hide_blog_posts' )->value() );

}

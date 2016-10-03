<?php
/**
 * Theme Customizer for first widget in Front Page or after content widget areas.
 *
 * @package Checathlon
 */
	
	// Add the 'first-widget' section.
	$wp_customize->add_section(
		'first-widget',
		array(
			'title'           => esc_html__( 'First Widget Settings', 'checathlon' ),
			'description'     => esc_html__( 'In this section you can modify settings for the first widget in Front Page or After Content widget area.', 'checathlon' ),
			'priority'        => 30,
			'panel'           => 'theme',
			'active_callback' => ! checathlon_has_after_content_front_page_widgets(),
		)
	);
	
	// First widget backgound image setting.
	$wp_customize->add_setting(
		'first_widget_bg',
		array(
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	// First widget backgound image control.
	$wp_customize->add_control(
		new WP_Customize_Image_Control( $wp_customize,
		'first_widget_bg',
		array(
			'label'		  => esc_html__( 'Widget Background Image', 'checathlon' ),
			'section'	  => 'first-widget',
			'description' => esc_html__( 'Add background image for the first widget.', 'checathlon' ),
		) )
	);
	
	// First widget backgound color setting.
	$wp_customize->add_setting(
		'first_widget_bg_color',
		array(
			'default'           => checathlon_get_fp_1_widget_default_bg_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	// First widget backgound color control.
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
		'first_widget_bg_color',
		array(
			'label'           => esc_html__( 'Content Background Color', 'checathlon' ),
			'description'     => esc_html__( 'Set Content Background Color for Front Page Template.', 'checathlon' ),
			'section'         => 'first-widget',
			'priority'        => 10,
			'active_callback' => 'checathlon_show_bg_co_options',
		)
	) );
	
	// First widget backgound color opacity setting.
	$wp_customize->add_setting(
		'first_widget_bg_color_opacity',
		array(
			'default'           => checathlon_get_fp_1_widget_bg_color_opacity(),
			'sanitize_callback' => 'absint',
		)
	);
	
	// First widget backgound color opacity control.
	$wp_customize->add_control(
		'first_widget_bg_color_opacity',
			array(
				'type'            => 'range',
				'priority'        => 15,
				'section'         => 'first-widget',
				'label'           => esc_html__( 'Content Background Color Opacity', 'checathlon' ),
				'description'     => esc_html__( 'Set Content Background Opacity for Front Page Template.', 'checathlon' ),
				'active_callback' => 'checathlon_show_bg_co_options',
				'input_attrs'     =>
					array(
						'min'   => 0,
						'max'   => 100,
						'step'  => 1
					),
			)
		);
	
/**
 * Checks when to show bg color options.
 *
 * @since  1.0.0
 *
 * @param  WP_Customize_Control
 * @return boolean
 */
function checathlon_show_bg_co_options( $control ) {
	
	if ( '' !== $control->manager->get_setting( 'first_widget_bg' )->value() ) {
		return true;
	} else {
		return false;
	}

}

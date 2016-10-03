<?php
/**
 * Theme Customizer for before footer area widgets.
 *
 * @package Checathlon
 */
 
	// Add the 'before-footer-widget' section.
	$wp_customize->add_section(
		'before-footer-widget',
		array(
			'title'           => esc_html__( 'Before Footer Widgets Settings', 'checathlon' ),
			'description'     => esc_html__( 'In this section you can add title and icons in before footer widget area.', 'checathlon' ),
			'priority'        => 20,
			'panel'           => 'theme',
			'active_callback' => ! checathlon_has_before_footer_widgets(),
		)
	);
		
	// Add the before footer area title setting.
	$wp_customize->add_setting(
		'before_footer_area_title',
		array(
			'default'           => checathlon_get_before_footer_area_title(),
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
 	
	// Add the before footer area title control.
	$wp_customize->add_control(
		'before_footer_area_title',
		array(
			'label'    => esc_html__( 'Before footer area title', 'checathlon' ),
			'section'  => 'before-footer-widget',
			'priority' => 10,
			'type'     => 'text'
		)
	);
	
	// Get supported icons.
	$icons = checathlon_get_svg_icons();
	
	// Set setting name and defaults.
	$icons_args = array(
		'before_footer_widget_icon_1' => checathlon_get_before_footer_icon_1(),
		'before_footer_widget_icon_2' => checathlon_get_before_footer_icon_2(),
		'before_footer_widget_icon_3' => checathlon_get_before_footer_icon_3(),
	);
	
	// Start looping the icon settings.
	$k = 1;
	foreach ( $icons_args as $setting => $default ) {

		// Add icon setting for before footer widget.
		$wp_customize->add_setting(
			$setting,
			array(
				'default'           => $default,
				'sanitize_callback' => 'sanitize_key'
			)
		);
	
		// Add icon control for before footer widget.
		$wp_customize->add_control(
		$setting,
			array(
				/* translators: %s stands for number. Icon before footer widget area 1. */
				'label'   => sprintf( esc_html__( 'Icon before footer widget area %s', 'checathlon' ), $k ),
				'type'    => 'select',
				'choices' => $icons,
				'section' => 'before-footer-widget',
			)
		);
		
		$k++;
		
	}


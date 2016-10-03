<?php
/**
 * Custom background feature
 *
 * @package Checathlon
 */

/**
 * Adds support for the WordPress 'custom-background' theme feature.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function checathlon_custom_background_setup() {

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'checathlon_custom_background_args', array(
		'default-color' => 'f2f2f2',
		'default-image' => '',
	) ) );
	
}
add_action( 'after_setup_theme', 'checathlon_custom_background_setup', 15 );

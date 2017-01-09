<?php
/**
 * Scripts related functions.
 *
 * @package Checathlon
 */

/**
 * Filters the 'stylesheet_uri' to allow theme developers to offer a minimized version of their main
 * 'style.css' file. It will detect if a 'style.min.css' file is available and use it if SCRIPT_DEBUG
 * is disabled.
 *
 * @since     1.0.0
 * @author    Justin Tadlock <justin@justintadlock.com>
 * @copyright Copyright (c) 2008 - 2015, Justin Tadlock
 * @link      http://themehybrid.com/hybrid-core
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @param     string  $stylesheet_uri      The URI of the active theme's stylesheet.
 * @param     string  $stylesheet_dir_uri  The directory URI of the active theme's stylesheet.
 * @return    string  $stylesheet_uri
 */
function checathlon_min_stylesheet_uri( $stylesheet_uri, $stylesheet_dir_uri ) {
	// Get the minified suffix.
	$suffix = checathlon_get_min_suffix();

	// Use the .min stylesheet if available.
	if ( $suffix ) {

		// Remove the stylesheet directory URI from the file name.
		$stylesheet = str_replace( trailingslashit( $stylesheet_dir_uri ), '', $stylesheet_uri );

		// Change the stylesheet name to 'style.min.css'.
		$stylesheet = str_replace( '.css', "{$suffix}.css", $stylesheet );

		// If the stylesheet exists in the stylesheet directory, set the stylesheet URI to the dev stylesheet.
		if ( file_exists( trailingslashit( get_stylesheet_directory() ) . $stylesheet ) ) {
			$stylesheet_uri = esc_url( trailingslashit( $stylesheet_dir_uri ) . $stylesheet );
		}

	}

	// Return the theme stylesheet.
	return $stylesheet_uri;
}
add_filter( 'stylesheet_uri', 'checathlon_min_stylesheet_uri', 5, 2 );

/**
 * Helper function for getting the script/style `.min` suffix for minified files.
 *
 * @since  1.0.0
 * @return string
 */
function checathlon_get_min_suffix() {
	return defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ? '' : '.min';
}

/**
 * Get theme version number, works also for child themes.
 *
 * Calling function checathlon_theme_version() detect active theme version number.
 * Calling function with $dir = 'template' parameter detect parent theme version number: checathlon_theme_version( $dir = 'template' ).
 *
 * @since  1.1.0
 *
 * @param  string $dir stylesheet or template.
 * @return string Theme version.
 */
function checathlon_theme_version( $dir = 'stylesheet' ) {
	// Get theme name. Fallback to active theme.
	$theme = 'template' === $dir ? wp_get_theme( get_template() ) : wp_get_theme( get_stylesheet() );

	// Return theme version.
	return $theme->get( 'Version' );
}

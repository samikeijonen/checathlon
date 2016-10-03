<?php
/**
 * Functions and filters for Jetpack Portfolios.
 *
 * @package Checathlon
 */

/**
 * Set same template for all 'portfolio' categories and tags.
 *
 * @since  1.0.0
 * @param  string $template Template for displaying archive page.
 * @return string $template
 */
function chucathlon_jetpack_portfolio_taxonomy_template( $template ) {

	if ( is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) ) {
		
		$new_template = locate_template( array( 'archive-jetpack-portfolio.php' ) );
		if ( '' != $new_template ) {
			return $new_template ;
		}
		
	}

	return $template;
}
add_filter( 'taxonomy_template', 'chucathlon_jetpack_portfolio_taxonomy_template', 99 );
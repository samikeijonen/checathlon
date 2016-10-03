<?php
/**
 * Functions and filters for Custom Content Portfolio Plugin.
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
function chucathlon_portfolio_taxonomy_template( $template ) {

	if ( is_tax( 'portfolio_category' ) || is_tax( 'portfolio_tag' ) ) {
		
		$new_template = locate_template( array( 'archive-portfolio_project.php' ) );
		if ( '' != $new_template ) {
			return $new_template ;
		}
		
	}

	return $template;
}
add_filter( 'taxonomy_template', 'chucathlon_portfolio_taxonomy_template', 99 );
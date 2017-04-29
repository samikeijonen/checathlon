<?php
/**
 * Filters used in theme.
 *
 * @package Checathlon
 */

/**
 * This handles Front Page logic.
 *
 * 1. If Front page displays setting is set to Your latest posts, 'home.php' template is used. And user sees latest post as it should.
 * 2. If Front page displays setting is set to *A static page*, and any page with default page template is selected, 'front-page.php' kicks in.
 * 3. If custom page template is set to a page in step 2, it will kick in. This gives flexibility when front page isn't locked in using always 'front-page.php'.
 *
 * @since  1.0.0
 * @return $template
 */
function checathlon_front_page_template( $template ) {

	return ( is_home() || locate_template( get_page_template_slug() ) ) ? '' : $template;

}
add_filter( 'frontpage_template', 'checathlon_front_page_template' );

/**
 * Change [...] to just "...".
 *
 * @since  1.0.0
 * @return string $more
 */
function checathlon_excerpt_more() {
	/* Translators: The &hellip; is mark after excerpt. */
	$more = esc_html__( '&hellip;', 'checathlon' );

	return $more;
}
add_filter( 'excerpt_more', 'checathlon_excerpt_more' );

/**
 * Excerpt lenght.
 *
 * @since  1.0.0
 *
 * @param  integer $length Excerpt lenght.
 * @return integer $length
 */
function checathlon_excerpt_length( $length ) {

	// Change excerpt length on pages.
	if ( is_page_template( 'templates/team-page.php' ) ) {
		$length = absint( apply_filters( 'checathlon_team_excerpt_length', 15 ) );
	}

	return $length;

}
add_filter( 'excerpt_length', 'checathlon_excerpt_length' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function checathlon_body_classes( $classes ) {

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add the '.custom-header-image' class if the user is using a custom header image.
	if ( get_header_image() && ! checathlon_hide_header_image() ) {
		$classes[] = 'custom-header-image';
	}

	// Add the '.no-header-text' class if there is no Site Title and Tagline.
	if ( ! display_header_text() ) {
		$classes[] = 'no-header-text';
	}

	// Add the '.no-social-menu' class if there is no Social menu.
	if ( ! has_nav_menu( 'social' ) ) {
		$classes[] = 'no-social-menu';
	}

	// Check main sidebar.
	if ( checathlon_has_main_sidebar_widgets() && checathlon_show_main_sidebar() && ! checathlon_edd_is_checkout() ) {
		$classes[] = 'has-main-sidebar';
	}

	// Check download sidebar.
	if ( checathlon_has_download_sidebar_widgets() && checathlon_show_download_sidebar() ) {
		$classes[] = 'has-download-sidebar';
	}

	// Check after content widget area.
	if ( checathlon_has_after_content_widgets() ) {
		$classes[] = 'has-after-content-widget-area';
	}

	// Before footer widget area count.
	$before_footer_widget_count = 0;
	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$before_footer_widget_count++;
	}
	if ( is_active_sidebar( 'sidebar-4' ) ) {
		$before_footer_widget_count++;
	}
	if ( is_active_sidebar( 'sidebar-5' ) ) {
		$before_footer_widget_count++;
	}

	if (  1 < $before_footer_widget_count ) {
		$classes[] = 'before-footer-widgets-many';
	}
	$classes[] = 'before-footer-widgets-' . $before_footer_widget_count;

	// Footer widget area count.
	$footer_widget_count = 0;
	if ( is_active_sidebar( 'sidebar-6' ) ) {
		$footer_widget_count++;
	}
	if ( is_active_sidebar( 'sidebar-7' ) ) {
		$footer_widget_count++;
	}

	if (  0 < $footer_widget_count ) {
		$classes[] = 'footer-widgets-many';
	}
	$classes[] = 'footer-widgets-' . $footer_widget_count;

	return $classes;
}
add_filter( 'body_class', 'checathlon_body_classes' );

/**
 * Filters `get_the_archve_title` to add better archive titles than core.
 *
 * @since  1.0.0
 *
 * @param  string  $title
 * @return string
 */
function checathlon_archive_title_filter( $title ) {

	if ( is_category() ) {
		$title = single_cat_title( '', false );
	}

	elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	}

	elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	}

	elseif ( is_author() ) {
		$title = get_the_author_meta( 'display_name', absint( get_query_var( 'author' ) ) );
	}

	elseif ( is_search() ) {
		$title = sprintf( esc_html__( 'Search results for &#8220;%s&#8221;', 'checathlon' ), get_search_query() );
	}

	elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	}

	elseif ( is_month() ) {
		$title = single_month_title( ' ', false );
	}

	return apply_filters( 'checathlon_archive_title', $title );
}
add_filter( 'get_the_archive_title', 'checathlon_archive_title_filter', 5 );

/**
 * Filters `get_the_archve_description` to add better archive descriptions than core.
 *
 * @since  1.0.0
 *
 * @param  string  $desc
 * @return string
 */
function checathlon_archive_description_filter( $desc ) {

	if ( is_category() ) {
		$desc = get_term_field( 'description', get_queried_object_id(), 'category', 'raw' );
	}

	elseif ( is_tag() ) {
		$desc = get_term_field( 'description', get_queried_object_id(), 'post_tag', 'raw' );
	}

	elseif ( is_tax() ) {
		$desc = get_term_field( 'description', get_queried_object_id(), get_query_var( 'taxonomy' ), 'raw' );
	}

	elseif ( is_author() ) {
		$desc = get_the_author_meta( 'description', get_query_var( 'author' ) );
	}

	elseif ( is_post_type_archive() ) {
		$desc = get_post_type_object( get_query_var( 'post_type' ) )->description;
	}

	return apply_filters( 'checathlon_archive_description', $desc );
}
add_filter( 'get_the_archive_description', 'checathlon_archive_description_filter', 5 );

/**
 * Set same template for Jetpack and Custom Content Portfolio categories and tags.
 *
 * @since  1.0.0
 * @param  string $template Template for displaying archive page.
 * @return string $template
 */
function checathlon_jetpack_portfolio_taxonomy_template( $template ) {
	// Jetpack portfolio template.
	if ( is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) ) {

		$new_template = locate_template( array( 'archive-jetpack-portfolio.php' ) );
		if ( '' != $new_template ) {
			return $new_template ;
		}

	}

	// Custom content portfolio template.
	if ( is_tax( 'portfolio_category' ) || is_tax( 'portfolio_tag' ) ) {

		$new_template = locate_template( array( 'archive-portfolio_project.php' ) );
		if ( '' != $new_template ) {
			return $new_template ;
		}

	}

	// Toot testimonials template.
	if ( is_tax( 'testimonial_category' ) ) {

		$new_template = locate_template( array( 'archive-testimonial.php' ) );
		if ( '' != $new_template ) {
			return $new_template ;
		}

	}

	return $template;
}
add_filter( 'taxonomy_template', 'checathlon_jetpack_portfolio_taxonomy_template', 99 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @param  array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function checathlon_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'checathlon_widget_tag_cloud_args' );

/**
 * Ditch subtitles in testimonial archives.
 *
 * @since  2.0.0
 * @param  boolean $supported Default behaviour when to show subtitles.
 * @return boolean $supported Modified behaviour when to show subtitles..
 */
function checathlon_mod_supported_views( $supported ) {
	if ( is_post_type_archive( array( 'testimonial', 'jetpack-testimonial' ) ) ) {
		return false;
	}

	return $supported;
}
add_filter( 'subtitle_view_supported', 'checathlon_mod_supported_views' );

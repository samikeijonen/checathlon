<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, checathlon of the functionality here could be replaced by core features.
 *
 * @package Checathlon
 */

/**
 * Prints HTML with meta information for the current post-date/time.
 */
function checathlon_posted_on() {

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		/* translators: 1: Posted on string 2: post author */
		esc_html_x( '%1$s %2$s', 'post date', 'checathlon' ),
		'<span class="screen-reader-text">' . esc_html__( 'Posted on', 'checathlon' ) . '</span>',
		'<a class="soft-color" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}

/**
 * Prints HTML with meta information for the current author.
 */
function checathlon_author() {

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'checathlon' ),
		'<span class="author vcard"><a class="url fn n soft-color" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.


}

/**
 * This template tag is meant to replace template tags like `the_category()`, `the_terms()`, etc.  These core
 * WordPress template tags don't offer proper translation and RTL support without having to write a lot of
 * messy code within the theme's templates.  This is why theme developers often have to resort to custom
 * functions to handle this (even the default WordPress themes do this). Particularly, the core functions
 * don't allow for theme developers to add the terms as placeholders in the accompanying text (ex: "Posted in %s").
 * This funcion is a wrapper for the WordPress `get_the_terms_list()` function.  It uses that to build a
 * better post terms list.
 *
 * @author  Justin Tadlock
 * @link    https://github.com/justintadlock/hybrid-core/blob/2.0/functions/template-post.php
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * @since   1.0.0
 * @param   array   $args
 * @return  string
 */
function checathlon_get_post_terms( $args = array() ) {

	$html = '';

	$defaults = array(
		'post_id'    => get_the_ID(),
		'taxonomy'   => 'category',
		'text'       => '%s',
		'before'     => '',
		'after'      => '',
		'items_wrap' => '<span %s>%s</span>',
		/* Translators: Separates tags, categories, etc. when displaying a post. */
		'sep'        => '<span class="screen-reader-text">' . esc_html_x( ', ', 'taxonomy terms separator', 'checathlon' ) . '</span>'
	);

	$args = wp_parse_args( $args, $defaults );

	$terms = get_the_term_list( $args['post_id'], $args['taxonomy'], '', $args['sep'], '' );

	if ( !empty( $terms ) ) {
		$html .= $args['before'];
		$html .= sprintf( $args['items_wrap'], 'class="entry-terms ' . $args['taxonomy'] . '"', sprintf( $args['text'], $terms ) );
		$html .= $args['after'];
	}

	return $html;
}

/**
 * Outputs a post's taxonomy terms.
 *
 * @since  1.0.0
 * @access public
 * @param  array   $args
 * @return void
 */
function checathlon_post_terms( $args = array() ) {
	echo checathlon_get_post_terms( $args );
}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function checathlon_entry_footer() {

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'checathlon' ) );
		if ( $categories_list && checathlon_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'checathlon' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'checathlon' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'checathlon' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'checathlon' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'checathlon' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}

/**
 * Read more link.
 *
 * @since 1.0.0
 */
function checathlon_get_read_more_link() {

	/* Translators: The %s is the post title shown to screen readers. */
	$text = sprintf( esc_attr__( 'Read more %s', 'checathlon' ), '<span class="screen-reader-text">' . get_the_title() ) .  '</span>';
	$more = sprintf( '<a href="%s" class="more-link underline-link medium-font-weight">%s %s</a>', esc_url( get_permalink() ), $text, checathlon_get_svg( array( 'icon' => 'next' ) ) );

	return $more;

}

/**
 * Outputs read more link.
 *
 * @since 1.0.0
 */
function checathlon_read_more_link() {

	echo checathlon_get_read_more_link();

}

/**
 * Custom comments popup link.
 *
 * @since 1.0.0
 */
function checathlon_comments_popup_link( $zero = false, $one = false, $more = false, $css_class = '', $none = false ) {

	$id     = get_the_ID();
	$title  = get_the_title();
	$number = get_comments_number( $id );
	$icon   = checathlon_get_svg( array( 'icon' => 'comment' ) );

	$css_class = 'comment-link soft-color medium-font-weight smaller-font-size';

	if ( false === $zero ) {
		/* translators: 1: Number of comments 2: post title */
		$zero = $icon . sprintf( wp_kses( __( '%1$s<span class="screen-reader-text"> Comment on %2$s</span>', 'checathlon' ), array( 'span' => array( 'class' => array() ) ) ), number_format_i18n( 0 ), $title );
	}

	if ( false === $one ) {
	/* translators: %s: post title */
		$one = $icon . sprintf( wp_kses( __( '1<span class="screen-reader-text"> Comment on %s</span>', 'checathlon' ), array( 'span' => array( 'class' => array() ) ) ), $title );
	}

	if ( false === $more ) {
		/* translators: 1: Number of comments 2: post title */
		$more = wp_kses( _n( '%1$s<span class="screen-reader-text"> Comment on %2$s</span>', '%1$s<span class="screen-reader-text"> Comments on %2$s</span>', $number, 'checathlon' ), array( 'span' => array( 'class' => array() ) ) );
		$more = $icon . sprintf( $more, number_format_i18n( $number ), $title );
	}

	if ( false === $none ) {
		$none = '';
	}

	if ( 0 == $number && !comments_open() && !pings_open() ) :
		return;
	else :
		comments_popup_link( $zero, $one, $more, $css_class, $none );
	endif;

}

/**
 * Get attachment URL by ID.
 *
 * @since 1.0.0
 */
function checathlon_attachment_url( $size = null, $id = null ) {

	// Set default size.
	if ( null === $size ) {
		$size = 'full';
	}

	// Set default ID.
	if ( null === $id ) {
		$id = get_the_ID();
	}

	// Get attachment image.
	$attachment_image = wp_get_attachment_image_src( absint( $id ), esc_attr( $size ), true );

	// Return attachment image url.
	return $attachment_image_url = $attachment_image[0];

}

/**
 * Display an optional post background.
 *
 * @since 1.0.0
 */
function checathlon_post_background( $post_thumbnail = null, $id = null ) {

	// Set default size.
	if ( null === $post_thumbnail ) {
		$post_thumbnail = 'post-thumbnail';
	}

	// Set default ID.
	if ( null === $id ) {
		$id = get_the_ID();
	}

	// Return post thumbnail url if it's set, else return false.
	if ( has_post_thumbnail( $id ) ) {
		$thumb_url_array = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), esc_attr( $post_thumbnail ), true );
		$bg              = $thumb_url_array[0];
	} else {
		$bg = false;
	}

	return $bg;

}

/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @since 1.0.0
 */
function checathlon_post_thumbnail( $post_thumbnail = null ) {

	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() || is_page_template( 'templates/no-featured-image.php' ) ) {
		return;
	}

	// Set default size.
	if ( null === $post_thumbnail ) {
		$post_thumbnail = 'post-thumbnail';
	}

	if ( is_singular() && ! is_page_template( 'templates/team-page.php' ) && ! checathlon_is_featured_page() && ! checathlon_is_front_page() ) :
	?>

		<div class="entry-media post-thumbnail post-thumbnail-singular">
			<?php the_post_thumbnail( esc_attr( $post_thumbnail ) ); ?>
		</div><!-- .post-thumbnail -->

	<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( esc_attr( $post_thumbnail ), array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
		</a>

	<?php endif; // End is_singular()
}

/**
 * Get post thubmnail as background image.
 *
 * Uses checathlon_post_background function.
 */
function checathlon_get_bg_header( $args = array() ) {

	$defaults = array(
		'post_id' => get_the_ID(),
		'size'    => 'medium_large',
		'icon'    => 'pencil',
	);

	$args = wp_parse_args( $args, $defaults );

	// Get featured image as post background image.
	$checathlon_bg = checathlon_post_background( $args['size'] );

	// Start markup.
	$markup = '';

	if ( has_post_thumbnail( $args['post_id'] ) ) :
		$markup .= '<div class="entry-header-bg" style="background-image:url(' . esc_url( $checathlon_bg ) . ');">';
			$markup .= '<a class="entry-header-bg-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark"><span class="screen-reader-text">' . esc_html__( 'Continue reading', 'checathlon' ) . ' ' . get_the_title() . '</span></a>';
	else :
		$markup .= '<div class="entry-header-bg">';
		$markup .= '<a class="entry-header-bg-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . checathlon_get_svg( array( 'icon' => $args['icon'] ) ) . '<span class="screen-reader-text">' . esc_html__( 'Continue reading', 'checathlon' ) . ' ' . get_the_title() . '</span></a>';
	endif;

	$markup .= '</div>';

	return $markup;
}

/**
 * Display default footer text.
 *
 */
function checathlon_default_footer_text() { ?>

	<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'checathlon' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'checathlon' ), 'WordPress' ); ?></a>
	<span class="sep"> &middot; </span>
	<?php printf( esc_html__( 'Theme: %1$s by %2$s', 'checathlon' ), 'Checathlon', '<a href="https://foxland.fi/">Foxland</a>' );
}

/**
 * Display post pagination.
 *
 * Use WordPress native the_posts_pagination function.
 */
function checathlon_posts_pagination() {

	the_posts_pagination( array(
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'checathlon' ) . ' </span>',
	) );

}

/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function checathlon_the_custom_logo() {

	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}

}

/**
 * Check if we're on Front Page template.
 *
 * @since  1.0.0
 *
 * @return boolean.
 */
function checathlon_is_front_page_template() {
	return is_page_template( 'templates/featured-page.php' ) || checathlon_is_front_page();
}

/**
 * Check if we are on front page.
 *
 * @return bool
 */
function checathlon_is_front_page() {
	return ( ! is_home() && is_front_page() );
}

/**
 * Check if we are on Featured Page Template.
 *
 * @return bool
 */
function checathlon_is_featured_page() {
	return is_page_template( 'templates/featured-page.php' );
}

/**
 * Check if we are on Pricing Page Template.
 *
 * @return bool
 */
function checathlon_is_pricing_page() {
	return is_page_template( 'templates/pricing-page.php' );
}

/**
 * Check if main sidebar have any widgets.
 *
 * @return bool
 */
function checathlon_has_main_sidebar_widgets() {
	return is_active_sidebar( 'sidebar-1' );
}

/**
 * Check if after content widget area have any widgets.
 *
 * @return bool
 */
function checathlon_has_after_content_widgets() {
	return is_active_sidebar( 'sidebar-2' );
}

/**
 * Check if before footer widget area have any widgets.
 *
 * @return bool
 */
function checathlon_has_before_footer_widgets() {
	return ( is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-4' ) || is_active_sidebar( 'sidebar-5' ) );
}

/**
 * Check if after content or front page widget area have any widgets.
 *
 * @return bool
 */
function checathlon_has_after_content_front_page_widgets() {
	return ( is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-8' ) );
}

/**
 * Check if front page widget area have any widgets.
 *
 * @return bool
 */
function checathlon_has_front_page_widgets() {
	return is_active_sidebar( 'sidebar-8' );
}

/**
 * Check if service and pricing widget area have any widgets.
 *
 * @return bool
 */
function checathlon_has_service_pricing_widgets() {
	return is_active_sidebar( 'sidebar-9' );
}

/**
 * Check if download sidebar have any widgets.
 *
 * @return bool
 */
function checathlon_has_download_sidebar_widgets() {
	return is_active_sidebar( 'sidebar-10' );
}

/**
 * Check when to show main sidebar.
 *
 * @return bool
 */
function checathlon_show_main_sidebar() {
	return apply_filters( 'checathlon_show_main_sidebar', is_singular( array( 'post', 'page' ) ) );
}

/**
 * Check when to show main sidebar.
 *
 * @return bool
 */
function checathlon_show_download_sidebar() {
	return apply_filters( 'checathlon_show_download_sidebar', is_singular( array( 'download' ) ) );
}

/**
 * Check if we are on EDD checkout page.
 *
 * @return bool
 */
function checathlon_edd_is_checkout() {
	return ( function_exists( 'edd_is_checkout' ) && edd_is_checkout() );
}

/**
 * Check if we are on EDD checkout page and cart is empty.
 *
 * @return bool
 */
function checathlon_edd_is_checkout_cart_empty() {
	return ( function_exists( 'edd_is_checkout' ) && edd_is_checkout() && ! edd_get_cart_contents() && ! edd_cart_has_fees() );
}

/**
 * Check if hide purchace link ic checked.
 *
 * @return bool
 */
function checathlon_edd_is_purchace_link_hidden() {
	$edd_hide_purchace_link = get_post_meta( get_the_ID(), '_edd_hide_purchase_link', true );

	return ( isset( $edd_hide_purchace_link ) && $edd_hide_purchace_link );
}

/**
 * When to hide header image.
 *
 * @return bool
 */
function checathlon_hide_header_image() {
	return apply_filters( 'checathlon_hide_header_image', is_singular( 'post' ) );
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function checathlon_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'checathlon_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'checathlon_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so checathlon_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so checathlon_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in checathlon_categorized_blog.
 */
function checathlon_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'checathlon_categories' );
}
add_action( 'edit_category', 'checathlon_category_transient_flusher' );
add_action( 'save_post',     'checathlon_category_transient_flusher' );

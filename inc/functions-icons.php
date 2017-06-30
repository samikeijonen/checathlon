<?php
/**
 * Icon (SVG) related functions and filters.
 *
 * @package Checathlon
 */

/**
 * Add SVG definitions to the footer.
 *
 * @since 1.0.0
 */
function checathlon_include_svg_icons() {

	// Define SVG sprite file.
	$svg_icons = get_template_directory() . '/assets/images/svg-icons.svg';

	// If it exists, include it.
	if ( file_exists( $svg_icons ) ) {
		require_once( $svg_icons );
	}

}
add_action( 'wp_footer', 'checathlon_include_svg_icons', 9999 );
add_action( 'admin_footer-appearance_page_checathlon', 'checathlon_include_svg_icons', 9999 ); // Load icons under Appearance >> Checathlon.

/**
 * Return SVG markup.
 *
 * @param array $args {
 *     Parameters needed to display an SVG.
 *
 *     @type string $icon  Required SVG icon filename.
 *     @type string $title Optional SVG title.
 *     @type string $desc  Optional SVG description.
 * }
 * @return string SVG markup.
 */
function checathlon_get_svg( $args = array() ) {
	// Make sure $args are an array.
	if ( empty( $args ) ) {
		return esc_html__( 'Please define default parameters in the form of an array.', 'checathlon' );
	}

	// Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return esc_html__( 'Please define an SVG icon filename.', 'checathlon' );
	}

	// Set defaults.
	$defaults = array(
		'icon'     => '',
		'title'    => '',
		'desc'     => '',
		'fallback' => false,
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Set aria hidden.
	$aria_hidden = ' aria-hidden="true"';

	// Set ARIA for title and desc with unique ID.
	$aria_labelledby = '';

	if ( $args['title'] && $args['desc'] ) {
		$unique_id       = uniqid();
		$aria_labelledby = ' aria-labelledby="title-' . $unique_id . ' desc-' . $unique_id . '"';
		$aria_hidden     = '';
	}

	// Begin SVG markup.
	$svg = '<svg class="icon icon-' . esc_attr( $args['icon'] ) . '"' . $aria_hidden . $aria_labelledby . ' role="img">';

	// If there is a title, display it.
	if ( $args['title'] ) {
		$svg .= '<title id="title-' . $unique_id . '">' . esc_html( $args['title'] ) . '</title>';
	}

	// If there is a description, display it.
	if ( $args['desc'] ) {
		$svg .= '<desc id="desc-' . $unique_id . '">' . esc_html( $args['desc'] ) . '</desc>';
	}

	/*
	 * Display the icon.
	 *
	 * The whitespace around `<use>` is intentional. See https://core.trac.wordpress.org/ticket/38387.
	 */
	$svg .= ' <use xlink:href="#icon-' . esc_html( $args['icon'] ) . '" /> ';

	// Add some markup to use as a fallback for browsers that do not support SVGs.
	if ( $args['fallback'] ) {
		$svg .= '<span class="svg-fallback icon-' . esc_attr( $args['icon'] ) . '"></span>';
	}

	$svg .= '</svg>';

	return $svg;
}

/**
 * Display SVG icons in social navigation.
 *
 * @since 1.0.0
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item output with social icon.
 */
function checathlon_nav_social_icons( $item_output, $item, $depth, $args ) {
	// Get supported social icons.
	$social_icons = checathlon_social_links_icons();

	// Change SVG icon inside social links menu if there is supported URL.
	if ( 'social' === $args->theme_location ) {
		foreach ( $social_icons as $attr => $value ) {
			if ( false !== strpos( $item_output, $attr ) ) {
				$item_output = str_replace( $args->link_after, '</span>' . checathlon_get_svg( array( 'icon' => esc_attr( $value ) ) ), $item_output );
			}
		}
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'checathlon_nav_social_icons', 10, 4 );

/**
 * Add dropdown icon if menu item has children.
 *
 * @param  string $title The menu item's title.
 * @param  object $item  The current menu item.
 * @param  array  $args  An array of wp_nav_menu() arguments.
 * @param  int    $depth Depth of menu item. Used for padding.
 * @return string $title The menu item's title with dropdown icon.
 */
function checathlon_dropdown_icon_to_menu_link( $title, $item, $args, $depth ) {
	if ( 'primary' === $args->theme_location ) {
		foreach ( $item->classes as $value ) {
			if ( 'menu-item-has-children' === $value ) {
				$title = $title . checathlon_get_svg( array( 'icon' => 'angle-down' ) );
			}
		}
	}

	return $title;
}
add_filter( 'nav_menu_item_title', 'checathlon_dropdown_icon_to_menu_link', 10, 4 );

/**
 * Returns an array of supported social links (URL and icon name).
 *
 * @return array $social_links_icons
 */
function checathlon_social_links_icons() {
	// Supported social links icons.
	$social_links_icons = array(
		'behance.net'     => 'behance',
		'codepen.io'      => 'codepen',
		'deviantart.com'  => 'deviantart',
		'digg.com'        => 'digg',
		'dribbble.com'    => 'dribbble',
		'dropbox.com'     => 'dropbox',
		'facebook.com'    => 'facebook',
		'flickr.com'      => 'flickr',
		'foursquare.com'  => 'foursquare',
		'plus.google.com' => 'google-plus',
		'github.com'      => 'github',
		'instagram.com'   => 'instagram',
		'linkedin.com'    => 'linkedin',
		'mailto:'         => 'envelope-o',
		'medium.com'      => 'medium',
		'pinterest.com'   => 'pinterest-p',
		'getpocket.com'   => 'get-pocket',
		'reddit.com'      => 'reddit-alien',
		'skype.com'       => 'skype',
		'skype:'          => 'skype',
		'slideshare.net'  => 'slideshare',
		'snapchat.com'    => 'snapchat-ghost',
		'soundcloud.com'  => 'soundcloud',
		'spotify.com'     => 'spotify',
		'stumbleupon.com' => 'stumbleupon',
		'tumblr.com'      => 'tumblr',
		'twitch.tv'       => 'twitch',
		'twitter.com'     => 'twitter',
		'vimeo.com'       => 'vimeo',
		'vine.co'         => 'vine',
		'vk.com'          => 'vk',
		'weibo.com'       => 'weibo',
		'wordpress.org'   => 'wordpress',
		'wordpress.com'   => 'wordpress',
		'yelp.com'        => 'yelp',
		'youtube.com'     => 'youtube',
	);

	return apply_filters( 'checathlon_social_links_icons', $social_links_icons );
}

/**
 * Returns an array of SVG icons names.
 *
 * @since  1.0.0
 *
 * @return array $icons
 */
function checathlon_get_svg_icons() {
	// Supported icons.
	$icons = array(
		'check'          => 'check',
		'pencil'         => 'pencil',
		'angle-down'     => 'angle-down',
		'clock-o'        => 'clock-o',
		'download'       => 'download',
		'phone'          => 'phone',
		'search'         => 'search',
		'info'           => 'info',
		'map-marker'     => 'map-marker',
		'feed'           => 'feed',
		'folder-open'    => 'folder-open',
		'tag'            => 'tag',
		'comment'        => 'comment',
		'bolt'           => 'bolt',
		'heart'          => 'heart',
		'user'           => 'user',
		'film'           => 'film',
		'signal'         => 'signal',
		'cog'            => 'cog',
		'road'           => 'road',
		'lock'           => 'lock',
		'flag'           => 'flag',
		'volume-up'      => 'volume-up',
		'camera'         => 'camera',
		'check-square-o' => 'check-square-o',
		'leaf'           => 'leaf',
		'plane'          => 'plane',
		'thumbs-o-up'    => 'thumbs-o-up',
		'chain'          => 'chain',
		'upload'         => 'upload',
		'unlock'         => 'unlock',
		'credit-card'    => 'credit-card',
		'gavel'          => 'gavel',
		'umbrella'       => 'umbrella',
		'coffee'         => 'coffee',
		'cutlery'        => 'cutlery',
		'microphone'     => 'microphone',
		'shield'         => 'shield',
		'html5'          => 'html5',
		'female'         => 'female',
		'male'           => 'male',
		'space-shuttle'  => 'space-shuttle',
		'share-alt'      => 'share-alt',
		'star'           => 'star',
		'paint-brush'    => 'paint-brush',
		'rocket'         => 'rocket',
		'diamond'        => 'diamond',
		'shopping-cart'  => 'shopping-cart',
		'404'            => '404',
		'tablet'         => 'tablet',
		'file-text-o'    => 'file-text-o',
	);

	return apply_filters( 'checathlon_svg_icons', $icons );
}

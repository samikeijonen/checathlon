<?php
/**
 * Checathlon functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Checathlon
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function checathlon_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Checathlon, use a find and replace
	 * to change 'checathlon' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'checathlon', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Default image size.
	set_post_thumbnail_size( 680, 680, true );

	// Add custom image sizes.
	add_image_size( 'checathlon-singular', 1240, 3000, false );
	add_image_size( 'checathlon-product', 1080, 3000, false );
	add_image_size( 'checathlon-team', 1020, 720, true );
	add_image_size( 'checathlon-small', 200, 200, true );

	// This theme uses wp_nav_menu() in two location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'checathlon' ),
		'social'  => esc_html__( 'Social Links', 'checathlon' ),
	) );

	// Add support for logo.
	add_theme_support( 'custom-logo', apply_filters( 'checathlon_custom_logo_arguments', array(
		'height'     => 60,
		'width'      => 60,
		'flex-width' => true,
	) ) );

	/*
	 * Add support for selective refresh.
	 *
	 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#widgets-opting-in-to-selective-refresh
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add excerpt to pages.
	add_post_type_support( 'page', 'excerpt' );

	// Add support for Custom Content Portfolio Plugin
	add_theme_support( 'custom-content-portfolio' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'assets/css/editor-style.css' ) );

}
add_action( 'after_setup_theme', 'checathlon_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function checathlon_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'checathlon_content_width', 740 );
}
add_action( 'after_setup_theme', 'checathlon_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function checathlon_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Main sidebar', 'checathlon' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here for posts or pages.', 'checathlon' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner-wrappper">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Widget area after content', 'checathlon' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here for after posts or pages.', 'checathlon' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner-wrappper">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Before footer widget area 1', 'checathlon' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here for before footer widget area 1.', 'checathlon' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Before footer widget area 2', 'checathlon' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Add widgets here for before footer widget area 2.', 'checathlon' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Before footer widget area 3', 'checathlon' ),
		'id'            => 'sidebar-5',
		'description'   => esc_html__( 'Add widgets here for before footer widget area 3.', 'checathlon' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer widget area 1', 'checathlon' ),
		'id'            => 'sidebar-6',
		'description'   => esc_html__( 'Add widgets here for footer widget area 1.', 'checathlon' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer widget area 2', 'checathlon' ),
		'id'            => 'sidebar-7',
		'description'   => esc_html__( 'Add widgets here for footer widget area 2.', 'checathlon' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Front Page widget area', 'checathlon' ),
		'id'            => 'sidebar-8',
		'description'   => esc_html__( 'Add widgets here for Front Page widget area.', 'checathlon' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner-wrappper">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Service and Pricing widget area', 'checathlon' ),
		'id'            => 'sidebar-9',
		'description'   => esc_html__( 'Add Service and Pricing Widgets here, they appear in Front Page or Pricing Page Template.', 'checathlon' ),
		'before_widget' => '<div id="%1$s" class="hentry %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="entry-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar for downloads', 'checathlon' ),
		'id'            => 'sidebar-10',
		'description'   => esc_html__( 'Add widgets here for downloads.', 'checathlon' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner-wrappper">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'checathlon_widgets_init' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 */
function checathlon_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'checathlon_javascript_detection', 0 );

/**
 * Register Google fonts.
 *
 * @since 1.0.0
 *
 * @return string Google fonts URL for the theme.
 */
function checathlon_fonts_url() {

	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Source Sans Pro, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_attr_x( 'on', 'Source Sans Pro font: on or off', 'checathlon' ) ) {
		$fonts[] = 'Source Sans Pro:400,600,700,400italic,600italic,700italic';
	}

	/* translators: If there are characters in your language that are not supported by Lora, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_attr_x( 'on', 'Lora font: on or off', 'checathlon' ) ) {
		$fonts[] = 'Lora:400,700,400italic,700italic';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Add preconnect for Google Fonts.
 *
 * @param  array  $urls          URLs to print for resource hints.
 * @param  string $relation_type The relation type the URLs are printed.
 * @return array  URLs to print for resource hints.
 */
function checathlon_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'checathlon-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '>=' ) ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		} else {
			$urls[] = 'https://fonts.gstatic.com';
		}
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'checathlon_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function checathlon_scripts() {

	// Get '.min' suffix.
	$suffix = checathlon_get_min_suffix();

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'checathlon-fonts', checathlon_fonts_url(), array(), null );

	// Add parent theme styles if using child theme.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'checathlon-parent-style', trailingslashit( get_template_directory_uri() ) . 'style' . $suffix . '.css', array(), null );
	}

	// Add theme styles.
	wp_enqueue_style( 'checathlon-style', get_stylesheet_uri() );

	// Add theme scripts.
	wp_enqueue_script( 'checathlon-navigation', get_template_directory_uri() . '/assets/js/navigation' . $suffix . '.js', array(), '20160912', true );

	// Add comment scripts.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'checathlon_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Implement the Custom Background feature.
 */
require get_template_directory() . '/inc/custom-background.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load icon (SVG) functions file.
 */
require get_template_directory() . '/inc/functions-icons.php';

/**
 * Load theme options file.
 */
require get_template_directory() . '/inc/functions-options.php';

/**
 * Load theme filters file.
 */
require get_template_directory() . '/inc/functions-filters.php';

/**
 * Load theme scripts related file.
 */
require get_template_directory() . '/inc/functions-scripts.php';

/**
 * Load Easy Digital Downloads functions file.
 */
require get_template_directory() . '/inc/functions-edd.php';

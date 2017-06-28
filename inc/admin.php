<?php
/**
 * Handles the theme welcome/info screen in the admin.
 *
 * @package    Checathlon
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2013 - 2016, Justin Tadlock
 * @link       http://themehybrid.com/themes/checathlon
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Adds a custom themes sub-page.
 *
 * @since  1.1.0
 * @access public
 * @return void
 */
function checathlon_admin_menu() {
	$theme = wp_get_theme( get_template() );

	$page = add_theme_page( $theme->display( 'Name' ), $theme->display( 'Name' ), 'edit_theme_options', 'checathlon', 'checathlon_welcome_page' );

	if ( $page ) {
		add_action( "admin_head-{$page}", 'checathlon_welcome_page_css' );
	}
}
add_action( 'admin_menu', 'checathlon_admin_menu' );

/**
 * Outputs some custom CSS to the welcome screen.
 *
 * @since  1.1.0
 * @access public
 * @return void
 */
function checathlon_welcome_page_css() { ?>

	<style type="text/css" media="screen">
		.appearance_page_checathlon .three-col {
			clear: both;
		}
		.appearance_page_checathlon .col .dashicons {
			margin-top: 7px; margin-right: 4px;
		}
		.icons-wrapper {
			display: -ms-flexbox;
			display: flex;
			-ms-flex-wrap: wrap;
			flex-wrap: wrap;
			margin: -0.75em;
		}

		.icons-wrapper > * {
			-ms-flex: 1 0 8em;
			flex: 1 0 8em;
			margin: 0.75em;
		}
		.url-wrap {
			display: block;
		}
		.icon {
			display: inline-block;
			fill: currentColor;
			position: relative; /* Align more nicely with capital letters */
			top: -0.0625em;
			vertical-align: middle;
			width: 2em;
			height: 2em;
		}
	</style>
<?php }

/**
 * Outputs the custom admin screen.
 *
 * @since  2.1.0
 * @access public
 * @return void
 */
function checathlon_welcome_page() {

	$theme = wp_get_theme( get_template() ); ?>

	<div class="wrap about-wrap">

		<h1><?php echo $theme->display( 'Name' ); ?></h1>

		<div class="two-col">

			<div class="col about-text">
				<?php echo $theme->display( 'Description' ); ?>
			</div><!-- .col -->

			<div class="col">
				<img src="<?php echo trailingslashit( get_template_directory_uri() ); ?>screenshot.png" alt="" />
			</div><!-- .col -->

		</div><!-- .two-col -->

		<div class="three-col">

			<div class="col">

				<h3><i class="dashicons dashicons-sos" aria-hidden="true"></i><?php esc_html_e( 'More Features', 'checathlon' ); ?></h3>

				<p>
					<?php esc_html_e( 'Checathlon Plus is Plugin that gives power and more features to Checathlon Theme.', 'checathlon' ); ?>
				</p>

				<p>
					<a class="button button-primary" href="https://foxland.fi/downloads/checathlon-plus/" target="_blank"><?php esc_html_e( 'Get Checathlon Plus', 'checathlon' ); ?></a>
				</p>

			</div><!-- .col -->

			<div class="col">

				<h3><i class="dashicons dashicons-admin-appearance" aria-hidden="true"></i><?php esc_html_e( 'Help &amp; Documentation', 'checathlon' ); ?></h3>

				<p>
					<?php esc_html_e( 'With Checathlon Plus you also get priority support. See also documentation.', 'checathlon' ); ?>
				</p>

				<p>
					<a class="button button-primary" href="https://foxland.fi/documents/for/checathlon/" target="_blank"><?php esc_html_e( 'View Documentation', 'checathlon' ); ?></a>
				</p>

			</div><!-- .col -->

			<div class="col">

				<h3><i class="dashicons dashicons-admin-plugins" aria-hidden="true"></i><?php esc_html_e( 'Supported Plugins', 'checathlon' ); ?></h3>

				<p>
					<?php esc_html_e( 'Do you need extra functionality? Checathlon has built-in support for the following plugins.', 'checathlon' ); ?>
				</p>

				<ul>
					<li><a href="https://wordpress.org/plugins/easy-digital-downloads/"><?php esc_html_e( 'Easy Digital Downloads', 'checathlon' ); ?></a></li>
					<li><a href="https://wordpress.org/plugins/custom-content-portfolio/"><?php esc_html_e( 'Custom Content Portfolio', 'checathlon' ); ?></a></li>
					<li><a href="https://wordpress.org/plugins/jetpack/"><?php esc_html_e( 'Jetpack', 'checathlon' ); ?></a></li>
				</ul>

			</div><!-- .col -->

		</div><!-- .three-col -->

		<div class="two-col">

			<div class="col">
				<h3><?php esc_html_e( 'Supported Social Links Menu Icons', 'checathlon' ); ?></h3>
				<?php
					// Get social icons.
					$social_icons = checathlon_social_links_icons();

					// Loop them.
					echo '<div class="icons-wrapper">';
					foreach ( $social_icons as $url => $icon ) {
						echo '<div class="icon-wrapper">';
							echo '<span class="icon-wrap">' . checathlon_get_svg( array( 'icon' => $icon ) ) . '</span>';
							echo '<span class="url-wrap">' . $url . '</span>';
						echo '</div>';
					}
					echo '</div>';
				?>
			</div><!-- .col -->

			<div class="col">
				<h3><?php esc_html_e( 'Other Icons', 'checathlon' ); ?></h3>
				<?php
					// Get other icons.
					$other_icons = checathlon_get_svg_icons();

					// Loop them.
					echo '<div class="icons-wrapper">';
					foreach ( $other_icons as $name => $icon ) {
						echo '<div class="icon-wrapper">';
							echo '<span class="icon-wrap">' . checathlon_get_svg( array( 'icon' => $icon ) ) . '</span>';
							echo '<span class="url-wrap">' . $name . '</span>';
						echo '</div>';
					}
					echo '</div>';
				?>
			</div><!-- .col -->

		</div><!-- .two-col -->

	</div><!-- .wrap -->

<?php
}

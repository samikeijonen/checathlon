<?php
/**
 * Primary menu.
 *
 * @package Checathlon
 */
?>

<?php if ( has_nav_menu( 'primary' ) ) : // Check do we have primary menu. ?>

	<button class="menu-toggle" id="menu-toggle" type="button" aria-controls="primary-menu" aria-expanded="false">
		<span class="menu-toggle-svg-wrapper" id="menu-toggle-svg-wrapper">
			<svg class="icon icon-menu-toggle" aria-hidden="true" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100">
				<g class="svg-menu-toggle">
					<path class="bar line-1" d="M5 13h90v14H5z"/>
					<path class="bar line-2" d="M5 43h90v14H5z"/>
					<path class="bar line-3" d="M5 73h90v14H5z"/>
				</g>
			</svg>
		</span>
		<span class="menu-toggle-text screen-reader-text" id="menu-toggle-text"><?php esc_html_e( 'Menu', 'checathlon' ); ?></span>
	</button>

	<div class="main-navigation-wrapper" id="main-navigation-wrapper">
		<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'checathlon' ); ?>">
			<?php
				// Set theme location.
				$theme_location = checathlon_edd_is_checkout() && has_nav_menu( 'checkout' ) ? 'checkout' : 'primary';

				wp_nav_menu( array(
					'container_class' => 'primary-menu-wrapper',
					'theme_location'  => $theme_location,
					'menu_id'         => 'primary-menu',
					'menu_class'      => 'primary-menu',
				) );
			?>
		</nav><!-- #site-navigation -->
	</div><!-- .main-navigation-wrapper -->

<?php endif; // End check for primary menu.

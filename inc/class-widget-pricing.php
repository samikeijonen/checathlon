<?php
/**
 * Pricing widget for creating pricing tables.
 *
 * @package Checathlon
 */

/**
 * Class used to implement a Pricing widget.
 *
 * @since 1.0.0
 *
 * @see WP_Widget
 */
class Checathlon_Widget_Pricing extends WP_Widget {

	/**
	 * Sets up a new Pricing widget instance.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'checathlon_widget_pricing',
			'description'                 => esc_html__( 'Info about your services or pricing.', 'checathlon' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 400, 'height' => 350 );
		parent::__construct( 'checathlon_widget_pricing', esc_html__( 'Service and Pricing Widget (Checathlon)', 'checathlon' ), $widget_ops, $control_ops );
	}

	/**
	 * Outputs the content for the current Text widget instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Pricing widget instance.
	 */
	public function widget( $args, $instance ) {
		
		// Get icon.
		$icon = ! empty( $instance['icon'] ) ? $instance['icon'] : '';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		
		// Highlight title.
		$highlight_title = ! empty( $instance['highlight_title'] ) ? $instance['highlight_title'] : '';
		
		// Get content.
		$pricing_widget_content = ! empty( $instance['text'] ) ? $instance['text'] : '';
		
		// Get price.
		$price = ! empty( $instance['price'] ) ? $instance['price'] : '';
		
		// Get link text and url.
		$link_text = ! empty( $instance['link_text'] ) ? $instance['link_text'] : '';
		$link_url  = ! empty( $instance['link_url'] )  ? $instance['link_url']  : '';

		/**
		 * Filters the content of the Pricing widget.
		 *
		 * @since 1.0.0
		 *
		 * @param string                    $checathlon_widget_pricing The pricing widget content.
		 * @param array                     $instance                  Array of settings for the current widget.
		 * @param Checathlon_Widget_Pricing $this                      Current Pricing widget instance.
		 */
		$text = apply_filters( 'checathlon_widget_pricing', $pricing_widget_content, $instance, $this );

		echo $args['before_widget'];
		
		// Set highlight class.
		$highlight_class = ! empty( $instance['highlight_title'] ) ? ' highlight-pricing' : '';
		
		if( checathlon_is_pricing_page() || checathlon_is_featured_page() || checathlon_is_front_page() ) {
			echo '<div class="entry-inner-wrapper' . $highlight_class . '">';
			
			if ( '' !== $highlight_title ) {
				echo '<p class="highlight-title no-margin-bottom">' . esc_html( $highlight_title ) . '</p>';
			}
		}
		?>
			
		<div class="checathlon-widget-pricing-content<?php if( checathlon_is_pricing_page() || checathlon_is_featured_page() || checathlon_is_front_page() ) echo ' entry-inner';?>">
			<?php
				if ( '' !== $icon ) {
					echo checathlon_get_svg( array( 'icon' => esc_attr( $icon ) ) );
				}
				if ( ! empty( $title ) ) {
					echo $args['before_title'] . $title . $args['after_title'];
				}
			?>
			<div class="checathlon-widget-pricing-entry-content">
				<?php echo ! empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?>
			</div><!-- .checathlon-widget-pricing-entry-content -->
			
		</div><!-- .checathlon-widget-pricing-content -->
			
		<div class="checathlon-widget-pricing-price-link<?php if( checathlon_is_pricing_page() || checathlon_is_featured_page() || checathlon_is_front_page() ) echo ' entry-product-info';?>">
			<?php if ( '' !== $price ) { ?>
				<p class="checathlon-widget-pricing-price medium-font-weight no-margin-bottom"><?php echo esc_attr( $price ); ?></p>
			<?php } ?>
				
			<?php if ( '' !== $link_url && '' !== $link_text ) { ?>
				<p class="checathlon-widget-pricing-link no-margin-bottom"><?php echo '<a class="checathlon-price-button button" href="' . esc_url( $link_url ) . '">' . esc_attr( $link_text ) . '</a>' ?></p>
			<?php } ?>
		</div><!-- .checathlon-widget-pricing-price-link -->

		<?php
		if( checathlon_is_pricing_page() || checathlon_is_featured_page() || checathlon_is_front_page() ) {
			echo '</div><!-- .entry-inner-wrapper -->';
		}
		echo $args['after_widget'];
	}

	/**
	 * Handles updating settings for the current Pricing widget instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		// Sanitize icon.
		$instance['icon'] = sanitize_key( $new_instance['icon'] );
		
		// Sanitize title.
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		
		// Sanitize title.
		$instance['highlight_title'] = sanitize_text_field( $new_instance['highlight_title'] );
		
		// Sanitize content.
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = wp_kses_post( $new_instance['text'] );
		}
		$instance['filter'] = ! empty( $new_instance['filter'] );
		
		// Sanitize price.
		$instance['price'] = sanitize_text_field( $new_instance['price'] );
		
		// Sanitize link text and url.
		$instance['link_text'] = sanitize_text_field( $new_instance['link_text'] );
		$instance['link_url']  = esc_url_raw( $new_instance['link_url'] );
		
		return $instance;
	}

	/**
	 * Outputs the Pricing widget settings form.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$instance  = wp_parse_args( (array) $instance, array( 'icon' => '', 'title' => '', 'highlight_title' => '', 'text' => '', 'price' => '', 'link_text' => '', 'link_url' => '' ) );
		$filter    = isset( $instance['filter'] ) ? $instance['filter'] : 0;
		$title     = sanitize_text_field( $instance['title'] );
		
		// Get supported icons.
		$icons = checathlon_get_svg_icons();
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'icon' ); ?>"><?php esc_html_e( 'Icon:', 'checathlon' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'icon' ); ?>" name="<?php echo $this->get_field_name( 'icon' ); ?>">
				<option value="0"><?php esc_html_e( 'Select icon', 'checathlon' ); ?></option>
				<?php
					foreach ( $icons as $value => $icon ) {
						printf(
							'<option value="%s"%s>%s</option>',
							esc_attr( $value ),
							selected( $value, $instance['icon'], false ),
							esc_attr( $icon )
						);
					}
				?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'checathlon' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'highlight_title' ); ?>"><?php esc_html_e( 'Hightlight Title (use for the most important service or price):', 'checathlon' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'highlight_title' ); ?>" name="<?php echo $this->get_field_name( 'highlight_title' ); ?>" type="text" value="<?php echo esc_attr( $instance['highlight_title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php esc_html_e( 'Content:', 'checathlon' ); ?></label>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_textarea( $instance['text'] ); ?></textarea>
		</p>
		
		<p>
			<input id="<?php echo $this->get_field_id( 'filter' ); ?>" name="<?php echo $this->get_field_name( 'filter' ); ?>" type="checkbox"<?php checked( $filter ); ?> />&nbsp;<label for="<?php echo $this->get_field_id( 'filter' ); ?>"><?php esc_html_e( 'Automatically add paragraphs', 'checathlon' ); ?></label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'price' ); ?>"><?php esc_html_e( 'Price:', 'checathlon' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'price' ); ?>" name="<?php echo $this->get_field_name( 'price' ); ?>" type="text" value="<?php echo esc_attr( $instance['price'] ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'link_text' ); ?>"><?php esc_html_e( 'Link text:', 'checathlon' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link_text' ); ?>" name="<?php echo $this->get_field_name( 'link_text' ); ?>" type="text" value="<?php echo esc_attr( $instance['link_text'] ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'link_url' ); ?>"><?php esc_html_e( 'Link URL:', 'checathlon' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link_url' ); ?>" name="<?php echo $this->get_field_name( 'link_url' ); ?>" type="text" value="<?php echo esc_url( $instance['link_url'] ); ?>" />
		</p>

		<?php
	}
	
}

/**
 * Register Widgets
 *
 * @since 1.0.0
*/
function checathlon_register_widgets() {
	register_widget( 'Checathlon_Widget_Pricing' );
}
add_action( 'widgets_init', 'checathlon_register_widgets' );
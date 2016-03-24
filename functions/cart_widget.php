<?php

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');


add_action( 'widgets_init', function(){
     register_widget( 'Cart_Widget' );
});

/**
 * Adds Cart_Widget widget.
 */
class Cart_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'Cart_Widget', // Base ID
			__('ePages Cart', 'text_domain'), // Name
			array( 'description' => __( 'Add ePages cart to your sidebar', 'epages' ), ) // Args
		);
	}

	/**
	 * Display the cart widget in Frontend.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	 function widget( $args, $instance ) {
		 echo $args['before_widget'];
		 if ( ! empty( $instance['title'] ) ) {
			 echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		 }
		 echo '<button class="epages-cart-button"><i class="fa fa-2x fa-shopping-cart"></i><span></span></button>';
		 echo "<script>
		 	cart = JSON.parse(localStorage.getItem('epages-shop-cart-cart'));
			document.querySelector('.epages-cart-button span').innerHTML = cart.length;
		</script>";
	}


	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'epages' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

} // class Cart_Widget

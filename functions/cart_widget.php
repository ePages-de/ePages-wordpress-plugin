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
			__('Basket widget', 'epages-online-shop'), // Name
			array( 'description' => __( 'Add ePages basket to sidebar', 'epages-online-shop' )) // Args
		);
    wp_enqueue_script("icon", EPAGES_PLUGIN_URL . "/assets/js/icon.js", array(), false, true);
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
     echo '<section id="epages-section" class="widget widget_epages">';
     echo '<div class="epages-shop-cart fake" style="float:left;" id="';
     echo get_option("epages_api_url");
     echo '">
      <button class="epages-cart-button" id="cartShow">
        <i class="fa fa-shopping-cart"></i>
        <span>0</span>
      </button>
     </div>
     <div class="modal" id="cartModal">
       <div class="modal-content epages-cart-overlay">
         <span class="close pico-close fa fa-2x fa-times-circle undefined"></span>
         <h2 class="epages-cart-healine" data-i18n="basket">Basket</h2>
         <div class="epages-cart-overlay-not-empty">
           <div class="epages-categories-spinner-container"><img src="http://site-production.herokuapp.com/images/spinner.gif" class="epages-categories-spinner"></div>
           <table class="epages-cart-overlay-line-table">
             <thead>
               <tr>
                 <th class="epages-cart-overlay-image"></th>
                 <th class="epages-cart-overlay-name" data-i18n="name">Name</th>
                 <th class="epages-cart-overlay-price" data-i18n="unit-price">Price</th>
                 <th class="epages-cart-overlay-quantity" data-i18n="quantity">Quantity</th>
                 <th class="epages-cart-overlay-total" data-i18n="total-price">Total price</th>
                 <th class="epages-cart-overlay-remove"></th>
               </tr>
             </thead>
             <tbody></tbody>
             <tfoot>
               <tr>
                 <td colspan="4" data-i18n="subtotal">Subtotal</td>
                 <td class="epages-cart-overlay-sub-price">0</td>
                 <td class="epages-cart-overlay-remove"></td>
               </tr>
               <tr>
                 <td colspan="4" data-i18n="shipping">Standard delivery</td>
                 <td class="epages-cart-overlay-delivery-price">0</td>
                 <td class="epages-cart-overlay-remove"></td>
               </tr>
               <tr>
                 <td colspan="4">
                   <div class="epages-cart-overlay-product-price-desc" data-i18n="total-price">Total price</div>
                   <div class="epages-cart-overlay-product-taxes">
                     <span data-i18n="include-vat-cart">includes VAT</span>
                   </div>
                 </td>
                 <td class="epages-cart-overlay-total-price">
                   <b>0</b>
                 </td>
                 <td class="epages-cart-overlay-remove"></td>
               </tr>
             </tfoot>
           </table>
           <button class="epages-cart-overlay-checkout-button" onclick="checkout()" method="post" data-i18n="checkout" target="_blank">Checkout</button>
           <div class="epages-cart-overlay-secure" data-i18n="ssl">Your data will be transmitted through an encrypted connection (SSL) and will not be disclosed to third parties.</div>
         </div>
         <div class="epages-cart-overlay-is-empty" style="display:none">
           <p data-i18n="basket-empty">Your basket is empty.</p>
         </div>
       </div>
     </div>
     </section>
     ';
     wp_enqueue_script("i18n-js", EPAGES_PLUGIN_URL . "/assets/js/i18n.js", array(), false, true);
     wp_enqueue_script("epages-fake-cart", EPAGES_PLUGIN_URL . "/assets/js/fake-cart.js", array(), false, true);
     wp_enqueue_style("epages-fake-cart-css", EPAGES_PLUGIN_URL . "/assets/css/fake-cart.css");
  }


	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
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

	}

} // class Cart_Widget

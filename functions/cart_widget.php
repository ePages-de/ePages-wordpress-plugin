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
     echo '<div class="epages-shop-cart" style="float:left;"><button class="epages-cart-button" id="cartShow"><i class="fa fa-shopping-cart"></i><span>0</span></button></div>';
		 echo "<script>
		 	cart = JSON.parse(localStorage.getItem('epages-shop-cart-products'));
			document.querySelector('.epages-shop-cart span').innerHTML = cart.length;
		</script>";
    echo '<div class="modal" id="cartModal">
            <div class="modal-content epages-cart-overlay">
              <span class="close">x</span>
              <h2 class="epages-cart-healine" data-i18n="basket">Basket</h2>
                <div class="epages-cart-overlay-not-empty">
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
                        <td colspan="4">Standard delivery</td>
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
          </div>';
  echo '<script>
          function createCartElement(element, index, array) {
            var tbody = document.getElementsByTagName("tbody");
            var tr = document.createElement("tr");
            // Create TD
            var imageD = document.createElement("td");
            var nameD = document.createElement("td");
            var priceD = document.createElement("td");
            var quantityD = document.createElement("td");
            var totalD = document.createElement("td");
            var removeD = document.createElement("td");

            // Create TD elements
            imageD.className = "epages-cart-overlay-image";
            var image = document.createElement("img");
            image.src = element.images[3].url;

            nameD.className = "epages-cart-overlay-name";
            nameD.innerText = element.name;

            priceD.className = "epages-cart-overlay-image";
            priceD.innerText = element.lineItemPrice;

            quantityD.className = "epages-cart-overlay-quantity";
            quantityD.innerText = "piece(s)"
            var quantity = document.createElement("input");
            quantity.value = element.quantity;
            quantity.className = "epages-cart-overlay-line-item-quantity";

            totalD.className = "epages-cart-overlay-total";
            total = parseFloat(element.lineItemPrice) * parseInt(element.quantity);
            totalD.innerText = total.toString() + " " + element.lineItemPrice.substr(element.lineItemPrice.length - 1);

            removeD.className = "epages-cart-overlay-remove";
            var remove = document.createElement("button");
            remove.className = "epages-cart-overlay-line-item-remove";
            remove.style = "background: transparent;"

            // Append to the DOM
            imageD.appendChild(image);
            tr.appendChild(imageD);
            tr.appendChild(nameD);
            tr.appendChild(priceD);
            quantityD.appendChild(quantity);
            tr.appendChild(quantityD);
            tr.appendChild(totalD);
            removeD.appendChild(remove);
            tr.appendChild(removeD);

            tbody[0].appendChild(tr);
          }
          cart.forEach(createCartElement);

          var subtotal = document.getElementsByClassName("epages-cart-overlay-sub-price");
          subtotal[0].innerText = localStorage.getItem("epages-shop-cart-subTotal").replace(/"/g, "");

          var delivery = document.getElementsByClassName("epages-cart-overlay-delivery-price");
          delivery[0].innerText = localStorage.getItem("epages-shop-cart-delivery").replace(/"/g, "");

          var total = document.getElementsByClassName("epages-cart-overlay-total-price");
          total[0].innerText = localStorage.getItem("epages-shop-cart-total").replace(/"/g, "");

          var link = document.getElementsByClassName("epages-cart-overlay-checkout-button");
          // link[0].href = "#checkout";

          function checkout() {
            var checkoutWindow, left, top;
            left = screen.width / 2 - 300;
            top = screen.height / 2 - 350;
            checkoutWindow = window.open("https://site-production.herokuapp.com/checkout.html", "newwindow", "width=600,height=620,scrollbars=yes,top=" + top + ",left=" + left);
            return checkoutWindow.location = localStorage.getItem("epages-shop-cart-checkoutUrl").replace(/"/g, "");
          }
        </script>';
        echo '<style>
        td > button:before {
          background: transparent !important;
          color: black;
          content: "\f1f8";
          font-family: FontAwesome !important;
          border: none;
          font-style: normal;
          font-weight: normal;
          text-decoration: inherit;
          font-size: 22px;
        }
        .epages-cart-overlay-line-item-quantity {
            margin-right: 5px;
            padding: 3px;
            margin: 0;
            max-width: 40px;
            border: 1px solid #999 !important;
            -webkit-border-radius: 4px !important;
            -moz-border-radius: 4px !important;
            border-radius: 4px !important;
            background: #fff;
            outline: none;
            display: inline-block;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            cursor: pointer;
        }
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
              </style>';
      echo '<script>
              var modal = document.getElementById("cartModal");

              var btn = document.getElementById("cartShow");

              var span = document.getElementsByClassName("close")[0];

              btn.onclick = function() {
                  modal.style.display = "block";
              }

              span.onclick = function() {
                  modal.style.display = "none";
              }

              window.onclick = function(event) {
                  if (event.target == modal) {
                      modal.style.display = "none";
                  }
              }
            </script>';
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

<?php

function epages_add_editor_button() {
  if (get_option("epages_api_url_confirmed")) {
    echo '<a href="#" id="epages-shop-button" class="button">Add Shop</a>';
  }
}

?>

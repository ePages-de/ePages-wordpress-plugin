<?php

function epages_shop_widget_shortcode_handler($attrs) {
  wp_enqueue_script("epages_shop_widget", $siteUrl, array(), null, true);
  return '<div class="epages-shop-widget"></div>';
}

add_shortcode("epages", "epages_shop_widget_shortcode_handler");

?>

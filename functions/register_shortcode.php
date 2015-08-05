<?php

function epages_shop_widget_shortcode_handler($attributes) {
  global $siteUrl;

	$attributes = shortcode_atts(
		array(
			'data_category_id' => null,
		)
		, $attributes
	);

  wp_enqueue_script("epages_shop_widget", $siteUrl, array(), null, true);

  $tag = '<div class="epages-shop-widget"';

  if ($attributes["data_category_id"]) {
    $tag .= ' data-category-id="' . $attributes["data_category_id"] . '"';
  }

  $tag .= '></div>';

  return $tag;
}

add_shortcode("epages", "epages_shop_widget_shortcode_handler");

?>

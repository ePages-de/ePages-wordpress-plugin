<?php

function epages_shop_widget_shortcode_handler($attributes) {
  global $siteUrl;

	$attributes = shortcode_atts(
		array(
			'data_product_details'   => null,
      'data_category_id'   => null,
      'data_search_form'   => true,
      'data_category_list' => false,
      'data_sort'          => true
		)
		, $attributes
	);

  wp_enqueue_script("epages_shop_widget", $siteUrl, array(), null, true);

  $tag = '<div class="epages-shop-widget"';

  // Product settings.
  $tag .= epages_add_shortcode_option($attributes, "data_category_id");
  $tag .= epages_add_shortcode_option($attributes, "data_product_details");

  // Appearance settings.
  $tag .= epages_add_shortcode_option($attributes, "data_search_form");
  $tag .= epages_add_shortcode_option($attributes, "data_category_list");
  $tag .= epages_add_shortcode_option($attributes, "data_sort");

  $tag .= '></div>';

  return $tag;
}

function epages_add_shortcode_option($attributes, $option) {
  if ($attributes[$option]) {
    $attribute_name = str_replace("_", "-", $option);
    return " " . $attribute_name . '="' . $attributes[$option] . '"';
  }

  return "";
}

add_shortcode("epages", "epages_shop_widget_shortcode_handler");

?>

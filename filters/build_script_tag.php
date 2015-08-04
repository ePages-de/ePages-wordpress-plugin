<?php

function epages_build_script_tag($tag, $handle) {
  if ("epages_shop_widget" !== $handle) {
    return $tag;
  }
  return str_replace(" src", ' async="async" data-shop-url="' . get_option("epages_api_url") .'" id="epages-widget" src', $tag);
}

?>

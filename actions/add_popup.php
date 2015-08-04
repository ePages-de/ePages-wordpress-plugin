<?php

function epages_add_popup() {
  global $epages_api_http_options;

  epages_load_template("popup", array(
    "epages_plugin_url"       => EPAGES_PLUGIN_URL,
    "epages_api_url"          => get_option("epages_api_url"),
    "epages_api_http_options" => $epages_api_http_options
  ));
}

?>

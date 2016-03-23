<?php

function epages_init() {
  register_setting("epages_options_page", "epages_api_url");
  register_setting("epages_options_page", "epages_mbo_url");
  register_setting("epages_options_page", "epages_api_url_confirmed");
}

?>

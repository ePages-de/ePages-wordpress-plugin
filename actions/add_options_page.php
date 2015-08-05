<?php

function epages_add_options_page() {
  add_menu_page("Online Shop Settings", "Online Shop", "manage_options", "epages_options_page", "epages_options_page");
}

?>

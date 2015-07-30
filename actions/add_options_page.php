<?php

function epages_add_options_page() {
  add_menu_page("ePages Shop Settings", "ePages Shop", "manage_options", "epages_options_page", "epages_options_page");
}

?>

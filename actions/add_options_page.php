<?php

function epages_add_options_page() {
  add_menu_page(__("Online Shop Settings"  , 'epages'), __("Online Shop"  , 'epages'), "manage_options", "epages_options_page", "epages_options_page");
}


?>

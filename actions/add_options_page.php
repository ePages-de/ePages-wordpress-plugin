<?php

function epages_add_options_page() {
  add_menu_page(__("Shop settings"  , 'epages-online-shop'), __("Online Shop"  , 'epages-online-shop'), "manage_options", "epages_options_page", "epages_options_page");
}


?>

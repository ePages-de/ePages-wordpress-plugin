<?php

function epages_add_editor_button() {
  if (get_option ("epages_api_url_confirmed")) {
    ?><a href="#" id="epages-shop-button" class="button" style="display:none;"><?php _e('Add Shop' , 'epages-online-shop'); ?></a><a href="#" id="epages-edit-button" class="button" style="display:none;"><?php _e('Edit shop' , 'epages-online-shop'); ?></a><?php
  }
}

?>

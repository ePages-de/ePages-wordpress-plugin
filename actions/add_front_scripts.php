<?php

function epages_add_front_scripts($hook) {
  wp_enqueue_style("epages-front-css", EPAGES_PLUGIN_URL . "/assets/css/front.css");
}

?>

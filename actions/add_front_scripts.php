<?php

function epages_add_front_scripts($hook) {
    wp_enqueue_style("epages-site-css", "http://site-production.herokuapp.com/style/site-base.css");
    wp_enqueue_style("epages-font-awesome-css", EPAGES_PLUGIN_URL . "/assets/css/font-awesome.min.css");
    wp_enqueue_style("epages-front-css", EPAGES_PLUGIN_URL . "/assets/css/front.css");
}

?>

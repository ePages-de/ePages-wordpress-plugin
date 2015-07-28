<?php

/*
Plugin Name: SITe
Plugin URI: http://www.epages.com/us/
Description: Example integration of the SITe widget for WordPress.
Version: 0.1
Author: mindmatters
Author URI: http://mindmatters.de/
*/

defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );


# TODO: add example shop url.
$sample_shop_id = "http://example.com";


if ( is_admin() ) {
  add_action("admin_notices", "epages_show_admin_message");
  add_action("admin_menu", "epages_add_options_page");
}








function epages_add_options_page() {
	add_menu_page("ePages Shop Settings", "ePages Shop", "manage_options", "epages_options_page", "epages_options_page");
}

function epages_options_page() {
  ?>
    <div class="wrap">
      <h2>ePages Shop Settings</h2>
    </div>
  <?php
}






// Actions

function epages_show_admin_message() {
  if ( epages_shop_id() == $sample_shop_id ) {
    ?>
    <div class="updated fade">
      <p>
        <strong>Your ePages shop is almost ready to use</strong>. Please visit
        the <a href="options-general.php?page=epages_options_page"><strong>ePages
        settings</strong></a> to to set up the plugin.
      </p>
    </div>
    <?php
  }
}


// Helper

function epages_shop_id() {
  static $shop_id = null;
  if (is_null($shop_id)) {
    $shop_id = get_option("epages_shop_id");

    if (empty($shop_id)) {
      $shop_id = $sample_shop_id;
    }
  }
  return $shop_id;
} 




//function epages_shop_widget_shortcode_handler($atts) {
  //// Add SITe.js script
    //wp_enqueue_script("epages_shop_widget", "http://localhost:4566/site.js", array(), null, true);

    //// Cleanup shortcode parameters
    //$a = shortcode_atts(array(
        //"shopid" => ""
    //), $atts);

    //$shop_id = sanitize_html_class($a["shopid"]);

    //return "<div class='epages-shop-widget' data-shopid='{$shop_id}'></div>";
//}

//// Usage: [epages_shop_widget shopid="DemoShop"]
//add_shortcode("epages_shop_widget", "epages_shop_widget_shortcode_handler");

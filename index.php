<?php

/*
Plugin Name: SITe
Plugin URI: http://www.epages.com/us/
Description: Example integration of the SITe widget for WordPress.
Version: 0.1
Author: mindmatters
Author URI: http://mindmatters.de/
*/

defined("ABSPATH") or die("Plugin file cannot be accessed directly.");


if (!defined('EPAGES_PLUGIN_NAME'))
  define('EPAGES_PLUGIN_NAME', trim(dirname(plugin_basename(__FILE__)), '/'));

if (!defined('EPAGES_PLUGIN_DIR'))
  define('EPAGES_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . EPAGES_PLUGIN_NAME);

if (!defined('EPAGES_PLUGIN_URL'))
  define('EPAGES_PLUGIN_URL', WP_PLUGIN_URL . '/' . EPAGES_PLUGIN_NAME);


static $epages_api_http_options = array(
  "headers" => array(
    "Authorization" => "Bearer M0mPgTiGPtw5LkdCGwhel3gcGc5PqIPF",
    "Accept"        => "application/vnd.epages.v1+json"
  ),
);


require_once EPAGES_PLUGIN_DIR . "/functions/log.php";
require_once EPAGES_PLUGIN_DIR . "/functions/load_template.php";
require_once EPAGES_PLUGIN_DIR . "/functions/options_page.php";


if (is_admin()) {
  add_action("admin_init",    "epages_settings_api_init");
  add_action("admin_notices", "epages_show_admin_message");
  add_action("admin_menu",    "epages_add_options_page");

}

function epages_settings_api_init() {
  register_setting("epages_options_page", "epages_api_url");
  register_setting("epages_options_page", "epages_api_url_confirmed");
}

function epages_add_options_page() {
  add_menu_page("ePages Shop Settings", "ePages Shop", "manage_options", "epages_options_page", "epages_options_page");
}






// Actions

function epages_show_admin_message() {
  if (!get_option("epages_api_url_confirmed")) {
    ?>
    <div class="updated fade">
      <p>
        <strong>Your ePages shop is almost ready to use</strong>. Please visit
        the <a href="admin.php?page=epages_options_page"><strong>ePages
        settings</strong></a> to to set up the plugin.
      </p>
    </div>
    <?php
  }
}


// Helper

//function epages_shop_widget_shortcode_handler($atts) {
  //// Add SITe.js script
    //wp_enqueue_script("epages_shop_widget", "http://localhost:4566/site.js", array(), null, true);

    //// Cleanup shortcode parameters
    //$a = shortcode_atts(array(
        //"shopid" => ""
    //), $atts);

    //$shop_id = sanitize_html_class($a["shopid"]);

    //return "<div class="epages-shop-widget" data-shopid="{$shop_id}"></div>";
//}

//// Usage: [epages_shop_widget shopid="DemoShop"]
//add_shortcode("epages_shop_widget", "epages_shop_widget_shortcode_handler");

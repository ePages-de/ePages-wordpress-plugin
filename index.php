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


// FUNCTIONS
require_once EPAGES_PLUGIN_DIR . "/functions/log.php";
require_once EPAGES_PLUGIN_DIR . "/functions/load_template.php";
require_once EPAGES_PLUGIN_DIR . "/functions/options_page.php";

// ACTIONS
require_once EPAGES_PLUGIN_DIR . "/actions/init.php";
require_once EPAGES_PLUGIN_DIR . "/actions/add_options_page.php";
require_once EPAGES_PLUGIN_DIR . "/actions/show_admin_message.php";
require_once EPAGES_PLUGIN_DIR . "/actions/add_editor_button.php";


if (is_admin()) {
  add_action("admin_init",    "epages_init");
  add_action("admin_notices", "epages_show_admin_message");
  add_action("admin_menu",    "epages_add_options_page");
  add_action("media_buttons", "epages_add_editor_button" );
  
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

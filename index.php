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


// Load functions
require_once EPAGES_PLUGIN_DIR . "/functions/log.php";
require_once EPAGES_PLUGIN_DIR . "/functions/load_template.php";
require_once EPAGES_PLUGIN_DIR . "/functions/options_page.php";

// Load actions
require_once EPAGES_PLUGIN_DIR . "/actions/init.php";
require_once EPAGES_PLUGIN_DIR . "/actions/add_options_page.php";
require_once EPAGES_PLUGIN_DIR . "/actions/show_admin_message.php";
require_once EPAGES_PLUGIN_DIR . "/actions/add_editor_button.php";
require_once EPAGES_PLUGIN_DIR . "/actions/add_scripts.php";
require_once EPAGES_PLUGIN_DIR . "/actions/add_popup.php";

// Load filters
require_once EPAGES_PLUGIN_DIR . "/filters/add_mce_plugin.php";
require_once EPAGES_PLUGIN_DIR . "/filters/build_script_tag.php";


if (is_admin()) {
  add_action("admin_init",    "epages_init");
  add_action("admin_notices", "epages_show_admin_message");
  add_action("admin_menu",    "epages_add_options_page");
  add_action("media_buttons", "epages_add_editor_button" );

  # TODO: only load this on the editor page.
  add_filter("mce_external_plugins",  "epages_add_mce_plugin");
  add_action("admin_enqueue_scripts", "epages_add_scripts");
  add_action("in_admin_header",       "epages_add_popup");
} else {
  add_filter("script_loader_tag", "epages_build_script_tag", 10, 2);
}

function epages_shop_widget_shortcode_handler($attrs) {
    wp_enqueue_script("epages_shop_widget", "https://site-production.herokuapp.com/site.js", array(), null, true);
    return '<div class="epages-shop-widget"></div>';
}

add_shortcode("epages", "epages_shop_widget_shortcode_handler");

<?php

/*
Plugin Name: ePages Online Shop
Plugin URI: http://www.epages.com/us/
Description: ePages Online Shop integration for WordPress.
Version: 5.0.18
Author: ePages GmbH
Author URI: http://www.epages.com/
Text Domain: epages-online-shop
Domain Path: /languages
*/


defined("ABSPATH") or die(__("Plugin file cannot be accessed directly."));


if (!defined('EPAGES_PLUGIN_NAME'))
  define('EPAGES_PLUGIN_NAME', trim(dirname(plugin_basename(__FILE__)), '/'));


if (!defined('EPAGES_PLUGIN_DIR'))
  define('EPAGES_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . EPAGES_PLUGIN_NAME);

if (!defined('EPAGES_PLUGIN_URL'))
  define('EPAGES_PLUGIN_URL', WP_PLUGIN_URL . '/' . EPAGES_PLUGIN_NAME);


static $siteUrl = "https://site-production.herokuapp.com/site.js";


// TODO: add auth to headers if access to non-public api calls
// "Authorization" => "Bearer M0mPgTiGPtw5LkdCGwhel3gcGc5PqIPF",
static $epages_api_http_options = array(
  "headers" => array(
    "Accept"        => "application/vnd.epages.v1+json"
  ),
  "user-agent" => "epages-WP",
  "timeout" => "20"
);


// Load functions
require_once EPAGES_PLUGIN_DIR . "/functions/log.php";
require_once EPAGES_PLUGIN_DIR . "/functions/load_template.php";
require_once EPAGES_PLUGIN_DIR . "/functions/options_page.php";
require_once EPAGES_PLUGIN_DIR . "/functions/register_shortcode.php";
require_once EPAGES_PLUGIN_DIR . "/functions/cart_widget.php";


// Load actions
require_once EPAGES_PLUGIN_DIR . "/actions/init.php";
require_once EPAGES_PLUGIN_DIR . "/actions/add_options_page.php";
require_once EPAGES_PLUGIN_DIR . "/actions/show_admin_message.php";
require_once EPAGES_PLUGIN_DIR . "/actions/add_editor_button.php";
require_once EPAGES_PLUGIN_DIR . "/actions/add_admin_scripts.php";
require_once EPAGES_PLUGIN_DIR . "/actions/add_front_scripts.php";
require_once EPAGES_PLUGIN_DIR . "/actions/add_popup.php";

// Load filters
require_once EPAGES_PLUGIN_DIR . "/filters/add_mce_plugin.php";
require_once EPAGES_PLUGIN_DIR . "/filters/build_script_tag.php";


add_action( 'plugins_loaded', 'epages_load_textdomain' );

function epages_load_textdomain() {
	load_plugin_textdomain( 'epages-online-shop', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

if (is_admin()) {
  add_action("admin_init",    "epages_init");
  add_action("admin_notices", "epages_show_admin_message");
  add_action("admin_menu",    "epages_add_options_page");
  add_action("media_buttons", "epages_add_editor_button" );

  # TODO: only register these on the editor page.
  add_filter("mce_external_plugins",  "epages_add_mce_plugin");
  add_action("admin_enqueue_scripts", "epages_add_admin_scripts");
  add_action("in_admin_header",       "epages_add_popup");
} else {
  add_filter("script_loader_tag", "epages_build_script_tag", 10, 2);
  add_action("wp_enqueue_scripts", "epages_add_front_scripts" );
}

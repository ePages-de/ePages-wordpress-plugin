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


$epages_example_shop_url = "https://creamyiceshop.com/rs/shops/CreamyIceShop";


if ( is_admin() ) {
  add_action('admin_init', 'epages_settings_api_init');
  add_action("admin_notices", "epages_show_admin_message");
  add_action("admin_menu", "epages_add_options_page");

}

function epages_settings_api_init() {
  register_setting('epages_options_page', 'epages_api_url');
  register_setting('epages_options_page', 'epages_api_url_confirmed');
}

function epages_add_options_page() {
  add_menu_page("ePages Shop Settings", "ePages Shop", "manage_options", "epages_options_page", "epages_options_page");
}

function epages_options_page() {

  $confirmation_failed = False;

  if ( !get_option("epages_api_url_confirmed") && !empty( get_option("epages_api_url") ) ) {
    $args = array(
      'headers' => array(
        'Authorization' => 'Bearer M0mPgTiGPtw5LkdCGwhel3gcGc5PqIPF',
        'Accept'        => 'application/vnd.epages.v1+json'
      ),
    );

    $url = trim(get_option("epages_api_url"), '/') . '/legal';
    $resp = wp_remote_get( $url, $args );
    $success = False;

    if ( is_array( $resp ) ) {
      if ( 200 == $resp['response']['code'] ) {
        try {
          $json = json_decode( $resp['body'] );
          if ( is_array( $json->links ) ) {
            $success = True;
          }
        } catch ( Exception $ex ) {
          $json = null;
        }
      }
    }

    $confirmation_failed = !$success;
    update_option( "epages_api_url_confirmed", $success );

  }

  ?>
    <style type="text/css">
      .epages-shop-form-failure { background: #c00; color: #fff; padding: 4px 8px 3px; margin-left: 10px; }
      .epages-shop-form-success { background: #0c0; color: #fff; padding: 4px 8px 3px; margin-left: 10px; }
    </style>

    <div class="wrap">
      <h2>Connect your ePages Shop</h2>
    </div>
    <p>
      <a href="https://www.epages.co.uk/" target="_blank">
        Create your ePages Shop
      </a>
      and then enter your ePages API URL here:
    </p>
    <form method="post" action="options.php">
      <?php settings_fields('epages_options_page'); ?>
      <label for="epages_api_url">Your ePages API URL</label>
      <br/>
      <input
        type="text"
        name="epages_api_url"
        size=60
        value="<?php echo get_option("epages_api_url") ?>">

      <?php if ( $confirmation_failed ) { ?>
        <span class="epages-shop-form-failure">Invalid shop URL</span>
      <?php } else { ?>
        <span class="epages-shop-form-success">Confirmed</span>
      <?php } ?>

      <br/>
      <input type="submit" value="Save">
    </form>

    <?php if ( get_option("epages_api_url_confirmed") ) { ?>
      <div class="wrap">
        <h2>Disconnect your ePages Shop</h2>
      </div>
      <p>Disable the ePages Shop Widget in your Wordpress installation:</p>
      <form method="post" action="options.php">
        <?php settings_fields('epages_options_page'); ?>
        <input type="hidden" name="epages_api_url_confirmed" value="0">
        <input type="submit" value="Disconnect ePages Shop">
      </form>
    <?php
    }
}






// Actions

function epages_show_admin_message() {
  if ( !epages_shop_connected() ) {
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

function epages_api_url() {
  static $epages_api_url = null;
  if (is_null($epages_api_url)) {
    $epages_api_url = get_option("epages_api_url");

    if (empty($epages_api_url)) {
      $epages_api_url = $epages_example_shop_url;
    }
  }
  return $epages_api_url;
}

function epages_shop_connected() {
  return epages_api_url() != $epages_example_shop_url;
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

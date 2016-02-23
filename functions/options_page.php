<?php

function epages_options_page() {
  global $epages_api_http_options;

  $valid_shop_id = false;
  $shop_id_validated = false;

  if (!get_option("epages_api_url_confirmed") && (get_option("epages_api_url"))) {
    $shop_id_validated = true;

    // We’re hitting the legal-API to verify whether the provided
    // Shop ID is actually pointing to the ePages API.
    $url = esc_html(get_option("epages_api_url"));
    $url = trim($url, "/") . "/legal";

    epages_log( __("Trying to validate shop URL: "  , 'epages') . $url);

    $response = wp_remote_get($url, $epages_api_http_options);
    epages_log($response);

    $valid_shop_id = epages_is_valid_api_response($response);

    epages_log( __("Shop URL validation status: ") . ($valid_shop_id ? __("Success"  , 'epages') : __("Failure"  , 'epages')));
    update_option("epages_api_url_confirmed", $valid_shop_id);
  }

  epages_load_template("options_page", array(
    "valid_shop_id"     => $valid_shop_id,
    "shop_id_validated" => $shop_id_validated
  ));
}

// If `$response` is not an error object and the request was successful,
// we’re checking for a specific element in the response and expect it
// to be an ePages API response, if the element was found.
function epages_is_valid_api_response($response) {
  if (is_array($response) && 200 == $response["response"]["code"]) {
    try {
      $json = json_decode($response["body"]);
      if (is_array($json->links)) {
        return true;
      }
    } catch (Exception $ex) {
      epages_log( __("Exception while parsing the shop URL validation response."  , 'epages') );
    }
  }

  return false;
}


?>

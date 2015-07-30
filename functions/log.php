<?php

function epages_log($message) {
  if (WP_DEBUG === true) {
    if (is_array($message) || is_object($message)) {
      error_log("[EPAGES] " . print_r($message, true));
    } else {
      error_log("[EPAGES] " . $message);
    }
  }
}

?>

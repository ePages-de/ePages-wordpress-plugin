<?php

function epages_add_mce_plugin($args) {
  $args["epages"] = EPAGES_PLUGIN_URL . "/assets/js/mce-editor.js";
  return $args;
}

?>

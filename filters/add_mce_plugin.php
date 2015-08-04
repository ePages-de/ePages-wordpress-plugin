<?php

function epages_add_mce_plugin($args) {
  $args["epages"] = EPAGES_PLUGIN_URL . "/js/mce-editor.js";
  return $args;
}

?>

<?php

function epages_load_template($template_name, $vars) {
  $template = EPAGES_PLUGIN_DIR . '/templates/' . $template_name . '.php';

  extract($vars);
  require $template;
}

?>

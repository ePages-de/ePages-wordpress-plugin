<?php

function epages_add_admin_scripts($hook) {
  if ($hook == "post-new.php" || $hook == "post.php") {
    wp_enqueue_script("epages-editor", EPAGES_PLUGIN_URL . "/assets/js/editor.js", array(), false, true);
    add_editor_style(EPAGES_PLUGIN_URL . "/assets/css/mce-editor.css");
  }

  wp_enqueue_style("epages-font-awesome-css", EPAGES_PLUGIN_URL . "/assets/css/font-awesome.min.css");
  wp_enqueue_style("epages-editor-css", EPAGES_PLUGIN_URL . "/assets/css/editor.css");
}

?>

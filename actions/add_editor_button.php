<?php

function epages_add_editor_button() {
  echo <<<HTML
<style type="text/css">
  #insert-epages-button { float: right; }
</style>

<a href="#" id="insert-epages-button" class="button" title="$title">
  Add ePages store
</a>
HTML;
}

?>

<?php

function epages_show_admin_message() {
  if (!get_option("epages_api_url_confirmed")) {

?>
    <div class="updated fade">
      <p>
        <strong>Your ePages shop is almost ready to use</strong>. Please visit
        the <a href="admin.php?page=epages_options_page"><strong>ePages
        settings</strong></a> to to set up the plugin.
      </p>
    </div>
<?php

  }
}

?>

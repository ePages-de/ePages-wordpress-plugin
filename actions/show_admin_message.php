<?php function epages_show_admin_message(){
  if (!get_option("epages_api_url_confirmed") && $_GET["page"]!= "epages_options_page") { ?>
    <div class="updated fade">
      <p><strong><?php _e('Your ePages shop is almost ready to use'); ?> </strong>.
        <?php _e('Please visit the ','epages'); ?> <a href="admin.php?page=epages_options_page"><strong>
        <?php _e('ePages settings' , 'epages'); ?> </strong></a>
        <?php _e('to to set up the plugin.' , 'epages'); ?>
      </p>
    </div>
<?php }} ?>

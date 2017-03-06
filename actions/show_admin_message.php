<?php function epages_show_admin_message(){
  if (!get_option("epages_api_url_confirmed") && $_GET["page"]!= "epages_options_page") { ?>
    <div class="updated fade">
      <p><strong><?php _e('Your ePages shop is almost ready to use'); ?> </strong>.
        <?php _e('Set up the plugin in the ','epages-online-shop'); ?> <a href="admin.php?page=epages_options_page"><strong>
        <?php _e('<strong>Online Shop</strong>' , 'epages-online-shop'); ?> </strong></a>
        <?php _e('area.' , 'epages-online-shop'); ?>
      </p>
    </div>
<?php }} ?>

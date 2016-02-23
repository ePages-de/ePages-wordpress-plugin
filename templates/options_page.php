<div class="wrap">
  <h2><?php _e('Connect your Online Shop with the Plugin'  , 'epages'); ?></h2>

<?php if (get_option("epages_api_url_confirmed"  , 'epages')) { ?>
  <div class="wrap">
    <div class="epages-verified-shop-text"><i class="fa fa-check-circle fa-4x"></i><span><b>
      <?php _e('Congratulations! Your Online Shop is now connected with your Website!' , 'epages'); ?></b></span></div>
  </div>
  <br>
  <p><?php _e('Now you can add your Online Shop to any Wordpress page or post. Just click the Add Online Shop button.'  , 'epages'); ?></p>
  <p><?php _e('After that click Edit to edit product and appearance settings for Online Shop for this page or post.'  , 'epages'); ?></p>
  <p><?php _e('Have a question? Visit our <a href="https://www.online-help-center.com/customer/en/portal/articles?utm_source=ePages&utm_medium=Menu%20Entry&utm_campaign=website">help center'  , 'epages'); ?></a></p>
  <p><?php _e('Your API URL is: ' , 'epages'); ?><b><?php echo get_option("epages_api_url" , 'epages') ?></b></p>

  <form method="post" action="options.php">
    <?php settings_fields("epages_options_page"); ?>
    <input type="hidden" name="epages_api_url" value="">
    <input type="hidden" name="epages_api_url_confirmed" value="0">
    <?php submit_button( __('Disconnect Online Shop' , 'epages')) ?>
  </form>
<?php } else { ?>
  <p><b><?php _e('There are just a few steps left to start selling on your Wordpress site' , 'epages'); ?></b></p>
  <ol>
    <li>
      <b><a href="https://www.epages.co.uk/" target="_blank"><?php _e('Create your free Online Shop' , 'epages'); ?></a></b>
      <?php _e('If you already have an ePages Online Shop, move on to the next step.' , 'epages'); ?>
    </li>
    <li><?php _e('Enter your API url here. ','epages'); ?><a href="https://www.online-help-center.com/customer/en/portal/articles?utm_source=ePages&utm_medium=Menu%20Entry&utm_campaign=website"><?php _e('Learn more' , 'epages'); ?></a> <?php _e('how to attain the URL' , 'epages'); ?></li>
  </ol>

  <form method="post" action="options.php">
    <?php settings_fields("epages_options_page"); ?>
    <input type="text" name="epages_api_url" size=60
      value="<?php echo get_option("epages_api_url") ?>">

    <?php if ($shop_id_validated && !$valid_shop_id) { ?>
      <span class="epages-shop-form-failure"><?php _e('Invalid shop URL' , 'epages'); ?></span>
    <?php } submit_button( __('Save' , 'epages')) ?>
  </form>
</div>
<?php } ?>

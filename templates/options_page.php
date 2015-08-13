<div class="wrap">
  <h2>Connect your Online Shop with the Plugin</h2>

<?php if (get_option("epages_api_url_confirmed")) { ?>
  <div class="wrap">
    <div class="epages-verified-shop-text"><i class="fa fa-check-circle fa-4x"></i><span><b>Congratulations! Your Online Shop is now connected with you</b></span></div>
  </div>
  <br>
  <p>Now you can add your Online Shop to any Wordpress page or post. Just click the 'Add Online Shop' button.</p>
  <p>After that click 'Edit' to edit product and appearance settings for Online Shop for this page or post.</p>
  <p>Have a question? Visit our <a href="https://www.online-help-center.com/customer/en/portal/articles?utm_source=ePages&utm_medium=Menu%20Entry&utm_campaign=website">help center</a></p>
  <p>Your API URL is: <b><?php echo get_option("epages_api_url") ?></b></p>

  <form method="post" action="options.php">
    <?php settings_fields("epages_options_page"); ?>
    <input type="hidden" name="epages_api_url" value="">
    <input type="hidden" name="epages_api_url_confirmed" value="0">
    <?php submit_button('Disconnect Online Shop') ?>
  </form>
<?php } else { ?>
  <p><b>There are just a few steps left to start selling on your Wordpress site</b></p>
  <ol>
    <li>
      <b><a href="https://www.epages.co.uk/" target="_blank">Create your free Online Shop</a></b>
      If you already have an ePages Online Shop, move on to the next step.
    </li>
    <li>Enter your API url here. <a href="https://www.online-help-center.com/customer/en/portal/articles?utm_source=ePages&utm_medium=Menu%20Entry&utm_campaign=website">Learn more</a> how to attain the URL</li>
  </ol>

  <form method="post" action="options.php">
    <?php settings_fields("epages_options_page"); ?>
    <input type="text" name="epages_api_url" size=60
      value="<?php echo get_option("epages_api_url") ?>">

    <?php if ($shop_id_validated && !$valid_shop_id) { ?>
      <span class="epages-shop-form-failure">Invalid shop URL</span>
    <?php } submit_button('Save') ?>
  </form>
</div>
<?php } ?>

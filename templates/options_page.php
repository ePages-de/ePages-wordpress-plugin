<div class="wrap">
  <h2>Connect your ePages Shop</h2>
</div>

<p>
  <a href="https://www.epages.co.uk/" target="_blank">Create your ePages Shop</a>
  and then enter your ePages API URL here:
</p>

<form method="post" action="options.php">
  <?php settings_fields("epages_options_page"); ?>

  <label for="epages_api_url">Your ePages API URL</label>
  <br/>
  <input
    type="text"
    name="epages_api_url"
    size=60
    value="<?php echo get_option("epages_api_url") ?>">

  <?php if ($shop_id_validated) { ?>
    <?php if ($valid_shop_id) { ?>
      <span class="epages-shop-form-success">Confirmed</span>
    <?php } else { ?>
      <span class="epages-shop-form-failure">Invalid shop URL</span>
    <?php } ?>
  <?php } ?>

  <br/>
  <input type="submit" value="Save">
</form>

<?php if (get_option("epages_api_url_confirmed")) { ?>
  <div class="wrap">
    <h2>Disconnect your ePages Shop</h2>
  </div>
  <p>Disable the ePages Shop Widget in your Wordpress installation:</p>
  <form method="post" action="options.php">
    <?php settings_fields("epages_options_page"); ?>
    <input type="hidden" name="epages_api_url" value="">
    <input type="hidden" name="epages_api_url_confirmed" value="0">
    <input type="submit" value="Disconnect ePages Shop">
  </form>
<?php } ?>

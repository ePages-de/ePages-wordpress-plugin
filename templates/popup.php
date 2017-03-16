<script type="text/javascript">
  window.ePagesPluginBaseUrl = '<?php echo $epages_plugin_url; ?>';
  window.ePagesShopUrl = '<?php echo $epages_api_url; ?>';

  window.ePagesHttpHeaders = {
    Authorization: '<?php echo $epages_api_http_options["headers"]["Authorization"]; ?>',
    Accept: '<?php echo $epages_api_http_options["headers"]["Accept"]; ?>'
  };
</script>

<div id="epages-popup-content">
  <div class="media-modal wp-core-ui">
    <div class="media-modal-content">
      <a class="media-modal-close" href="#" title="Close"><span class="media-modal-icon"></span></a>
      <div class="media-frame wp-core-ui hide-router">
        <div class="media-frame-menu">
          <div class="media-menu">
            <a href="#" class="media-menu-item" data-content="product-settings"><?php _e('Product settings' ,'epages-online-shop'); ?> </a>
            <a href="#" class="media-menu-item" data-content="appearance"><?php _e('Appearance settings','epages-online-shop'); ?></a>
          </div>
        </div>

        <div class="media-frame-title product-settings">
          <h1><?php _e('Product settings','epages-online-shop'); ?><span class="dashicons dashicons-arrow-down"></span></h1>
        </div>

        <div class="media-frame-title appearance">
          <h1><?php _e('Appearance settings','epages-online-shop'); ?><span class="dashicons dashicons-arrow-down"></span></h1>
        </div>

        <div class="media-frame-content product-settings">
          <h2><?php _e('Choose the products you want to show on the website','epages-online-shop'); ?></h2>

          <label>
            <input type="radio" name="product-settings" value="all-products" checked="checked" class="epages-all-products-radio-button">
            <?php _e('All products','epages-online-shop'); ?>
          </label>

          <label>
            <input type="radio" name="product-settings" value="categories" class="epages-categories-radio-button">
            <?php _e('All products from selected category','epages-online-shop'); ?>
            <img src="<?php echo $epages_plugin_url . "/assets/images/spinner.gif"; ?>" class="epages-categories-spinner">
          </label>

          <ol class="epages-categories-container"></ol>

          <label style="width:100%">
            <input type="radio" name="product-settings" value="products" class="epages-products-radio-button">
            <?php _e('Only the selected product','epages-online-shop'); ?>
            <img src="<?php echo $epages_plugin_url . "/assets/images/spinner.gif"; ?>" class="epages-products-spinner hidden">
            <input type="text" name="product-settings" style="width:50%" value="" placeholder="<?php _e('Find any product from your shop','epages-online-shop'); ?>" class="epages-products-input">
            <button type="button" name="product-settings" class="epages-products-button button button-primary button-large"><?php _e('Find','epages-online-shop'); ?></button>
          </label>

          <ol class="epages-products-container"></ol>
        </div>

        <div class="media-frame-content appearance">
          <h2><?php _e('Choose the appearance settings for the product list view' ,'epages-online-shop'); ?></h2>

          <label>
            <input type="checkbox" value="search-form" checked="checked" class="epages-option-search-form">
            <?php _e('Search field','epages-online-shop'); ?>
            <span class="tooltip" <?php _e('data-tooltip="Mark this checkbox, if you want to display a search field in the product list view.">' ,'epages-online-shop'); ?><i class="fa fa-lg fa-info-circle"></i></span>
          </label>

          <label>
            <input type="checkbox" value="category-list" class="epages-option-category-list">
            <?php _e('Category selection' ,'epages-online-shop'); ?>
            <span class="tooltip" <?php _e('data-tooltip="Mark this checkbox, if you want to display a category selection dropdown menu in the product list view.">' ,'epages-online-shop'); ?><i class="fa fa-lg fa-info-circle"></i></span>
          </label>

          <label>
            <input type="checkbox" value="sort" checked="checked" class="epages-option-sort">
            <?php _e('Product sorting' ,'epages-online-shop'); ?>
            <span class="tooltip" <?php _e('data-tooltip="Mark this checkbox, if you want to display a product sorting option in your product list view.">' ,'epages-online-shop'); ?><i class="fa fa-lg fa-info-circle"></i></span>
          </label>
          <div>
            <p><?php _e('Additionally, you can add a basket widget to your website using'  , 'epages-online-shop'); ?> <a target="_blank" href="widgets.php"><?php _e('WordPress native widgets'  , 'epages-online-shop'); ?></a>     </p>
          </div>
        </div>
        <div class="media-frame-toolbar">
          <div class="media-toolbar">
            <div class="media-toolbar-secondary">
              <div class="store-url"><?php echo get_option("epages_api_url"); ?></div>
              <div class="settings-link">
                <a target="_blank" href="admin.php?page=epages_options_page"><?php _e('Plugin settings' ,'epages-online-shop'); ?></a>
              </div>
            </div>

            <div class="media-toolbar-primary add-store">
              <a href="#" id="epages-save-button" class="button media-button button-primary button-large media-button-select"><?php _e('Save' ,'epages-online-shop'); ?></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="media-modal-backdrop"></div>
</div>

=== ePages Online Shop ===
Contributors: epages
Donate link: http://www.epages.com/en/
Tags: cart, checkout, e-commerce, ecommerce, paypal, sales, sell, shop, store, storefront, digital goods, downloadable products, e-commerce, e-commerce, online shop, online store, product catalog, products, shopping, shopping cart, wordpress ecommerce, wp e-commerce
Requires at least: 3.0.1
Tested up to: 5.0.18
Stable tag: 5.0.18
License: MIT
License URI: https://opensource.org/licenses/MIT

Selling made easy: Turn your WordPress site into an online shop with the ePages plugin.

== Description ==

**Selling online with ePages**
More than 140,000 companies are already taking advantage of the all-in-one shop solution offered by ePages. If you are running a WordPress site or blog you can now also benefit from this powerful e-commerce plugin and sell your products online with ease.

**Advantages of the ePages Online Shop Plugin**

* **Easy integration**: With just a few clicks, e-commerce functionality is added seamlessly to your WordPress site.
*	**Feature rich, low cost**: No need to pay for expensive add-ons. The plugin offers a strong core feature set with access to Amazon, eBay, PayPal, Amazon Payments and many more.
* **Proven back office**: Rest assured that your shop administration area is fully optimised. Manage products and orders, payments, shipping and taxes with ease.
* **High compatibility**: ePages Online Shop plugin works brilliantly on any WordPress site and is compatible with most frameworks and themes. Have you built your own theme? Find out more about integrating the plugin at [GitHub](https://github.com/ePages-de/ePages-wordpress-plugin "GitHub")
* **Selling successfully**: The plugin equips you to easily meet all legal requirements and delivers a secure check out process.
* **Free and automatic updates**: With the ePages cloud solution, you can relax knowing that you will receive all security and version updates as well as backups automatically and for free.

**Powerful features of your ePages shop**

* Sell up to 1000 products
* Also create product variations and downloadable products
* Showcase your products with a slideshow
* Let your customers choose in-between various payment options (e.g. PayPal Express)
* Offer a SSL-secured checkout
* Sell on eBay and Amazon
* Let your customers pick their preferred shipment method
* Easy management with import or export of data
* Print invoices, packing slips and credit notes
* Customize your shop further with the App & Theme Store
* Soon available: Sage One integration and coupons

**How to get started**

Explore how your website could look like with the [ePages Online Shop Plugin](http://wordpress.epages.com/more-products/ "Demo").

ePages shops are offered by many providers worldwide. Simply select a package from one of [our partners](http://www.epages.com/en/partner/provider/ "Resellers") that best meets your needs, install the free ePages online shop plugin for WordPress and hit the ground running in e-commerce.

Please note: The availability of features may depend upon on the specific plan you have choosen from your provider.

== Installation ==

**Automatic installation** (the easy way)

Please refer to this [article](http://www.epages.com/downloads/pdf/epages-wordpress-plugin-setup-EN.pdf "Setup guide") for detailed guidance and screenshots.

Setting up your online shop

1. Visit one of [our partners](http://www.epages.com/en/partner/provider/ "Partners"), select a shop package that suits your needs and register your shop.
2. Set up your shop. Find further support in our [help center](https://www.online-help-center.com/ "Help center").
While setting up your shop you should especially take care of these steps:
  * Run the setup assistant
  * Start with adding your products
  * Set up one or more delivery methods
  * Set up one or more payment methods
  * Add legal texts (e.g. terms and conditions). You also have to add these texts to your WordPress website.

Installing the WordPress plugin

1. In the administration area of your WordPress website, select *Plugins* and then *Add new*.
2. Enter 'ePages e-commerce' into the search field in the upper right corner.
3. Select *Install now* for the ePages Online Shop plugin.
4. Select *Activate this plugin*.
5. In your shop’s administration area, select *Help* in the main menu.
6. At the bottom of the page, your API URL is displayed. Copy the API URL.
7. In the administration area of your WordPress website, select Online Shop.
8. Paste the complete API URL into the field which is shown below step 2.
9. Save the changes.
Your shop and your WordPress website are now connected. Your WordPress site isset to display products from your shop on pages or in blog posts.

Adding products to pages of your WordPress website

1. In the administration area of your WordPress website, open the page or post you want to add products to.
2. Place the cursor where you want to display the products.
3. Select the button *Add shop*.
4. Here you can determine if you want to display all of your products or only products of a certain category. If you choose the latter, you can then define which category you want to display.
5. Select *Appearance*.
6. Here you can define if the following elements should be shown:
  * A search field with which visitors can search for products
  * A selected category
  * The possibility to sort products by their name or price (ascending or descending)
7. Save the changes.
8. If you already published this page or post before, select *Update*. If not, select *Publish*.
The products are now displayed on that page or post and can be ordered by your visitors.
If you want to edit the settings for this page or post later on, open the page or post in the administration area of your WordPress site and select *Edit* for the shop element.

**Uploading the plugin zip archive in WordPress admin backend**

* Download the *ePages Online Shop* plugin from the [GitHub repository](https://github.com/ePages-de/ePages-wordpress-plugin "Download")
* In your WordPress admin backend, navigate to *Plugins* → *Add New*
* Click *Upload Plugin* and choose the saved zip file (from step 1) in the appeared dialog window
* Click Install

**Installation for developers**

The ePages WordPress plugin enables you to integrate [SITe](https://github.com/ePages-de/site) into your Wordpress blog / page.

* Setup

    ```bash

    docker-compose up

    docker-compose run db mysql -h sitewordpress_db_1 -pexample wordpress < db.sql

    ```
* Now visit [http://localhost:8080/](http://localhost:8080/)
* You can login as the user "admin" with password "admin".

== Frequently Asked Questions ==

**How does the plugin work on my WordPress site?**
As soon as the plugin is installed, products will be showcased on selected pages or posts. If a customer clicks on one of the product, an overlay window opens up with further details on the product. The established ePages check out process will be activated, as soon as the customer adds all selected products to the shopping basket and wants to proceed with the order.

**Which shop do I need to use the plugin?**
The WordPress plugin will work with any shop based on ePages. Find out more about [ePages providers](http://www.epages.com/en/partner/provider/ "ePages providers") and select a plan that best meets your e-commerce needs.

**How can I make sure that my shop meets legal requirements?**
Some legal aspects, for example, the terms and conditions, need to be added to the ePages shop as well as on the WordPress site.

**How can the appearance of the e-commerce feature be adapted?**
Using CSS it is easy to change the design of your e-commerce pages on your WordPress site. With ePages software, the check out process can also be adapted.

**Where can I find more details regarding the installation of the plugin?**
This [manual](https://www.online-help-center.com/customer/portal/articles/2561815-how-do-i-use-the-wordpress-plugin- "Setup guide") gives you more details on the plugin installation.

== Screenshots ==

1. Product list view
2. Add products to a page

== Changelog ==

= 4.6 =
* Bugfixes and improvements on the beta version

= 0.1 =
* Initial version


== Upgrade Notice ==

= 0.1 =
* Use the plugin to sell products from your ePages shop on WordPress.

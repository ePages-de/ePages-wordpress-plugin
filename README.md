# ePages Online Shop

**Contributors**: epages

**Tags**: cart, checkout, e-commerce, ecommerce, paypal, sales, sell, shop, store, storefront, digital goods, downloadable products, e-commerce, e-commerce, online shop, online store, product catalog, products, shopping, shopping cart, wordpress ecommerce, wp e-commerce

**Requires at least**: 3.0.1

**Tested up to**: 4.5

**Stable tag**: 4.6

**License**: MIT

**License URL**: https://opensource.org/licenses/MIT 

Connect your ePages Online Shop with WordPress in less than 3 minutes.

## Description

**Start selling on your site with the powerful ePages shop solution. Simply choose an ePages shop which meets your needs and download the free online shop plugin for WordPress.**

See our plugin in action in [this](http://wordpress.epages.com/more-products/ "Demo") demo.

Join the community of merchants using the largest independent online shop software in Europe. We make it easy: We take care of the security and the faultless functioning of your online shop software. All technical updates are carried out for you automatically and without any additional costs. Take advantage of this unique, all-inclusive e-commerce package.

### Your advantages using the ePages online shop plugin

* Easy integration: Just a few clicks and you can start selling. With CSS you can take care of further adjustments

* Competitive price

* Powerful ordering process: SSL secured checkout with plenty of payments

* Ease of use: All e-commerce settings will be done through the established ePages administration area

* 60+ services and integrations (e.g. PayPal, Amazon, DHL) available

* Automated updates

Discover all features [here](http://www.epages.com/en/features/ "All features")

Our e-commerce software is available from [these hosting providers](http://www.epages.com/en/partner/provider/ "Hosting providers").

## Installation
### Automatic installation (the easy way)

Please refer to this [article](http://www.epages.com/downloads/pdf/epages-wordpress-plugin-setup-EN.pdf "Setup guide") for detailed guidance and screenshots.

**Setting up your online shop**

1. Visit one of [our partners](http://www.epages.com/en/partner/provider/ "Partners"), select a shop package that suits your needs and register your shop. 
2. Set up your shop. Find further support in our [help center](https://www.online-help-center.com/ "Help center").  
While setting up your shop you should especially take care of these steps:
  * Run the setup assistant
  * Start with adding your products
  * Set up one or more delivery methods
  * Set up one or more payment methods
  * Add legal texts (e.g. terms and conditions). You also have to add these texts to your WordPress website. 

**Installing the WordPress plugin**

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

**Adding products to pages of your WordPress website**

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

### Uploading the plugin zip archive in WordPress admin backend

* Download the *ePages Online Shop* plugin from the [GitHub repository](https://github.com/ePages-de/ePages-wordpress-plugin "Download")
* In your WordPress admin backend, navigate to *Plugins* → *Add New*
* Click *Upload Plugin* and choose the saved zip file (from step 1) in the appeared dialog window
* Click *Install* 

### Installation for developers

The ePages WordPress plugin enables you to integrate [SITe](https://github.com/ePages-de/site) into your Wordpress blog / page.
* Setup
  ```bash
  docker-compose up
  docker-compose run db mysql -h sitewordpress_db_1 -pexample wordpress < db.sql
  ```
* Now visit [http://localhost:8080/](http://localhost:8080/)
* You can login as the user "admin" with password "admin".


## Frequently Asked Questions
**How does the plugin work on my WordPress site?**
As soon as the plugin is installed, products will be showcased on selected pages or posts. If a customer clicks on one of the products, an overlay window opens up with further details on the product. The established ePages check out process will be activated, as soon as the customer adds all selected products to the shopping basket and wants to proceed with the order. 

**Which shop do I need to use the plugin?**
The WordPress plugin will work with any shop based on ePages. Find out more about [ePages providers](http://www.epages.com/en/partner/provider/ "ePages providers") and select a plan that best meets your e-commerce needs.

**How can I make sure that my shop meets legal requirements?**
Some legal aspects, for example, the terms and conditions, need to be added to the ePages shop as well as on the WordPress site.

**How can the appearance of the e-commerce feature be adapted?**
Using CSS it is easy to change the design of your e-commerce pages on your WordPress site. With ePages software, the check out process can also be adapted. 

**Where can I find more details regarding the installation of the plugin?**
This manual (LINK will be available soon) gives you more details on the plugin installation.

## Screenshots

1. Product list view
2. Add products to a page

## Changelog

= 4.6 =
* Bugfixes and improvements on the beta version

= 0.1 =
* Initial beta version

## Upgrade Notice

= 0.1 =
* Use the plugin to sell products from your ePages shop on WordPress.


## License
SITe-Wordpress is released under the [MIT License](http://opensource.org/licenses/MIT).

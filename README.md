# SITe-Wordpress
SITe-Wordpress is a Wordpress Plugin to integrate [SITe](https://github.com/ePages-de/site) in your Wordpress Blog. SITe-Wordpress let you integrate your online shop in a easy way in all your Wordpress Posts.

## Installation

 * For webmasters
  - Use a local copy of Wordpress. You can follow [this guide](https://codex.wordpress.org/Installing_WordPress_Locally_on_Your_Mac_With_MAMP) to help you in the installation.
  - Download the [latest version](https://github.com/ePages-de/site-wordpress/archive/master.zip)
  - Unzip it
  - Copy the ```site-wordpress-master``` folder into ```wp-content/plugins/```

 * For developers

  - Setup

  ```bash
  docker-compose up
  docker-compose run db mysql -h sitewordpress_db_1 -pexample wordpress < db.sql
  ```

  - Now visit [http://localhost:8080/](http://localhost:8080/)

  - You can login as the user "admin" with password "admin".



## License
SITe-Wordpress is released under the [MIT License](http://opensource.org/licenses/MIT).

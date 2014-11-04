Demonstration of basic YII project
===============

Basic Mini-Shop on YII framework with following functions:

* Overview of products with lazy loading
* View product details
* Manage products: add, view, delete, upload image
* Adding products into the cart via AJAX

-----------------------------


### Setup

Copy configuration file `config/example.main.local.php` to `config/main.local.php` and fill all necessary parameters like DB connection string and password.

Load `data/data.sql` into used DB.

Configure your web-server to make directory `www` base public path (`root` in nginx or DocumentRoot in Apache).

Make these directories writable for web-server:
* runtime
* www/assets
* www/images/uploads


### Demo data

You can load `data/demo_data.sql` into the DB and unpack `data/demo_uploads.zip` into `www/images/uploads` to get some products and see, how the project works full of data.


### System requirements

Tested on:

* PHP 5.5.18
* MySQL 5.6.19
* PHPUnit 4.1.3

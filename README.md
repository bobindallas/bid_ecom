# BID Ecommerce - a basic Laravel Ecommerce app
## This is an Unfinished Work in Progress

This is a basic ecommerce app that I started a while back for a former client.  They decided to go in a different direction but I kept working on it a bit over time.  The original app was written in CakePHP but I have since moved over to Laravel as my preferred platorm (no offense to Cake - it's a great platform too).

We're using:

* Laravel 6 => https://laravel.com/docs/6.x along with it's associated [requirements](https://laravel.com/docs/6.x#server-requirements)
* Spatie Permissions => https://github.com/spatie/laravel-permission
* Spatie Media Library => https://github.com/spatie/laravel-medialibrary
* Laravel Breadcrumbs => https://github.com/davejamesmiller/laravel-breadcrumbs
* Stripe => https://github.com/stripe/stripe-php
* Coreui => https://coreui.io/ for the admin interface
* Not included here but recommended for development is [laravel-debugbar](https://github.com/barryvdh/laravel-debugbar) or [laravel-telescope](https://github.com/laravel/telescope)

#### Install Instructions:

1) clone repo
2) composer install (or update to pull the latest - recommended) - install the rest of the required code
3) create your database (mysql)
4) copy .env.example to .env
5) php artisan key:generate - set the application key
6) php artisan storage:link - not needed here but recommended for standard Laravel install
7) edit .env to set your db name and credentials
8) php artisan migrate (or migrate:[re]fresh to clear tables) - run migrations to create tables
9) optionally edit databases/seeds/UsersTableSeeder.php to add / change the default users prior to seeding.  Leave the default Roles and Permissions as you can edit them later.
10) php artisan db:seed - this will give you the option to run migrate:refresh

#### Laravel 6 removed the authentication frontend so we have to install it separately (if you want it):

* composer require laravel/ui --dev
* npm install && npm run dev (pull in css / js requirements)

#### Generate basic login / registration scaffolding (take your pick)...

* php artisan ui bootstrap --auth
* php artisan ui vue --auth
* php artisan ui react --auth

11) login using default Superuser account =>  login: super@email.com password: secret

#### Notes:
* Superuser role ignores permissions - Check app/Providers/AuthServiceProvider.php
* In the App/Controller base class is a function called check_permission that checks permissions for various actions on controllers.  You can edit this to always return true for development to turn off permission checks.

#### TODO

* Factorys to gin some sample products
* Feature / Unit tests - started this but focused on infrastructure at the moment - I'll backfill tests when we have a rough framework in place

#### Missing / Pipeline

* Payment gateway - I've written to Auth.net many times - need to break that to a module and add stripe, paypal, etc
* Shipping calculation / interface - have a client that tracks shipping charges very closely as opposed to the general "free shipping" attitude of most sites
* Taxes - some interface to taxing authorities - was much nicer when the Internet was tax-free
* Internationalization - english only at this point but we want to add language packs once the product gets a little more mature

#### Video walkthrough:
https://www.youtube.com/watch?v=ecRgjOGI8nI

#### License:

[MIT license](http://opensource.org/licenses/MIT)


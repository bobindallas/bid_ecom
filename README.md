# BID Ecommerce - a basic Laravel Ecommerce app
## This is an Unfinished Work in Progress project - review the code but don't deploy it

This is a basic ecommerce app that I started a while back for a former client.  They decided to go in a different direction but I kept working on it a bit over time.  The original app was written in CakePHP but I have since moved over to Laravel as my preferred platorm (no offense to Cake - it's a great platform too).

We're using:

* Laravel 6 => https://laravel.com/docs/6.x along with it's associated [requirements](https://laravel.com/docs/6.x#server-requirements) 
* Spatie Permissions => https://github.com/spatie/laravel-permission
* Spatie Media Library => https://github.com/spatie/laravel-medialibrary
* Laravel Breadcrumbs => https://github.com/davejamesmiller/laravel-breadcrumbs
* Coreui => https://coreui.io/ for the admin interface
* Not included here but recommended for development is [laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)

#### Install Instructions:

1) clone repo
2) composer install (or update to pull the latest - recommended) - install the rest of the required code
3) create your database (mysql)
4) copy .env.example to .env
5) php artisan key:generate - set the application key 
5) php artisan storage:link - not needed here but recommended for standard Laravel install
6) edit .env to set your db name and credentials
7) php artisan:migrate (or migrate:[re]fresh to clear tables) - run migrations to create tables
8) optionally edit databases/seeds/UsersTableSeeder.php to add / change the default users prior to seeding.  Leave the default Roles and Permissions as you can edit them later.
9) php artisan db:seed - this will give you the option to run migrate:refresh
10) login using default Superuser account =>  login: super@email.com password: secret

#### Notes:
* Superuser role ignores permissions - Check app/Providers/AuthServiceProvider.php
* In the App/Controller base class is a function called check_permission that checks permissions for various actions on controllers.  You can edit this to always return true for development to turn off permission checks. 

#### License:

[MIT license](http://opensource.org/licenses/MIT)

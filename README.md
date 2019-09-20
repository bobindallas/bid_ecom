# Permissions Basic UI

This is a super basic UI for the Spatie Roles and Permissions Laravel package.  There are others out there but the few I looked at did not have a UI for maintaining Permissions which I want  so I wrote this one.

We're using:

* Laravel 6 => https://laravel.com/docs/6.x along with it's associated  [requirements](https://laravel.com/docs/6.x#server-requirements) 
* Spatie Permissions => https://github.com/spatie/laravel-permission
* Laravel Breadcrumbs => https://github.com/davejamesmiller/laravel-breadcrumbs
* Not included here but recommended for development is [laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)

**Note: this is a fork of my public package to move model definitions into the app/Model directory as a base for bigger projects.**

#### Install Instructions:

1) clone repo
2) composer update - install the rest of the required code
3) create your database (mysql)
4) copy .env.example to .env
5) php artisan key:generate - set the application key 
6) edit .env to set your db name and credentials
7) php artisan:migrate (or migrate:refresh to clear tables) - run migrations to create tables
8) optionally edit databases/seeds/UsersTableSeeder.php to add / change the default users prior to seeding.  Leave the default Roles and Permissions as you can edit them later.
9) php artisan db:seed - this will give you the option to run migrate:refresh
10) login using default Superuser account =>  login: super@email.com password: secret

#### Notes:
* In the App/Controller base class is a function called check_permission that checks permissions for various actions on controllers.  You can edit this to always return true for development to turn off permission checks. 

* In the resources/views/layouts/app.blade.php layout are a few permission related @can directives to control menu items - change or remove these as needed.

* Others use traits, etc to check roles / perms but I like the finer grained check even though it's a bit more code.

This was inspired by another project:  
https://github.com/saqueib/roles-permissions-laravel/tree/v5.7

#### License:

[MIT license](http://opensource.org/licenses/MIT)

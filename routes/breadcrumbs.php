<?php

// Home
Breadcrumbs::for('site.home', function ($trail) {
    $trail->push('Home', route('site.home'));
});

// Admin Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// pull in everything in the "breadcrumbs/" dir
foreach(glob(__DIR__.'/breadcrumbs/*.php') as $file){
   require $file;
}

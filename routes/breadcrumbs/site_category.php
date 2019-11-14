<?php

// Site > Category
Breadcrumbs::for('site.product_category', function ($trail, $product_category) {
    $trail->parent('site.home');
    $trail->push($product_category->name, route('site.product_category', $product_category->slug));
});

// Home > Roles > Create
// Breadcrumbs::for('roles.create', function ($trail) {
//     $trail->parent('roles.index');
//     $trail->push('New Role', route('roles.create'));
// });

// Home > Roles > Edit
// Breadcrumbs::for('roles.edit', function ($trail, $role) {
//     $trail->parent('roles.index');
//     $trail->push($role->name, route('roles.edit', $role->id));
// });


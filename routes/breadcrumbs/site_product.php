<?php

// Site > Product
Breadcrumbs::for('site.product', function ($trail, $product_category, $product) {
    $trail->parent('site.home');
    $trail->push($product_category->name, route('site.product_category', $product_category->slug));
    $trail->push($product->name);
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


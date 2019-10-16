<?php

// Home > products
Breadcrumbs::for('products.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Products', route('products.index'));
});

// Home > products > Create
Breadcrumbs::for('products.create', function ($trail) {
    $trail->parent('products.index');
    $trail->push('New Product', route('products.create'));
});

// Home > products > Edit
Breadcrumbs::for('products.edit', function ($trail, $product) {
    $trail->parent('products.index');
    $trail->push($product->name, route('products.edit', $product->id));
});


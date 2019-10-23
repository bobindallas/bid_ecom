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

// Home > products > Image List
Breadcrumbs::for('products.image_list', function ($trail, $product) {
    $trail->push('Products', route('products.index'));
    $trail->push($product->name, route('products.edit', $product->id));
    $trail->push('Image List', route('products.image_list', $product));
});

// Home > products > Image Grid
Breadcrumbs::for('products.image_grid', function ($trail, $product) {
    $trail->push('Products', route('products.index'));
    $trail->push($product->name, route('products.edit', $product->id));
    $trail->push('Image Grid', route('products.image_grid', $product));
});

// Home > products > Create Image
Breadcrumbs::for('products.create_image', function ($trail, $product) {
    $trail->push('Products', route('products.index'));
    $trail->push($product->name, route('products.edit', $product->id));
    $trail->push('Product Images', route('products.image_list', $product));
    $trail->push('New Image', route('products.create_image', $product));
});

// Home > products > Edit Image
Breadcrumbs::for('products.edit_image', function ($trail, $product) {
    $trail->push('Products', route('products.index'));
    $trail->push($product->name, route('products.edit', $product->id));
    $trail->push('Product Images', route('products.image_list', $product));
    $trail->push('Edit Product Image');
    // $trail->push('Edit Image', route('products.edit_image', $product));
});


<?php

// Home > product_options
Breadcrumbs::for('products.product_options', function ($trail, $product) {
    $trail->parent('dashboard');
    $trail->push($product->name, route('products.edit', $product));
    $trail->push('Product Options', route('products.product_options', $product));
});

// Home > product_options > Create
Breadcrumbs::for('products.product_options_create', function ($trail, $product) {
		$trail->parent('products.product_options');
    $trail->push('New Product', route('product_options.create'));
});

// Home > product_options > Edit
Breadcrumbs::for('products.product_option_edit', function ($trail, $product, $product_option) {
    $trail->parent('products.product_options');
    $trail->push($product_option->name, route('product_options.edit', $product_option->id));
});


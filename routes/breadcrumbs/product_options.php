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
	$trail->parent('products.product_options', $product);
	$trail->push($product_option->name);
});

// Home > product_options > Index
Breadcrumbs::for('products.product_option_index', function ($trail, $product, $product_option) {
	$trail->parent('products.product_options', $product);
	$trail->push($product_option->name, route('products.product_option_items', $product, $product_option));
});

// Home > product option > product_option items
Breadcrumbs::for('products.product_option_items', function ($trail, $product, $product_option) {
	// dd($product_option);
	// $trail->parent('products.product_options', $product);
	$trail->parent('products.product_option_edit', $product, $product_option);
	// $trail->push($product_option->name);
	$trail->push('Product Option Items');
});


<?php

// Home > product_options > Index
Breadcrumbs::for('product_options.index', function ($trail, $product) {
	$trail->parent('dashboard');
	$trail->push('Products', route('products.index'));
	$trail->push($product->name, route('products.index', $product));
	$trail->push('Product Options', route('product_options.index', $product));
});

// Home > product_options > Create
Breadcrumbs::for('product_options.create', function ($trail, $product) {
	$trail->parent('product_options.index', $product);
	$trail->push('New Product', route('product_options.create', $product));
});

// Home > product_options > Edit
Breadcrumbs::for('product_options.edit', function ($trail, $product, $product_option) {
	$trail->parent('product_options.index', $product);
	$trail->push($product_option->name);
});

// Home > product option > product_option items
Breadcrumbs::for('products.product_option_items', function ($trail, $product, $product_option) {
	$trail->parent('products.product_options', $product);
	$trail->push($product_option->name, route('products.product_options', $product));
	$trail->push('Product Option Items');
});

// Home > product_option > product_option_item > Edit
Breadcrumbs::for('products.product_option_item_edit', function ($trail, $product, $product_option, $product_option_item) {
	$trail->parent('products.product_options', $product);
	$trail->push($product_option->name, route('products.product_options', $product));
	// $trail->parent('products.product_option_items', $product, $product_option);
	$trail->push($product_option_item->name);
});


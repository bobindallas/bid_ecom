<?php

// Home > product_options > product_option_items > Index
Breadcrumbs::for('product_option_items.index', function ($trail, $product_option) {
	$trail->parent('product_options.index', $product_option->product);
	$trail->push($product_option->name, route('product_option_items.index', $product_option->product, $product_option));
});

// Home > product_options > product_option_item > Create
Breadcrumbs::for('product_option_items.create', function ($trail, $product_option) {
	$trail->parent('product_options.index', $product_option->product);
	$trail->push('New Product Option Item', route('product_option_items.create', $product_option));
});

// Home > product_options > product_option_item > Edit
Breadcrumbs::for('product_option_items.edit', function ($trail, $product, $product_option) {
	$trail->push($product_option->name, route('product_option_items.index', $product_option->product, $product_option));
	$trail->parent('product_options.index', $product);
	$trail->push($product_option->name);
});


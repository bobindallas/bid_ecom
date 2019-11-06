<?php

// Home > product_options > Image List
Breadcrumbs::for('product_option_images.index_list', function ($trail, $product_option) {
	$trail->parent('dashboard');
	$trail->push('product_options', route('product_options.index', $product_option->product));
	$trail->push($product_option->name, route('product_options.edit', $product_option->id));
	$trail->push('Image List', route('product_option_images.index_list', $product_option));
});

// Home > product_options > Image Grid
Breadcrumbs::for('product_option_images.index_grid', function ($trail, $product_option) {
	$trail->parent('dashboard');
	$trail->push('product_options', route('product_options.index', $product_option->product));
	$trail->push($product_option->name, route('product_options.edit', $product_option->id));
	$trail->push('Image Grid', route('product_option_images.index_grid', $product_option));
});

// Home > product_options > Create Image
Breadcrumbs::for('product_option_images.create', function ($trail, $product_option) {
	$trail->parent('dashboard');
	$trail->push('product_options', route('product_options.index', $product_option->product));
	$trail->push($product_option->name, route('product_options.edit', $product_option->id));
	$trail->push('Option Images', route('product_option_images.index_list', $product_option));
	$trail->push('New Image', route('product_option_images.create', $product_option));
});

// Home > product_options > Edit Image
Breadcrumbs::for('product_option_images.edit', function ($trail, $product_option) {
	$trail->parent('dashboard');
	$trail->push('product_options', route('product_options.index'));
	$trail->push($product_option->name, route('product_options.edit', $product_option->id));
	$trail->push('Product Images', route('product_option_images.index_list', $product_option));
	$trail->push('Edit Product Image');
});


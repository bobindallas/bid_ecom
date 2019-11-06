<?php

// Home > product > product_option_items > Image List
Breadcrumbs::for('product_option_item_images.index_list', function ($trail, $product_option_item) {
	$trail->parent('dashboard');
	$trail->push('product_options', route('product_options.index', $product_option_item->product_option->product));
	$trail->push($product_option_item->name, route('product_options.edit', $product_option_item->id));
	$trail->push('Image List', route('product_option_item_images.index_list', $product_option_item));
});

// Home > product > product_option_items > Image Grid
Breadcrumbs::for('product_option_item_images.index_grid', function ($trail, $product_option_item) {
	$trail->parent('dashboard');
	$trail->push('product_options', route('product_options.index', $product_option_item->product_option->product));
	$trail->push($product_option_item->name, route('product_options.edit', $product_option_item->id));
	$trail->push('Image Grid', route('product_option_item_images.index_grid', $product_option_item));
});

// Home > product > product_option_items > Create Image
Breadcrumbs::for('product_option_item_images.create', function ($trail, $product_option_item) {
	$trail->parent('dashboard');
	$trail->push('product_options', route('product_options.index', $product_option_item->product_option->product));
	$trail->push($product_option_item->name, route('product_options.edit', $product_option_item->id));
	$trail->push('Option Images', route('product_option_item_images.index_list', $product_option_item));
	$trail->push('New Image', route('product_option_item_images.create', $product_option_item));
});

// Home > product > product_option_items > Edit Image
Breadcrumbs::for('product_option_item_images.edit', function ($trail, $product_option_item) {
	$trail->parent('dashboard');
	$trail->push('product_options', route('product_options.index', $product_option_item->product_option->product));
	$trail->push($product_option_item->name, route('product_options.edit', $product_option_item->id));
	$trail->push('Product Images', route('product_option_item_images.index_list', $product_option_item));
	$trail->push('Edit Product Image');
});


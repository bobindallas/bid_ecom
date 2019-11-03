<?php

// Home > products > Image List
Breadcrumbs::for('product_images.index_list', function ($trail, $product) {
	$trail->parent('dashboard');
	$trail->push('Products', route('products.index'));
	$trail->push($product->name, route('products.edit', $product->id));
	$trail->push('Image List', route('product_images.index_list', $product));
});

// Home > products > Image Grid
Breadcrumbs::for('product_images.index_grid', function ($trail, $product) {
	$trail->parent('dashboard');
	$trail->push('Products', route('products.index'));
	$trail->push($product->name, route('products.edit', $product->id));
	$trail->push('Image Grid', route('product_images.index_grid', $product));
});

// Home > products > Create Image
Breadcrumbs::for('product_images.create', function ($trail, $product) {
	$trail->parent('dashboard');
	$trail->push('Products', route('products.index'));
	$trail->push($product->name, route('products.edit', $product->id));
	$trail->push('Product Images', route('product_images.index_list', $product));
	$trail->push('New Image', route('product_images.create', $product));
});

// Home > products > Edit Image
Breadcrumbs::for('product_images.edit', function ($trail, $product) {
	$trail->parent('dashboard');
	$trail->push('Products', route('products.index'));
	$trail->push($product->name, route('products.edit', $product->id));
	$trail->push('Product Images', route('product_images.index_list', $product));
	$trail->push('Edit Product Image');
});


<?php

// Home > product_categories > Image List
Breadcrumbs::for('product_category_images.index_list', function ($trail, $product_category) {
	$trail->parent('dashboard');
	$trail->push('Product Categories', route('product_categories.index', $product_category->product));
	$trail->push($product_category->name, route('product_categories.edit', $product_category->id));
	$trail->push('Image List', route('product_category_images.index_list', $product_category));
});

// Home > product_categories > Image Grid
Breadcrumbs::for('product_category_images.index_grid', function ($trail, $product_category) {
	$trail->parent('dashboard');
	$trail->push('Product Categories', route('product_categories.index', $product_category->product));
	$trail->push($product_category->name, route('product_categories.edit', $product_category->id));
	$trail->push('Image Grid', route('product_category_images.index_grid', $product_category));
});

// Home > product_categories > Create Image
Breadcrumbs::for('product_category_images.create', function ($trail, $product_category) {
	$trail->parent('dashboard');
	$trail->push('Product Categories', route('product_categories.index', $product_category->product));
	$trail->push($product_category->name, route('product_categories.edit', $product_category->id));
	$trail->push('Category Images', route('product_category_images.index_list', $product_category));
	$trail->push('New Image', route('product_category_images.create', $product_category));
});

// Home > product_categories > Edit Image
Breadcrumbs::for('product_category_images.edit', function ($trail, $product_category) {
	$trail->parent('dashboard');
	$trail->push('Product Categories', route('product_categories.index'));
	$trail->push($product_category->name, route('product_categories.edit', $product_category->id));
	$trail->push('Category Images', route('product_category_images.index_list', $product_category));
	$trail->push('Edit Product Category Image');
});


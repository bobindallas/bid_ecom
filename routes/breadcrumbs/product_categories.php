<?php

// Home > product_categories
Breadcrumbs::for('product_categories.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('product_categories', route('product_categories.index'));
});

// Home > product_categories > Create
Breadcrumbs::for('product_categories.create', function ($trail) {
    $trail->parent('product_categories.index');
    $trail->push('New Product', route('product_categories.create'));
});

// Home > product_categories > Edit
Breadcrumbs::for('product_categories.edit', function ($trail, $product_category) {
    $trail->parent('product_categories.index');
    $trail->push($product_category->name, route('product_categories.edit', $product_category->id));
});


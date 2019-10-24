<?php

// Home > product_attributes
Breadcrumbs::for('product_attributes.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('product_attributes', route('product_attributes.index'));
});

// Home > product_attributes > Create
Breadcrumbs::for('product_attributes.create', function ($trail) {
    $trail->parent('product_attributes.index');
    $trail->push('New Product', route('product_attributes.create'));
});

// Home > product_attributes > Edit
Breadcrumbs::for('product_attributes.edit', function ($trail, $product_category) {
    $trail->parent('product_attributes.index');
    $trail->push($product_category->name, route('product_attributes.edit', $product_category->id));
});


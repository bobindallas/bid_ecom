<?php

// Home > store_details
Breadcrumbs::for('store_details.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Store Details', route('store_details.index'));
});

// Home > store_details > Create
Breadcrumbs::for('store_details.create', function ($trail) {
    // $trail->parent('store_details.index');
    $trail->push('New Store', route('store_details.create'));
});

// Home > store_details > Edit
Breadcrumbs::for('store_details.edit', function ($trail, $store_detail) {
    // $trail->parent('store_details.index');
    $trail->push($store_detail->name, route('store_details.edit', $store_detail->id));
});


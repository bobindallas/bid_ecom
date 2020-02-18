<?php

// Shopping Cart
Breadcrumbs::for('shopping_cart', function ($trail) {
   $trail->push('Home', route('site.home'));
   $trail->push('Shopping Cart', route('view_cart'));
});

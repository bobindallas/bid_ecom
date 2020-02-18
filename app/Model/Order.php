<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

   public function customer() {
      return $this->belongsTo('App\Model\Customer', 'customer_id');
   }   

   public function shopping_cart() {
      return $this->hasOne('App\Model\ShoppingCart');
   }
}

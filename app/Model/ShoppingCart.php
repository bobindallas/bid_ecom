<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model {

   // handle empty order ids (even though I fixed this in the migration)
   public function setOrderIdAttribute($value) {
      $this->attributes['order_id'] = (! is_null($value) && isset($value) && (int) $value > 0) ? $value : 0;  
   } 
}


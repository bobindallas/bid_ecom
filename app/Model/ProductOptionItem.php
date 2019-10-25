<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductOptionItem extends Model {

   public function product_option() {
      return $this->belongsTo('App\Model\ProductOption');
   } 

}

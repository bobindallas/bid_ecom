<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model {

   public function product() {
      return $this->belongsTo('App\Model\Product');
   } 

   public function product_option_item() {
      return $this->hasMany('App\Model\ProductOptionItem')->orderBy('display_order', 'asc');
   } 

}

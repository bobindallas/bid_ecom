<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CategoryHasProduct extends Model {

	public function product() {

		return $this->hasOne('App\Model\Product', 'id', 'product_id');

	}
}

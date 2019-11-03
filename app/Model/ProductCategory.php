<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model {

	public function category_has_product() {
		return $this->hasMany('App\Model\CategoryHasProduct');
	}
}

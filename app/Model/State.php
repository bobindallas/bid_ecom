<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class State extends Model {

	public function country() {
		return $this->belongsTo('App\Model\Country');
	}	
}

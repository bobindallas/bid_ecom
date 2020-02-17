<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class ProductOptionItem extends Model implements HasMedia {

	use HasMediaTrait;

	public function product_option() {
		return $this->belongsTo('App\Model\ProductOption')->orderBy('display_order', 'asc');
	} 

	// handle sketchy display_order flags (null/0/1)
	public function setDisplayOrderAttribute($value) {
		$this->attributes['display_order'] = (! is_null($value) && isset($value)) ? $value : 1;  
	}

	// handle sketchy price_value
	public function setPriceValueAttribute($value) {
		$this->attributes['price_value'] = (! is_null($value) && isset($value)) ? $value : 0;  
	}

	// handle sketchy active flags (null/0/1)
	public function setActiveAttribute($value) {
		$this->attributes['active'] = (! is_null($value) && isset($value)) ? $value : 0;  
	}

	public function media() {
	
		return $this->morphMany(Media::class, 'model');
	}	

	public function registerMediaCollections() {
	
		$this->addMediaCollection(config('medialibrary.collections.product_option_item_images'))
			->acceptsMimeTypes(['image/jpeg', 'image/gif', 'image/png']);
	}	

	public function registerMediaConversions(Media $media = null) {
	
		$this->addMediaConversion('large')->width(1000)->height(1000)->sharpen(10);
		$this->addMediaConversion('medium')->width(800)->height(800)->sharpen(10);
		$this->addMediaConversion('small')->width(400)->height(400)->sharpen(10);
		$this->addMediaConversion('thumb')->width(200)->height(200)->sharpen(10);
	
	}
}

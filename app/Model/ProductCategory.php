<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class ProductCategory extends Model implements HasMedia {

	use HasMediaTrait;

	public function category_has_product() {
		return $this->hasMany('App\Model\CategoryHasProduct');
	}

	public function media() {

		return $this->morphMany(Media::class, 'model');
	}

	public function registerMediaCollections() {

		$this->addMediaCollection(config('medialibrary.collections.product_category_images'))
			->acceptsMimeTypes(['image/jpeg', 'image/gif', 'image/png']);
	}

	public function registerMediaConversions(Media $media = null) {

		$this->addMediaConversion('large')->width(1000)->height(1000)->sharpen(10);
		$this->addMediaConversion('medium')->width(800)->height(800)->sharpen(10);
		$this->addMediaConversion('small')->width(400)->height(400)->sharpen(10);
		$this->addMediaConversion('thumb')->width(200)->height(200)->sharpen(10);

	}
}

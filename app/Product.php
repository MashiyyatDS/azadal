<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Product extends Model
{

	protected $fillable = [
		'name','type','description','quantity',
		'srp','warranty','delivery_fee',
		'discount','original_price','store_id','status'
	];

	protected $attributes = [
		'status' => 'pending'
	];

	public function scopeOrderedName($value) {
		return $value->orderBy('name','ASC');
	}

	public function scopeEncryptId($key) {
		return $value->id;
	}

	public function scopePending($value) {
		return $value->where('status','=','pending');
	}

	public function store() {
		return $this->belongsTo('App\Store');
	}

	public function carts() {
		return $this->hasOne('App\Cart','product_id');
	}

	public function tags() {
		return $this->hasMany('App\ProductTags','product_id');
	}

	public function categories() {
		return $this->hasMany('App\ProductCategory');
	}

	public function images() {
		return $this->hasMany('App\ProductImage');
	}

	public function reviews() {
		return $this->hasMany('App\ProductReview');
	}

	public function favorites() {
		return $this->hasMany('App\Favorite','product_id');
	}

}

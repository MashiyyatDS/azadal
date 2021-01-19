<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
	protected $fillable = [
		'product_id','user_id','store_id','quantity','status'
	];

    protected $attributes = [
        'status' => 'on-cart'
    ];

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function product() {
    	return $this->belongsTo('App\Product');
    }

    public function store() {
    	return $this->belongsTo('App\Store');
    }

    public function images() {
        return $this->hasManyThrough('App\ProductImage','App\Product');
    }
}

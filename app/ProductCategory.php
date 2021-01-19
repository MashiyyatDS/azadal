<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
   
	protected $fillable = [
		'category','product_id'
	];

	public function product() {
		return $this->belongsTo('App\Product');
	}

}

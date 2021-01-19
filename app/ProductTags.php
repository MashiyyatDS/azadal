<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTags extends Model
{

	protected $fillable = [
		'tag','product_id'
	];

	public function product() {
		return $this->belongsTo('App\Product');
	}

}

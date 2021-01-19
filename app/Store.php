<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    
		protected $fillable = [
			'name','status','description','profile','email','contact','user_id'
		];

		protected $attributes = [
			'status' => 'pending',
			'profile' => 'noimage.png'
		];

		public function products() {
			return $this->hasMany('App\Product');
		}

		public function user() {
			return $this->belongsTo('App\User', 'user_id');
		}

		public function carts() {
			return $this->hasMany('App\Cart', 'store_id');
		}
		
}

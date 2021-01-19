<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
   protected $fillable = [
   	'product_id','user_id','rate','content'
   ];

   public function user() {
   	return $this->belongsTo('App\User');
   }

   public function product() {
   	return $this->belongsTo('App\Product','product_id');
   }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;
use App\Product;
use App\User;
use Auth;

class FavoritesController extends Controller
{
    
  public function create(Request $request) {
  	$myFavorites = Auth::user()->favorites()->get();
  	$exist = false;
  	foreach ($myFavorites as $myFavorite) {
  		if ($myFavorite->product_id == $request->product_id) {
  			$exist = true;
  		}else {
  			$exist = false;
  		}
  	}
  	if ($exist == false) {
  		$favorite = Favorite::create([
	  		'user_id' => Auth::user()->id,
	  		'product_id' => $request->product_id
	  	]);
  		return response()->json([
  			'message' => 'Product added to Favorites'
  		]);
  	}else {
  		return response()->json([
  			'message' => 'Product already exist'
  		]);
  	}
  }/*===================CREATE FAVORITE===================*/

  public function destroy($id) {
  	$favorite = Favorite::find($id);
  	$favorite->delete();
  }

}

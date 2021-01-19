<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductImage;

class ProductImagesController extends Controller
{
  
	public function create(Request $request) {
		// $productImage = ProductImage::create($request->except('product_id') + [
		// 	'product_id' => 1
		// ]);
		return response()->json($request->all());
	}

}

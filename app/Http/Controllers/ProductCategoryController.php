<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductCategory;
use DB;

class ProductCategoryController extends Controller
{
 
	public function create(Request $request) {
		$category = ProductCategory::create($request->all());
		return response()->json([
			'category' => $category
		]);
	}

	public function categoryJSON() {
		$categories = DB::table('product_categories')->select('category')->get();
		return response()->json(['categories'=>$categories]);
	}
	
}

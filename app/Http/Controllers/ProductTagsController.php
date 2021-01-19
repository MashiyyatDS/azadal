<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductTags;

class ProductTagsController extends Controller
{
    public function create(Request $request) {
    	$productTag = ProductTags::create($request->except('tag') + [
    		'tag' => str_replace(' ', '_', $request->tag)
    	]);
    	return response()->json([
    		'tag' => $productTag
    	]);
    }
}

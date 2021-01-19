<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\ProductReview;
use Auth;

class ProductReviewsController extends Controller
{
    
	public function create(Request $request) {
		$review = ProductReview::create($request->except('product_id') + [
			'product_id' =>Crypt::decryptString($request->pid),
			'user_id' => Auth::user()->id
		]);
		return response()->json([
			'review' => $review,
			'user' =>$review->user()->get()
		]);
	}

}

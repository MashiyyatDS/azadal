<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;

class CheckoutsController extends Controller
{
    public function validateCheckout(Request $request) {
    	$product = Product::find($request->product_id);
    	$cart = Cart::find($request->cart_id);

    	$discounted_price = $product->original_price - ($product->original_price * ($product->discount * .01));
    	$total_price = $product->delivery_fee + ($discounted_price * $cart->quantity);
    	return response()->json([
    		'product' => $product,
    		'cart' => $cart,
    		'total_price' => $total_price
    	]);
    }
}

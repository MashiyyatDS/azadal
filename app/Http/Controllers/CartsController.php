<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCartValidation;
use App\Cart;
use App\Product;
use Auth;

class CartsController extends Controller
{
    public function create(StoreCartValidation $request) {
        $myCart = Auth::user()->carts()->get();
        $product = Product::find($request->product_id);
        $cartProduct = Cart::where([
          ['product_id','=',$request->product_id],
          ['user_id','=',Auth::user()->id],
          ['status','=','on-cart']
        ]);
        if ($cartProduct->exists()) {
          return response()->json([
            'message' => 'Product already on cart',
            'icon' => 'error'
          ]);
        }else {
          if ($product->quantity < $request->quantity) {
            return response()->json([
              'cart'=>$cart,
              'message' => "Not enough Stock",
              'icon' => 'error'
            ]);
          }else {
            $cart = Cart::create([
              'user_id' => Auth::user()->id,
              'product_id' => $request->product_id,
              'store_id' => $request->store_id,
              'quantity' => $request->quantity,
            ]);
            return response()->json([
              'cart'=>$cart,
              'message' => "Product added to cart",
              'icon' => 'success',
              'status' => 'success'
            ]);
          } /*===============CHECK OF PRODUCT HAVE ENOUGH STOCK================*/
        }/*===============IF PRODUCT ALREADY ON CART================*/
    }

    public function myCart() {
    	$carts = Auth::user()->carts()->get();
    }

    public function myCartJSON() {
      $carts = Auth::user()->carts()->with('product.images')
                                    ->with('store')
                                    ->get();
      return response()->json([
        'carts' => $carts,
        'total' => count($carts)
      ]);
    }

    public function destroy($id) {
    	$cart = Cart::find($id);
      if ($cart->user_id != Auth::user()->id) {
        return response()->json(['message' => 'Unauthorized']);
      }else {
        $cart->delete();
      }
    }
}

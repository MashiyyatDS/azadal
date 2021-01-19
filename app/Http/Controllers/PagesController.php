<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Store;
use App\Product;
use App\ProductCategory;
use App\Cart;
use Auth;
use DB;

class PagesController extends Controller
{
    public function index() {
    	return view('pages.index');
    }

    public function profile() {
    	return view('user_pages.profile');
    }

    public function profileSettings() {
      $user = User::find(Auth::user());
      return view('user_pages.profilesettings')->with('user', $user);
    }

    public function mycart() {
      $carts = Auth::user()->carts()->get();
    	return view('user_pages.mycart')->with('carts',$carts);
    }

    public function favorites() {
      $favorites = Auth::user()->favorites()->with('product')->get();
      // return response()->json(['favorites' => $favorites]);
      return view('user_pages.favorites')->with('favorites',$favorites);
    }

    public function shopnow() {
      $products = Product::orderBy('name',rand())->paginate(12);
    	return view('user_pages.shopnow')->with('products',$products);
    }

    public function stores() {
      $stores = Store::where('status','=','open')->orderBy('name','ASC')->paginate(12);
      return view('user_pages.storelist')->with('stores',$stores);
    }

    public function products() {
      return '<h1>This is Products</h1>';
    }

    public function mystore() {
      $mystore = Auth::user()->store()->get();
      return view('user_pages.mystore')->with('mystore',$mystore);
    }

    public function storeproducts() {
      $mystore = Auth::user()->store()->orderBy('created_at','asc')->with('products')->get();
      return view('user_pages.storeproducts')->with('mystore', $mystore);
    }

    public function addproducts() {
      $mystore = Auth::user()->store()->get();
      return view('user_pages.addproducts')->with('mystore', $mystore);
    }

    public function viewProduct($sid) {
      try {
        $product = Product::find(Crypt::decryptString($sid));
        $discounted = $product->original_price - ($product->original_price * ($product->discount * .01));
        return view('user_pages.viewproduct')->with('product',$product)->with('discounted',$discounted);
      } catch (DecryptException $e) {
        abort(404);
      }/* find product through encrypted id */
    }/*===================View Product===================*/

    public function myorders() {
      $orders = Auth::user()->carts()->where('status','ordered')->get();
      return view('user_pages.myorders')->with('orders',$orders);
    }

    public function orders() {
      return view('user_pages.orders');
    }

    public function ordersJSON() {
      $store = Auth::user()->store()->get();
      $carts = $store[0]->carts()->where('status','ordered')->get();
      return response()->json(['orders'=>$carts]);
    }

}

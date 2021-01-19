<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Store;
use App\Product;
use App\User;

class AdminPageController extends Controller
{
    
	public function index() {
		if (Auth::user()->type == 'admin') {
			$stores = Store::all();
			$products = Product::all();
			$users = User::all();
			return view('admin.index')->with('stores',$stores)
																->with('products',$products)
																->with('users',$users);
		}else {
			abort(404);
		}
	}

	public function storeList() {
		$stores = Store::with('user')->where('status','=','open')->orWhere('status','=','closed')->with('products')->paginate(5);
		return view('admin.store_list')->with('stores',$stores);
	}

	public function storeRequests() {
		$storeRequests = Store::all()->where('status','=','pending');
		return view('admin.store_requests')->with('storeRequests',$storeRequests);
	}

	public function productList() {
		return view('admin.product_list');
	}

	public function productRequest() {
		return view('admin.product_request');
	}

}

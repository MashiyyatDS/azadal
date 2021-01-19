<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreProductValidation;
use App\Product;
use App\ProductTags;
use App\ProductCategory;
use App\ProductImage;

class ProductsController extends Controller
{

	/* create product */
	public function create(StoreProductValidation $request) {
		$product = Product::create($request->except('store_id') + [
			'store_id' => Crypt::decryptString($request->store_id)
		]);
		
		if ($request->has('image')) {
			foreach ($request->image as $image) {
				$imageName = time().$product->id.'_'.$image->getClientOriginalName();
				$path = $image->storeAs('public/images/product_images/'.$product->id, $imageName);
				$saveImage = $product->images()->save(new ProductImage([
					'image' => $imageName
				]));	
			}
		}
		
		return response()->json([
			'product' => $product,
			'images' => $product->images()->get(),
			'tags' => $product->tags()->get()
		]);

	}

	/* find product through id */
	public function find($id) {
		$product = Product::find($id);
		$discounted = $product->original_price - ($product->original_price * ($product->discount * .01));
		if ($product) {
			return response()->json([
				'product'		=>	$product,
				'discount' 	=>	$discounted, 
				'tags'			=>	$product->tags()->select('tag')->get(),
				'categories'=>	$product->categories()->select('category')->get(),
				'images'		=>	$product->images()->select('image')->get()
			]);
		}else {
			return response()->json(["product"=>"not found"]);
		}
	}

	/* find product through tag */
	public function findTag($tag) {
		$tags = ProductTags::all()->where('tag','=',$tag);
		return view('user_pages.viewtag')->with('tags',$tags)->with('tag',$tag);
	}

	/* delete product */
	public function delete($id) {
		$product = Product::find($id);
		foreach ($product->images()->get() as $image) {
			Storage::Delete('public/images/product_images/'.$product->id.'/'.$image->image);
		}
		$product->images()->delete();
		$product->categories()->delete();
		$product->tags()->delete();
		$product->delete();
	}

	/* Update product */
	public function update(StoreProductValidation $request, $id) {
		$product = Product::find($id);
		$product->tags()->delete();
		$product->categories()->delete();
		$product->update($request->all());
		if($request->has('image')){
			foreach ($product->images()->get() as $image) {
				$product->images()->delete();
				Storage::Delete('public/images/product_images/'.$product->id.'/'.$image->image);
			}
			foreach($request->image as $image) {
				$imageName = time().$product->id.'_'.$image->getClientOriginalName();
				$path = $image->storeAs('public/images/product_images/'.$product->id, $imageName);
				$saveImage = $product->images()->save(new ProductImage([
					'image' => $imageName
				]));
			}
		}
		
		return response()->json([
			'product' => $product,
			'image' => $product->images()->select('image')->get(),
			'tags' => $product->tags()->select('tag')->get(),
			'category' => $product->categories()->select('category')->get()
		]);
	}

	public function productImages($id) {
		$product = Product::find($id);
		return response()->json([
			'image' => $product->images()->select('image')->limit(1)->get()
		]);
	}

	/* list of products JSON paginated */
	public function productList() {
		$products = Product::orderBy('name','ASC')
											 ->where('status','=','active')
											 ->with('images')
											 ->with('tags')
											 ->with('store')
											 ->with('categories')->paginate(10);
		return response()->json([
			'product' => $products
		]);
	}

	/* list of product request JSON paginated */
	public function productRequest() {
		$products = Product::orderBy('name','ASC')
											 ->Pending()
											 ->with('images')
											 ->with('tags')
											 ->with('store')
											 ->with('categories')->paginate(10);							 
		return response()->json([
			'product' => $products
		]);
	}

	/* accept product request */
	public function acceptProduct($id) {
		$product = Product::find($id);
		$product->update([
			'status' => 'active'
		]); 
	}

	/* refuse product request */
	public function refuseProduct($id) {
		$product = Product::find($id);
		$product->update([
			'status' => 'pending'
		]); 
	}

	/* refuse product request */
	public function removeProduct($id) {
		$product = Product::find($id);
		$product->update([
			'status' => 'pending'
		]); 
	}

	/* search product json paginated */
	public function searchProductList($data) {
		$product = Product::where('name','LIKE','%'.$data.'%')
											->where('status','=','active')
											->with('store')
											->with('tags')
											->with('categories')
											->paginate(5);
		return response()->json([
			'product' => $product
		]);
	}

}

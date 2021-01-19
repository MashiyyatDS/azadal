<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Storage;
use App\Store;
use Auth;

class StoresController extends Controller
{
		public function create(Request $request) {	
			$profile = $request->name.'_'.time().'.png';
			$path = $request->profile->storeAs('public/images/store_profiles', $profile);
			$store = Auth::user()->store()->save(new Store($request->except('profile') + [
				'profile' => $profile
			]));
			return response()->json($store);
		}/*============CREATE STORE=============*/

		public function update(Request $request,$id) {
			$store = Store::find($id);
			if($request->has('profile')) {
				$profile = $request->name.'_'.time().'.png';
				Storage::Delete('public/images/store_profiles/'.$store->profile);
				$path = $request->profile->storeAs('public/images/store_profiles', $profile);
				$store->update($request->except('profile') + [
					'profile' => $profile
				]);
			} else {
				$store->update($request->all());
			}
			return response()->json(['store' => $store]);
		}/*============UPDATE STORE=============*/

		public function delete($sid) {
			try {
				$store = Store::find(Crypt::decryptString($sid));
			} catch (DecryptException $e) {
				return abort(404);
			}
			$store->delete();
			return view('user_pages.mystore');
		}/*============DELETE STORE=============*/

		public function find($id) {
			$store = Store::find($id);
			return response()->json([
				'store'=>$store,
				'user'=>$store->user()->get(),
				'productCount' => $store->products()->count()
			]);
		}/*============FIND STORE=============*/

		public function closeStore(Request $request) {
			try {
				$store = Store::find($request->sid);
			} catch (DecryptException $e) {
				return abort(404);
			}
			$store->update([
				'status' => 'closed'
			]);
			return response()->json([
				'store'=>$store
			]);
		}/*============CLOSE STORE=============*/

		public function refuseStore(Request $request) {
			try {
				$store = Store::find($request->sid);
			} catch (DecryptException $e) {
				return abort(404);
			}
			$store->update([
				'status' => 'refused'
			]);
			return response()->json([
				'store'=>$store
			]);
		}/*============REFUSE STORE REQUEST=============*/

		public function acceptStore(Request $request) {
			try {
				$store = Store::find($request->sid);
			} catch (DecryptException $e) {
				return abort(404);
			}
			$store->update([
				'status' => 'open'
			]);
			return response()->json([
				'store'=>$store
			]);
		}/*============ACCEPT STORE REQUEST=============*/

		public function showMore() {
			$stores = Store::with('user')->where('status','=','open')->orWhere('status','=','closed')->paginate(5);
			$sid = Store::select('id')->where('status','=','open')->orWhere('status','=','closed')->paginate(5);
			return response()->json([
				'store' => $stores
			]);
		}/*============SHOWMORE STORE LIST=============*/

		public function searchMore() {
			$store = Store::with('user')->where('name','LIKE','%'.$data.'%')->orWhere('email','LIKE','%'.$data.'%')->paginate(5);
			return response()->json([
				'store' => $stores
			]);
		}/*============VIEW MORE SEARCHED STORE=============*/

		public function searchStore($data) {
			$store = Store::with('user')
				->where('name','LIKE','%'.$data.'%')
				->orWhere('contact','LIKE','%'.$data.'%')
				->paginate(5);
			return response()->json(['store'=>$store]);
		}/*============SEARCH STORE=============*/

}

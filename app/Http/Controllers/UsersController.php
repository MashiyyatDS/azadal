<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Storage;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\UserUpdateValidation;

class UsersController extends Controller
{
    
	public function updateAccount(UserUpdateValidation $request) {
		if($request->has('profile')) {
			$profile_name = $request->profile->getClientOriginalName();
			Storage::Delete('public/images/user_profiles/'.Auth::user()->id.'/'.Auth::user()->profile);
			$path = $request->profile->storeAs('public/images/user_profiles/'.Auth::user()->id, $profile_name);
			Auth::user()->update($request->except('profile') + [
				'profile' => $profile_name
			]);	
		}else {
			Auth::user()->update($request->all());
		};
		return response()->json(Auth::user());
	}

	public function findAccount() {
		$account = User::find(Auth::user()->id);
		if (Auth::user()->id == $account->id) {
			return response()->json([
				'account'=>$account,
				'sid'=> Crypt::encryptString($account->id)
			]);
		}else {
			return response()->json(['message'=>'Unauthorized']);
		}
	}

}

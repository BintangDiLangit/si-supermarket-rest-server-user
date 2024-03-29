<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassportAuthController extends Controller
{
	public function register(Request $request)
	{
		$this->validate($request, [
			'namalengkap' => 'required|min:4',
			'email' => 'required|email',
			'password' => 'required|min:8',
		]);

		$user = User::create([
			'namalengkap' => $request->namalengkap,
			'email' => $request->email,
			'password' => bcrypt($request->password)
		]);

		$token = $user->createToken('Laravel8PassportAuth')->accessToken;

		return response()->json(['user' => $user, 'token' => $token], 200);
	}

	/**
	 * Login Req
	 */
	public function login(Request $request)
	{
		$data = [
			'email' => $request->email,
			'password' => $request->password
		];

		if (auth()->attempt($data)) {
			$token = auth()->user()->createToken('Laravel8PassportAuth')->accessToken;
			return response()->json(['user' => $data, 'token' => $token], 200);
		} else {
			return response()->json(['error' => 'Unauthorised'], 401);
		}
	}

	public function userInfo()
	{

		$user = auth()->user();

		return response()->json(['user' => $user], 200);
	}

	public function logout(Request $request)
	{
		$request->user()->token()->revoke();
		return response()->json(['message' => 'LogedOut'], 200);
	}
}

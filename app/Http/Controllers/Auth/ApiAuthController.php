<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\User;

class ApiAuthController extends Controller
{
    public function register (Request $request) {

	    $validator = Validator::make($request->all(), [
	        'name' => 'required|string|max:255',
	        'email' => 'required|string|email|max:255|unique:users',
	        'password' => 'required|string|min:6|confirmed',
	    ]);

	    if ($validator->fails())
	    {
	        return response()->json(['errors' => $validator->errors()->all()], 422);
	    }

	    $data = $request->all();

	    $data['password'] = Hash::make($data['password']);
	    $data['remember_token'] = Str::random(10);

	    $user = User::create($data);
	    $token = $user->createToken('Laravel Password Grant Client')->accessToken;
	    $response = ['token' => $token];

	    return response()->json($response, 200);
	}

	public function login (Request $request) {

	    $validator = Validator::make($request->all(), [
	        'email' => 'required|string|email|max:255',
	        'password' => 'required|string|min:6',
	    ]);

	    if ($validator->fails())
	    {
	        return response()->json(['errors' => $validator->errors()->all()], 400);
	    }

	    $user = User::where('email', $request->email)->first();
	    if ($user) {
	        if (Hash::check($request->password, $user->password)) {
	            $token = $user->createToken('App Password Grant Client')->accessToken;
	            $response = ['token' => $token];
	            return response()->json($response, 200);
	        } else {
	            $response = ["message" => "Password mismatch"];
	            return response()->json($response, 422);
	        }
	    } else {
	        $response = ["message" =>'User does not exist'];
	        return response()->json($response, 422);
	    }
	}

	public function logout (Request $request) {
	    $token = request()->user()->token();
	    $token->revoke();
	    $response = ['message' => 'You have been successfully logged out!'];
	    return response()->json($response, 200);
	}
}

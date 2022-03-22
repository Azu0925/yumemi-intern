<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Dotenv\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function register($request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:256|unique:users',
            'password' => 'required|string|confirmed|min:6'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request -> password)]
        ));
        return response()->json([
            'user' => $user
        ], 201);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);
        if(!$token = auth()->attempt($credentials)){
            return response()->json(['error' => 'Unauthorized Error'], 401);
        }
        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()-> json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    
    protected function respondWithToken($token)
    {
        return response()->json([
            'accessToken' => $token,
            'tokenType' => 'bearer',
            'expiresIn' => auth()->factory()->getTTL() * 60
        ]);
    }
}

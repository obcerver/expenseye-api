<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request) {

        $user = User::create($request->all());

        $token = $user->createToken($request->name);
        
        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function login(LoginUserRequest $request) {
        $user = User::where('email', $request->email)->first();

        if(!Hash::check($request->password, $user->password)) {
            return ['message' => 'Invalid Credential'];
        }

        $token = $user->createToken($user->name);
        
        return [
            'user' => new UserResource($user),
            'token' => $token->plainTextToken
        ];

    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();

        return ['message' => 'User Logged Out'];
    }
}

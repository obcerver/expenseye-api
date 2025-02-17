<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function check(Request $request)
    {
        // 1. Check if the cookie exists:
        if ($request->hasCookie('token')) {  // Or Cookie::has('your_cookie_name')

            // 2. Get the token from the cookie:
            $token = $request->cookie('token'); // Or Cookie::get('your_cookie_name')

            // Optional: You might want to do some basic validation here, like checking if the token is not empty:
            if (!empty($token)) {
                return response()->json(['isLoggedIn' => true]); // Or just true
            } else {
                return response()->json(['isLoggedIn' => false]);
            }
        } else {
            return response()->json(['isLoggedIn' => false]);
        }
    }

    public function register(StoreUserRequest $request)
    {

        $user = User::create($request->all());

        $token = $user->createToken($request->name);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function login(LoginUserRequest $request)
    {
        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists and the password is correct
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Create a Sanctum token for the user
        $token = $user->createToken($user->name)->plainTextToken;

        // Return the user and token
        return response()->json([
            'user' => new UserResource($user),
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        // Revoke the current user's token
        $request->user()->tokens()->delete();

        // Return a success response
        return response()->json(['message' => 'Logged out successfully']);
    }
}

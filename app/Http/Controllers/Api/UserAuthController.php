<?php

namespace App\Http\Controllers\Api;

use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $registerUserData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|min:8'
            ]);

            $user = User::create([
                'name' => $registerUserData['name'],
                'email' => $registerUserData['email'],
                'password' => Hash::make($registerUserData['password']),
            ]);

            $user->assignRole('user');

            return response()->json([
                "status" => "success",
                'message' => 'User Created',
                'data' => $user,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "status" => "error",
                'message' => 'User registration failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $loginUserData = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|min:8'
            ]);

            $user = User::where('email', $loginUserData['email'])->first();

            if (!$user || !Hash::check($loginUserData['password'], $user->password)) {
                return response()->json([
                    'message' => 'Invalid Credentials'
                ], 401);
            }

            $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;

            return response()->json([
                "status" => "success",
                'data' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                "status" => "error",
                'message' => 'Login failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function logout()
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->tokens()->delete();

        return response()->json([
            "status" => "success",
            "message" => "logged out"
        ]);
    }
}

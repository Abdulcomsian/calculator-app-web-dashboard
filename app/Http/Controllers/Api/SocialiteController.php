<?php

namespace App\Http\Controllers\Api;

use App\User;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        $redirectUrl = Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
        return response()->json(['url' => $redirectUrl]);
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                $user->update([
                    'name' => $googleUser->name,
                ]);
            } else {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make(uniqid()),
                ]);
                $user->assignRole('user');
            }

            Auth::login($user, true);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'User logged in successfully',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to login with Google',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}


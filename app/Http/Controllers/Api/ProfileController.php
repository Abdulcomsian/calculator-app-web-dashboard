<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function profile()
    {
        try {
            $user = User::findOrFail(Auth::user()->id);

            $user->photo_url = $user->profile_picture ? url($user->profile_picture) : null;

            return response()->json([
                "status" => "success",
                "message" => "User get successfully!",
                'data' => $user,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'password' => 'sometimes|required|string|min:8',
                'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                ], 422);
            }

            $user = User::find(Auth::user()->id);

            $user->name = $request->input('name');

            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }

            if ($request->hasFile('profile_picture')) {
                if ($user->profile_picture && File::exists(public_path($user->profile_picture))) {
                    File::delete(public_path($user->profile_picture));
                }

                $directory = 'profile_pictures';

                $directoryPath = public_path($directory);
                if (!File::exists($directoryPath)) {
                    File::makeDirectory($directoryPath, 0755, true);
                }

                $file = $request->file('profile_picture');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->move($directoryPath, $fileName);
                $user->profile_picture = $directory . '/' . $fileName;
            }

            $user->save();

            $user->profile_picture_url = $user->profile_picture ? url($user->profile_picture) : null;

            return response()->json([
                "status" => "success",
                'message' => 'Profile updated successfully!',
                'user' => $user,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                'message' => 'An error occurred while updating the profile.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}

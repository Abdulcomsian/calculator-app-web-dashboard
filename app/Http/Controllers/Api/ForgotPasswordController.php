<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function sendResetCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_or_phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $input = $request->email_or_phone;

        // $user = User::where('email', $input)->orWhere('phone', $input)->first();
        $user = User::where('email', $input)->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        $resetCode = mt_rand(1000, 9999);
        $user->password_reset_code = $resetCode;
        $user->save();

        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            Mail::to($user->email)->send(new ResetPasswordMail($resetCode));
        } else {
            // Send SMS (implement your SMS sending logic here)
            // Example: SmsService::send($user->phone, "Your reset code is $resetCode");
        }

        return response()->json([
            "status" => "success",
            'message' => 'Reset code sent successfully',
            'Code' => $resetCode,
            'email' => $input
        ], 200);
    }

    public function verifyResetCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_or_phone' => 'required',
            'reset_code' => 'required|numeric|digits:4',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $input = $request->email_or_phone;
        $resetCode = $request->reset_code;

        // $user = User::where('email', $input)->orWhere('phone', $input)
        //             ->where('password_reset_code', $resetCode)->first();
        $user = User::where('email', $input)
                    ->where('password_reset_code', $resetCode)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Invalid reset code or user not found',
            ], 404);
        }

        return response()->json([
            "status" => "success",
            'message' => 'Reset code verified successfully',
            'user_id' => $user->id,
        ], 200);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::find($request->user_id);

        $user->password = Hash::make($request->new_password);
        $user->password_reset_code = null;
        $user->save();

        return response()->json([
            "status" => "success",
            'message' => 'Password reset successfully',
        ], 200);
    }
}

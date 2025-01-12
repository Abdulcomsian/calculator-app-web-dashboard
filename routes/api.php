<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Api\SocialiteController;
use App\Http\Controllers\Api\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[UserAuthController::class,'register']);
Route::post('login',[UserAuthController::class,'login']);
Route::post('password/forgot', [ForgotPasswordController::class, 'sendResetCode']);
Route::post('password/verify-reset-code', [ForgotPasswordController::class, 'verifyResetCode']);
Route::post('password/reset', [ForgotPasswordController::class, 'resetPassword']);

Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle']);

Route::middleware('auth:sanctum')->group(function () {
  Route::post('logout', [UserAuthController::class, 'logout']);

  // Categories
  Route::get('get-categories', [CategoryController::class,'index']);
});

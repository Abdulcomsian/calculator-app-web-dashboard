<?php

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use GuzzleHttp\Exception\RequestException;
use App\Http\Controllers\Api\MapController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Api\SocialiteController;
use App\Http\Controllers\Api\SubscriptionController;
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

Route::post('register', [UserAuthController::class, 'register']);
Route::post('login', [UserAuthController::class, 'login']);
Route::post('password/forgot', [ForgotPasswordController::class, 'sendResetCode']);
Route::post('password/verify-reset-code', [ForgotPasswordController::class, 'verifyResetCode']);
Route::post('password/reset', [ForgotPasswordController::class, 'resetPassword']);

Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout', [UserAuthController::class, 'logout']);

    // Categories
    Route::get('get-categories', [CategoryController::class, 'index']);

    // Contact
    Route::get('get-contacts', [ContactController::class, 'getContact']);
    Route::post('store-contact', [ContactController::class, 'storeOrUpdateContact']);
    Route::delete('delete-contact/{id}', [ContactController::class, 'deleteContact']);

    // Profile
    Route::get('profile', [ProfileController::class, 'profile']);
    Route::post('update-profile', [ProfileController::class, 'updateProfile']);

    // Quotes
    Route::get('quotes', function () {
        try {
            $client = new Client();
            $quotes = [];

            for ($i = 0; $i < 3; $i++) {
                $response = $client->request('GET', 'https://zenquotes.io/api/random');
                $data = json_decode($response->getBody(), true);

                $quotes[] = [
                    'quote' => $data[0]['q'],
                    'author' => $data[0]['a']
                ];
            }

            return response()->json([
                'status' => 'success',
                'quotes' => $quotes
            ], 200);

        } catch (RequestException $e) {
            return response()->json([
                'status'=> 'error',
                'error' => 'An error occurred while fetching the quotes.',
                'message' => $e->getMessage()
            ], 500);
        }
    });

    // Task
    Route::post('get-task', [TaskController::class, 'getTask']);
    Route::post('store-task', [TaskController::class, 'storeOrUpdateTask']);
    Route::delete('delete-task/{id}', [TaskController::class, 'deleteTask']);

    // Subscription
    Route::post('create-payment-intent', [SubscriptionController::class, 'createPaymentIntent']);

    // Map
    // Route::post('get-route', [MapController::class, 'getRoute']);
});

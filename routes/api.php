<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\Api\V1\Controllers\SubscribeController;
use App\Http\Controllers\Api\V1\Controllers\TestController;
use App\Http\Controllers\Api\V1\Controllers\SubscriptionController;
use App\Http\Controllers\Api\V1\Controllers\ChannelController;
use App\Http\Controllers\Api\V1\Controllers\MessageController;  

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::match(['get', 'post'], 'botman', [SubscribeController::class, 'handle1']);
// // Use Route::post for creating a new subscription
Route::post('/subscribe', [SubscriptionController::class, 'subscribe']);

// Other routes remain unchanged
Route::post('/v1/subscribe', [SubscribeController::class, 'subscribe'])->name('api.subscribe');
Route::post('handle', [SubscribeController::class, 'handle'])->name('api.handle');


Route::post('/subscription', [SubscribeController::class, 'subscription']);


Route::post('/subscribeToChannel', [ChannelController::class, 'subscribeToChannel']);


Route::post('/send-message', [MessageController::class, 'sendMessage']);




Route::post('/test', [TestController::class, 'test']);


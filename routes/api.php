<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContactInquiryController;
use App\Http\Controllers\Api\PublicContentController;
use App\Http\Controllers\Api\SessionBookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::get('/services', [PublicContentController::class, 'services']);
Route::get('/posts', [PublicContentController::class, 'posts']);
Route::get('/posts/{slug}', [PublicContentController::class, 'post']);

Route::post('/contact', [ContactInquiryController::class, 'store']);
Route::post('/session-bookings', [SessionBookingController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
});

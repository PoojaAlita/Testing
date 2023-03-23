<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{AuthController, ForgotPasswordController};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


//Route Of Login
Route::post('login', [AuthController::class, 'login']);
Route::post('registration', [AuthController::class, 'registration']);
//Route Of Forgot Password
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'resetPassword']);
Route::post('forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
Route::get('unAuthnticated', [AuthController::class, 'unAuthnticated'])->name('unAuthnticated');
//Route Of Reset Password
Route::group(['middleware' => 'auth:api'], function () {
    //Route Of User Add
    Route::post('/store', [AuthController::class, 'store']);
    //Route Of User Edit
    Route::put('/edit/{id}', [AuthController::class, 'edit']);
    //Route Of User Listing
    Route::post('/listing', [AuthController::class, 'listing']);
    //Route Of User Delete
    Route::delete('/delete/{id}', [AuthController::class, 'delete']);
    //Route Of User Logout
    Route::post('logout', [AuthController::class, 'logout']);
    //Route Of User Profile
    Route::get('/profile-update/{id}', [AuthController::class, 'profile_update']);
    //Route Of Change password
    Route::get('/change-password/{id}', [ForgotPasswordController::class, 'changePassword']);
});




/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

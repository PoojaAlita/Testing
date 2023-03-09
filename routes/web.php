<?php

use App\Http\Controllers\{ProfileController};
use App\Http\Controllers\Auth\{RegisteredUserController, PasswordController};

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*Email Validate Route*/
Route::post('/validate-email', [RegisteredUserController::class, 'validate_email']);

/*Profile Route*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('email-validate', [ProfileController::class, 'validate_email']);
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('current-password-validate', [PasswordController::class, 'current_password_validate']);
    Route::post('password-validate', [PasswordController::class, 'password_validate']);
    Route::post('password-confirmation-validate', [PasswordController::class, 'password_confirmation_validate']);
});

require __DIR__ . '/auth.php';

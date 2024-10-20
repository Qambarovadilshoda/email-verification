<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthMiddleware;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'registerForm'])->name('registerForm')->middleware('checkLogout');
Route::post('/register', [AuthController::class, 'handleRegister'])->name('handleRegister');
Route::get('/login', [AuthController::class, 'loginForm'])->name('loginForm')->middleware('checkLogout')->middleware('emailVerified');
Route::post('/login', [AuthController::class, 'handleLogin'])->name('handleLogin');
Route::get('/edit', [AuthController::class, 'editProfile'])->name('edit')->middleware('auth');
Route::put('/update/{id}', [AuthController::class, 'updateProfile'])->name('update');
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/verify-notice', function(){
    return view('auth.verification-notice');
})->name('verify-notice');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth')->middleware('emailVerified');
Route::get('/verify', function(){
    return view('email.verify');
})->name('verifyForm');
Route::post('/handleVerify', [AuthController::class,'handleVerify'])->name('handleVerify');

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'))->name('home');

// auth
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('register.show');
    Route::get('/login', 'showLogin')->name('login.show');
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
});

Route::get('/profile', [AuthController::class, 'Dashboard'])->name('profile.edit');

// Route::resource('bookings', BookingController::class);
// Route::resource('cancellation-refunds', CancellationRefundController::class);
// Route::resource('locations', LocationController::class);
// Route::resource('reviews', ReviewController::class);
// Route::resource('users', UserController::class);
Route::resource('payments', PaymentController::class);
Route::resource('products', ProductController::class);

<?php

use App\Http\Controllers\AdminSessionController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\EnsureIsAdmin;
use App\Http\Middleware\EnsureIsCustomer;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $service_list = Service::all();
    $services = Service::latest()->take(6)->get();

    return view('users.home', ['services' => $services, 'service_list' => $service_list]);
});

Route::get('/services', function () {
    $services = Service::all();

    return view('users.services', ['services' => $services]);
});


// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
    Route::get('/register', [RegisterUserController::class, 'create']);
    Route::post('/register', [RegisterUserController::class, 'store']);

    Route::get('/admin', [AdminSessionController::class, 'create']);
    Route::post('/admin', [AdminSessionController::class, 'store']);
});


// User
Route::middleware(['auth', EnsureIsCustomer::class])->group(function () {
    Route::get('/profile', [SessionController::class, 'show']);
    Route::patch('/profile', [SessionController::class, 'update']);
    Route::delete('/profile', [SessionController::class, 'delete']);
    Route::post('/logout', [SessionController::class, 'destroy']);
    
    Route::post('/booking', [BookingController::class, 'booking']);
});


// Admin
Route::middleware(EnsureIsAdmin::class)->group(function () {
    Route::get('/admin/dashboard', [AdminSessionController::class, 'home']);
    Route::get('/admin/profile', [AdminSessionController::class, 'show']);
    Route::patch('/admin/profile', [AdminSessionController::class, 'update']);
    Route::delete('/admin/profile', [AdminSessionController::class, 'delete']);

    Route::resource('/admin/users', UserController::class);
    Route::resource('/admin/services', ServiceController::class);
    Route::resource('/admin/bookings', BookingController::class)->except('booking');
    Route::resource('/admin/transactions', TransactionController::class);

    Route::post('/admin/logout', [AdminSessionController::class, 'destroy']);
});
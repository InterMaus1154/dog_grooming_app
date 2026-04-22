<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailController;


Route::group(['prefix' => 'email', 'controller' => EmailController::class], function () {
    Route::get('verify', 'unverified')->name('verification.notice');
    Route::post('verification-notification', 'resendNotification')->middleware(['auth', 'throttle:5,1'])->name('verification.send');
    Route::get('verify/{id}/{hash}', 'verifyEmail')->middleware('signed')->name('verification.verify');
});

Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function () {
    Route::get('/login', 'showLogin')->name('auth.login.show');
    Route::post('/login', 'login')->name('auth.login');
});

Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::get('/', [DashboardController::class, 'showDashboard'])->name('dashboard');

});

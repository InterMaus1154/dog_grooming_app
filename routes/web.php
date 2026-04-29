<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\DogBreedController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\CustomerController;

Route::group(['prefix' => 'email', 'controller' => EmailController::class], function () {
    Route::get('verify', 'unverified')->name('verification.notice');
    Route::post('verification-notification', 'resendNotification')->middleware(['auth', 'throttle:5,1'])->name('verification.send');
    Route::get('verify/{id}/{hash}', 'verifyEmail')->middleware('signed')->name('verification.verify');
});

Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function () {
    Route::get('/login', 'showLogin')->name('auth.login.show');
    Route::post('/login', 'login')->name('auth.login');

    Route::middleware('auth')->post('/logout', 'logout')->name('auth.logout');
});


Route::group(['middleware' => ['auth']], function () {

    Route::get('/', [DashboardController::class, 'showDashboard'])->name('dashboard');

    Route::group(['prefix' => 'breeds', 'controller' => DogBreedController::class], function () {
        Route::get('/', 'index')->name('breeds.index');
    });

    Route::group(['prefix' => 'customers', 'controller' => CustomerController::class], function(){
       Route::get('/', 'index')->name('customers.index');
    });

    Route::group(['prefix' => 'logs', 'controller' => LogController::class], function(){
       Route::get('/', 'index')->name('logs.index');
    });

});

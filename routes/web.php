<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\AuthController;

Route::get('/email/verify', function () {
    return 'Please verify your email!';
})->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {

    $user = User::findOrFail($request->route('id'));

    Auth::login($user);
    $request->fulfill();

    return redirect('/after-verification');
})->middleware(['signed'])->name('verification.verify');

Route::post('/email/verification-notification', function () {
    request()->user()->sendEmailVerificationNotification();

    return back();
})->middleware(['auth'])->name('verification.send');

Route::get('/after-verification', function () {
    return view('after-verification');
})->middleware('auth');


Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function(){
   Route::get('/login', 'showLogin')->name('auth.login.show');
   Route::post('/login', 'login')->name('auth.login');
});

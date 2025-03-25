<?php

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;


Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', 'logout');

    Route::post('forgot_password', 'forgotPassword'); //added for ec; goes to registerController forgotPassword route
    Route::post('password_reset', 'passwordReset');

});


//I think this looks good below here
Route::middleware('auth:sanctum')->group( function () {
    Route::controller(UserController::class)->group(function(){
        Route::get('user', 'getUser');
        Route::post('user/upload_avatar', 'uploadAvatar');
        Route::delete('user/remove_avatar','removeAvatar');
        // Route::post('user/send_verification_email','sendVerificationEmail');
        // Route::post('user/change_email', 'changeEmail');
    });
});
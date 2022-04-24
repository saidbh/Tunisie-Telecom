<?php

use App\Http\Controllers\Auth\LoginController;
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
Route::group(['middleware'=>'guest'],function(){

    Route::group(['prefix'=>'login'],function(){
        Route::get('/', [AuthenticationController::class, 'loginView'])->name('login');
        Route::post('/', [AuthenticationController::class, 'login'])->name('login');
    });

    Route::group(['prefix'=>'registration'],function(){
        Route::get('/', [AuthenticationController::class, 'registrationView'])->name('registration');
        Route::post('/', [AuthenticationController::class, 'registration'])->name('registration');
    });

    Route::group(['prefix'=>'recover'],function(){
        Route::get('/', [AuthenticationController::class, 'recoverPasswordView'])->name('recover');
        Route::post('/', [AuthenticationController::class, 'recoverPassword'])->name('recover');
    });
});

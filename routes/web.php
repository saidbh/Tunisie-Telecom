<?php
namespace  App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware'=>'guest'],function(){
    Route::get('/', function () {
        return redirect()->route('login');
    });
    Route::group(['prefix'=>'login'],function(){
        Route::get('/', [AuthController::class, 'loginView'])->name('login');
        Route::post('/', [AuthController::class, 'login'])->name('login');
    });

    Route::group(['prefix'=>'registration'],function(){
        Route::get('/', [AuthController::class, 'registrationView'])->name('registration');
        Route::post('/', [AuthController::class, 'registration'])->name('registration');
    });

    Route::group(['prefix'=>'recover'],function(){
        Route::get('/', [AuthController::class, 'recoverPasswordView'])->name('recover');
        Route::post('/', [AuthController::class, 'recoverPassword'])->name('recover');
    });
});

include 'admin-routes.php';
include 'users-routes.php';

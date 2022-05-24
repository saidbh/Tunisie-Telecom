<?php
namespace  App\Http\Controllers;

use App\Http\Controllers\Admin\depcom\OffresController;
use App\Http\Controllers\Admin\depcom\RealisationController;
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

Route::group(['middleware'=>['auth:web','routes', 'Role:admin'],'except'=>'logout', 'prefix' => 'admin'],function(){
    Route::get('logout',function(){
        Session::flush();
        Auth::logout();
        return redirect('login');
    })->name('admin.logout');
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::group(['prefix'=>'users','name'=>'users'],function(){

        Route::resource('users-accounts', Admin\Accounts\AccountsController::class)->names([
            'index' => 'users-accounts.list',
            'create' => 'users-accounts.create',
            'store' => 'users-accounts.store',
            'edit' => 'users-accounts.edit',
            'update' => 'users-accounts.update',
            'destroy' => 'users-accounts.destroy'
        ]);

    });

    Route::group(['prefix'=>'system','name'=>'system'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('system');

        Route::resource('role-permission', Admin\System\RolePermissionController::class)->names([
            'index' => 'system-role-permission',
            'create' => 'system-role-permission.create',
            'store' => 'system-role-permission.store',
            'edit' => 'system-role-permission.edit',
            'update' => 'system-role-permission.update',
            'destroy' => 'system-role-permission.destroy'
        ]);

        Route::resource('assign-role', Admin\System\AssignRoleController::class)->names([
            'index' => 'system-assign-role',
            'create' => 'system-assign-role.create',
            'store' => 'system-assign-role.store',
            'edit' => 'system-assign-role.edit',
            'update' => 'system-assign-role.update',
            'destroy' => 'system-assign-role.destroy',
        ]);

        Route::resource('dictionary', Admin\System\DictionaryController::class)->names([
            'index'=>'system-dictionary',
            'create' => 'system-dictionary.create',
            'store' => 'system-dictionary.store',
            'edit' => 'system-dictionary.edit',
            'update' => 'system-dictionary.update',
            'destroy' => 'system-dictionary.destroy',
        ]);
    });

    Route::group(['prefix'=>'Overview','name'=>'overview'],function(){
        Route::post('/statics/offres', [Admin\Deptech\OverviewController::class, 'getStaticsObjectifs'])->name('stat-offres');
        Route::resource('deptech-Overview', Admin\Deptech\OverviewController::class)->names([
            'index' => 'technical-global-view',
            'create' => 'technical-global-view.create',
            'store' => 'technical-global-view.store',
            'edit' => 'technical-global-view.edit',
            'show' => 'technical-global-view.show',
            'update' => 'technical-global-view.update',
            'destroy' => 'technical-global-view.destroy'
        ]);
    });

    Route::group(['prefix'=>'offres-list','name'=>'offres-list'],function(){

        Route::resource('deptech-offres', Admin\Deptech\OffresController::class)->names([
            'index' => 'technical-offres-list',
            'create' => 'technical-offres-list.create',
            'store' => 'technical-offres-list.store',
            'edit' => 'technical-offres-list.edit',
            'update' => 'technical-offres-list.update',
            'destroy' => 'technical-offres-list.destroy'
        ]);

        Route::resource('realisation-offres', Admin\Deptech\RealisationController::class)->names([
            'index' => 'realisation-offres-list',
            'create' => 'realisation-offres-list.create',
            'store' => 'realisation-offres-list.store',
            'show' => 'realisation-offres-list.show',
            'edit' => 'realisation-offres-list.edit',
            'update' => 'realisation-offres-list.update',
            'destroy' => 'realisation-offres-list.destroy'
        ]);
    });

    Route::group(['prefix'=>'follow-quality','name'=>'follow-quality'],function(){
        Route::resource('ADSL', Admin\Deptech\OffresController::class)->names([
            'index' => 'offres-list',
            'create' => 'offres-list.create',
            'store' => 'offres-list.store',
            'edit' => 'offres-list.edit',
            'update' => 'offres-list.update',
            'destroy' => 'offres-list.destroy'
        ]);

        Route::resource('Fixes', Admin\Deptech\OffresController::class)->names([
            'index' => 'fixes-list',
            'create' => 'fixes-list.create',
            'store' => 'fixes-list.store',
            'edit' => 'fixes-list.edit',
            'update' => 'fixes-list.update',
            'destroy' => 'fixes-list.destroy'
        ]);
    });

    Route::group(['prefix'=>'Commercial','name'=>'OverView-Commercial'],function(){
        Route::resource('Overview', Admin\depcom\OverviewController::class)->names([
            'index' => 'commercial-global-view',
            'create' => 'commercial-global-view.create',
            'store' => 'commercial-global-view.store',
            'edit' => 'commercial-global-view.edit',
            'show' => 'commercial-global-view.show',
            'update' => 'commercial-global-view.update',
            'destroy' => 'commercial-global-view.destroy'
        ]);
    });

    Route::group(['prefix'=>'offres-list','name'=>'offres-list'],function(){

        Route::resource('offres', Admin\depcom\OffresController::class)->names([
            'index' => 'commercial-offres-list',
            'create' => 'commercial-offres-list.create',
            'store' => 'commercial-offres-list.store',
            'edit' => 'commercial-offres-list.edit',
            'update' => 'commercial-offres-list.update',
            'destroy' => 'commercial-offres-list.destroy'
        ]);

        Route::resource('realisation-offres-commercial', Admin\depcom\RealisationController::class)->names([
            'index' => 'realisation-commercial-list',
            'create' => 'realisation-commercial.create',
            'store' => 'realisation-commercial.store',
            'show' => 'realisation-commercial.show',
            'edit' => 'realisation-commercial.edit',
            'update' => 'realisation-commercial.update',
            'destroy' => 'realisation-commercial.destroy'
        ]);
    });

});

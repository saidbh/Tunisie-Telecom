<?php

namespace  App\Http\Controllers;
namespace  App\Http\Controllers\Admin;
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
Route::group(['middleware'=>['auth:web','routes', 'Role:admin'],'except'=>'logout', 'prefix' => 'admin'],function(){
    Route::get('logout',function(){
        Session::flush();
        Auth::logout();
        return redirect('login');
    })->name('admin.logout');
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::group(['prefix'=>'users','name'=>'users'],function(){

        Route::resource('users-accounts', Accounts\AccountsController::class)->names([
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

        Route::resource('role-permission', System\RolePermissionController::class)->names([
            'index' => 'system-role-permission',
            'create' => 'system-role-permission.create',
            'store' => 'system-role-permission.store',
            'edit' => 'system-role-permission.edit',
            'update' => 'system-role-permission.update',
            'destroy' => 'system-role-permission.destroy'
        ]);

        Route::resource('assign-role', System\AssignRoleController::class)->names([
            'index' => 'system-assign-role',
            'create' => 'system-assign-role.create',
            'store' => 'system-assign-role.store',
            'edit' => 'system-assign-role.edit',
            'update' => 'system-assign-role.update',
            'destroy' => 'system-assign-role.destroy',
        ]);

        Route::resource('dictionary', System\DictionaryController::class)->names([
            'index'=>'system-dictionary',
            'create' => 'system-dictionary.create',
            'store' => 'system-dictionary.store',
            'edit' => 'system-dictionary.edit',
            'update' => 'system-dictionary.update',
            'destroy' => 'system-dictionary.destroy',
        ]);
    });

    Route::group(['prefix'=>'Overview','name'=>'overview'],function(){

        Route::resource('deptech-Overview', Deptech\OverviewController::class)->names([
            'index' => 'technical-global-view',
            'create' => 'technical-global-view.create',
            'store' => 'technical-global-view.store',
            'edit' => 'technical-global-view.edit',
            'update' => 'technical-global-view.update',
            'destroy' => 'technical-global-view.destroy'
        ]);
    });

    Route::group(['prefix'=>'offres-list','name'=>'offres-list'],function(){

        Route::resource('deptech-offres', Deptech\OffresController::class)->names([
            'index' => 'technical-offres-list',
            'create' => 'technical-offres-list.create',
            'store' => 'technical-offres-list.store',
            'edit' => 'technical-offres-list.edit',
            'update' => 'technical-offres-list.update',
            'destroy' => 'technical-offres-list.destroy'
        ]);

        Route::resource('realisation-offres', Deptech\RealisationController::class)->names([
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
        Route::resource('ADSL', Deptech\OffresController::class)->names([
            'index' => 'offres-list',
            'create' => 'offres-list.create',
            'store' => 'offres-list.store',
            'edit' => 'offres-list.edit',
            'update' => 'offres-list.update',
            'destroy' => 'offres-list.destroy'
        ]);

        Route::resource('Fixes', Deptech\OffresController::class)->names([
            'index' => 'fixes-list',
            'create' => 'fixes-list.create',
            'store' => 'fixes-list.store',
            'edit' => 'fixes-list.edit',
            'update' => 'fixes-list.update',
            'destroy' => 'fixes-list.destroy'
        ]);
    });

    Route::group(['prefix'=>'commercial-global-view','name'=>'commercial-global-view'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('commercial-global-view');
    });

    Route::group(['prefix'=>'mobile-prepay-b-list','name'=>'mobile-prepay-b-list'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('mobile-prepay-b-list');
    });

    Route::group(['prefix'=>'mobile-prepay-n-list','name'=>'mobile-prepay-n-list'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('mobile-prepay-n-list');
    });

    Route::group(['prefix'=>'mobile-bills-list','name'=>'mobile-bills-list'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('mobile-bills-list');
    });

    Route::group(['prefix'=>'key-3g-list','name'=>'key-3g-list'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('key-3g-list');
    });

    Route::group(['prefix'=>'Netbox-list','name'=>'Netbox-list'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('Netbox-list');
    });

    Route::group(['prefix'=>'m2m-list','name'=>'m2m-list'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('m2m-list');
    });

    Route::group(['prefix'=>'wafi-offres-list','name'=>'wafi-offres-list'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('wafi-offres-list');
    });

    Route::group(['prefix'=>'Rapido-2020-list','name'=>'Rapido-2020-list'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('Rapido-2020-list');
    });

    Route::group(['prefix'=>'Autres-thd-list','name'=>'Autres-thd-list'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('Autres-thd-list');
    });

    Route::group(['prefix'=>'portability-prepay-list','name'=>'portability-prepay-list'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('portability-prepay-list');
    });

    Route::group(['prefix'=>'portability-prepay-bills-list','name'=>'portability-prepay-bills-list'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('portability-prepay-bills-list');
    });

});

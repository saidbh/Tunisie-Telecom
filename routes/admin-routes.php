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
    Route::group(['prefix'=>'adsl','name'=>'adsl'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('adsl');
    });
    Route::group(['prefix'=>'fixes','name'=>'fixes'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('fixes');
    });
    Route::group(['prefix'=>'fo-internet','name'=>'fo-internet'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('fo-internet');
    });
    Route::group(['prefix'=>'t-penetration','name'=>'t-penetration'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('t-penetration');
    });
    Route::group(['prefix'=>'mobile-prepaid-b','name'=>'mobile-prepaid-b'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('mobile-prepaid-b');
    });
    Route::group(['prefix'=>'mobile-prepaid-n','name'=>'mobile-prepaid-n'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('mobile-prepaid-n');
    });
    Route::group(['prefix'=>'mobile-bills','name'=>'mobile-bills'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('mobile-bills');
    });
    Route::group(['prefix'=>'3Gkey','name'=>'3Gkey'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('3Gkey');
    });
    Route::group(['prefix'=>'netbox','name'=>'netbox'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('netbox');
    });
    Route::group(['prefix'=>'m2m','name'=>'m2m'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('m2m');
    });
    Route::group(['prefix'=>'waffi','name'=>'waffi'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('waffi');
    });
    Route::group(['prefix'=>'rapido2020','name'=>'rapido2020'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('rapido2020');
    });
    Route::group(['prefix'=>'other-th','name'=>'other-th'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('other-th');
    });
    Route::group(['prefix'=>'portability-IN-prepaid','name'=>'portability-IN-prepaid'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('portability-IN-prepaid');
    });
    Route::group(['prefix'=>'portability-IN-mobile-bill','name'=>'portability-IN-mobile-bill'],function(){
        Route::get('/',function(){return redirect('admin.dashboard');})->name('portability-IN-mobile-bill');
    });
});

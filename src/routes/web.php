<?php

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

Route::group(['prefix' => 'yonetim/permission', 'namespace' => 'Modul\Permission\Http\Controllers','middleware' => ['web','auth']], function () {

    Route::match(['get', 'post'], '/', function () {
        return redirect(route('users.index'));
    });

    Route::resource('users', 'UserController');
    Route::post('users/delete','UserController@destroy');

    Route::resource('roles', 'RoleController');

    Route::resource('permissions', 'PermissionController');

    /*
        Route::get('/emre', function () {
           return view('permission::permission');
       });

   */

});

Route::get('/create_role_permission', function () {


    $role = Role::create(['name' => 'Admin']);
    $permission = Permission::create(['name' => 'Admin roles & permissions']);

    auth()->user()->assignRole('Admin');
    auth()->user()->givePermissionTo('Admin roles & permissions');

});



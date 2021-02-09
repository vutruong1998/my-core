<?php

namespace MyCore\Core;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Core
{
    public static function authRoutes()
    {
        Route::group([
            'namespace' => 'MyCore\Core\Http\Controllers',
        ], function () {
            Auth::routes([
                'register' => false
            ]);
        });
    }

    public static function routes()
    {
        Route::group([
            'namespace' => 'MyCore\Core\Http\Controllers'
        ], function () {
            Route::get('/', 'CoreController@index')->name('index');
            Route::resource('users', 'UserController')->except('show');
            Route::get('users/datatable', 'UserController@datatable')->name('users.datatable');
            Route::post('users/sortable', 'UserController@sortable')->name('users.sortable');
            Route::resource('roles', 'RoleController')->except('show');
            Route::get('roles/datatable', 'RoleController@datatable')->name('roles.datatable');
        });
    }
}

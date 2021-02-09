<?php

namespace MyCore\Menu;

use Illuminate\Support\Facades\Route;

class Menu
{
    public static function routes()
    {
        Route::group([
            "namespace" => "MyCore\Menu\Http\Controllers"
        ], function () {
            Route::resource('menus', 'MenuController')->except('show');
        });
    }
}

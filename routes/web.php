<?php

use Illuminate\Support\Facades\Route;
use MyCore\Core\Core;
use MyCore\Menu\Menu;

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

Core::authRoutes();
Route::group(
    [
        'middleware' => [
            'auth'
        ]
    ],
    function () {
        Core::routes();
        Menu::routes();
        Route::group(['prefix' => 'medias'], function () {
            \UniSharp\LaravelFilemanager\Lfm::routes();
        });
    }
);

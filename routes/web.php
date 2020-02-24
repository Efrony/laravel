<?php

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


Route::get('/', 'IndexController@home')->name('index');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');



Route::group([
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'as' => 'admin.',
    ], function () {
        Route::get('/', 'AdminIndexController@admin')->name('index');
        Route::get('/create', 'AdminNewsController@createNews')->name('create');
        Route::match(['post', 'get'], '/add', 'AdminNewsController@addNews')->name('add');
});


Route::group([
        'prefix' => 'news',
        'as' => 'news.',
    ], function () {
        Route::get('/', 'NewsController@allNews')->name('all');
        Route::get('/show/{id}', 'NewsController@oneNews')->name('one');
        Route::get('/categories/{category}', 'NewsController@showCategory')->name('category');
});

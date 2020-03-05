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
        'prefix' => 'admin/news',
        'namespace' => 'Admin',
        'as' => 'admin.news.',
        'middleware' => 'admin'
    ], function () {

        Route::get('/', 'AdminNewsController@all')->name('all');
        Route::match(['post', 'get'],'/create', 'AdminNewsController@create')->name('create');
        Route::get('/update/{news}', 'AdminNewsController@update')->name('update');
        Route::post('/save/{news}', 'AdminNewsController@save')->name('save');
        Route::get('/delete/{news}', 'AdminNewsController@delete')->name('delete');
});

Route::group([
    'prefix' => 'profile',
    'as' => 'profile.',
    'middleware' => 'auth',
], function () {
    Route::get('/edit', 'ProfileController@edit')->name('edit');
    Route::post('/update/{user}', 'ProfileController@update')->name('update');
});


Route::group([
        'prefix' => 'news',
        'as' => 'news.',
    ], function () {
        Route::get('/', 'NewsController@all')->name('all');
        Route::get('/show/{oneNews}', 'NewsController@one')->name('one');
        Route::get('/categories/{category}', 'NewsController@category')->name('category');
});

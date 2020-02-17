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
Route::get('/admin', 'Admin\IndexController@admin')->name('admin');


Route::group([
    'prefix' => 'news',
    'as' => 'news.',
], function () {
    Route::get('/', 'NewsController@allNews')->name('all');
    Route::get('/show/{id}', 'NewsController@oneNews')->name('one');
    Route::get('/add', 'NewsController@addNews')->name('add');
    Route::get('/categories/{category}', 'NewsController@showCategory')->name('category');
    //    Route::get('/categories', 'NewsController@categoriesNews')->name('categories');
});

//Route::get('/news', 'NewsController@allNews')->name('all');
//Route::get('/news/show/{id}', 'NewsController@oneNews')->name('one');
//Route::get('/news/categories', 'NewsController@categoriesNews')->name('categories');
//Route::get('/news/categories/{category}', 'NewsController@showCategory')->name('category');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

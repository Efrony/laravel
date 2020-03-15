<?php

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/auth/vk', 'LoginController@loginVK')->name('vkLogin');
Route::get('/auth/vk/response', 'LoginController@responseVK')->name('vkResponse');

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin.',
    'middleware' => 'admin'
], function () {
    Route::resource('news', 'AdminNewsController')->except('show');
    Route::resource('users', 'AdminUsersController')->except('show', 'create', 'store');
    Route::get('/parser', 'ParserController@index')->name('parser.index');
    Route::get('/parser/load', 'ParserController@load')->name('parser.load');

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

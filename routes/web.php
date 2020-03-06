<?php

Route::get('/', 'IndexController@home')->name('index');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin.',
    'middleware' => 'admin'
], function () {
    Route::resource('news', 'AdminNewsController')->except('show');
    Route::resource('users', 'AdminUsersController')->except('show', 'create', 'store');

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

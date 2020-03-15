<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('user-admin', function (Request $request) {
//    return response()->json(['status' => 'ok', 'id' => $request->id]);
//})->middleware('api');

Route::post('user-admin', 'Api\ApiAdminController@userToAdmin')->middleware('api');
Route::post('create-link', 'Api\ApiAdminController@createLink')->middleware('api');
Route::post('delete-link', 'Api\ApiAdminController@deleteLink')->middleware('api');

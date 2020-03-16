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
Route::post('create-resource', 'Api\ApiAdminController@createResource')->middleware('api');
Route::post('delete-resource', 'Api\ApiAdminController@deleteResource')->middleware('api');

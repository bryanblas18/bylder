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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

/*
Route::resource('images', 'ImagesController')
    ->only(['index', 'store', 'update', 'delete', 'restore']);
*/
Route::get('images', 'ImagesController@index');

Route::get('images/deleted', 'ImagesController@showDeleted');

Route::get('images/show/{id}', 'ImagesController@show')->where('id', '[0-9]+');

Route::delete('images/delete/{id}', 'ImagesController@delete')->where('id', '[0-9]+');

Route::put('images/restore/{id}', 'ImagesController@restore')->where('id', '[0-9]+');

Route::post('images', 'ImagesController@upload');

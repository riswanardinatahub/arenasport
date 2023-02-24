<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('register/check', 'Auth\RegisterController@check')->name('api-register-check');
Route::post('register', 'API\UserApiController@register');
Route::post('updateuser/{id}', 'API\UserApiController@update');

Route::get('provinces', 'API\LocationController@provinces')->name('api-provinces');
Route::get('regencies', 'API\LocationController@regencies')->name('api-regencies');
Route::get('districts/{regencies_id}', 'API\LocationController@districts')->name('api-districts');
Route::get('villages/{districts_id}', 'API\LocationController@villages')->name('api-villages');



Route::get('products', 'API\ProductController@getproduct')->name('getproduct');
Route::get('productvillage/{id}', 'API\ProductController@getproductvillage')->name('villageproduct');

Route::get('productterlaris', 'API\ProductController@productterlaris')->name('productterlaris');
Route::get('produkgalleri/{id}', 'API\ProductController@produkgalleri')->name('produkgalleri');






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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['api']], function() {

    // Product routes
    Route::apiResource('/products', 'ProductController');

    // Cart routes
    Route::get('/cart', 'CartController@index');
    Route::post('/cart', 'CartController@store');
    Route::delete('/cart/{id}', 'CartController@destroy');

    // Saveforlater routes
    Route::get('/saveforlater', 'SaveForLaterController@index');
    Route::post('/saveforlater', 'SaveForLaterController@store');
    Route::delete('/saveforlater/{id}', 'SaveForLaterController@destroy');

    // Login routes
    Route::post('register', 'Auth\AuthController@register');
    Route::post('login', 'Auth\AuthController@login');
    Route::post('logout', 'Auth\AuthController@logout');

});

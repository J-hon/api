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

Route::group(['middleware' => ['api']], function() {

    Route::prefix('v1')->group(function () {

        // Product routes
        Route::apiResource('/products', 'ProductController');

        // Review routes
        Route::get('products/{product}/reviews', 'ReviewController@index');
        Route::post('products/{product}/reviews', 'ReviewController@store');

        // Cart routes
        Route::get('/cart', 'CartController@index');
        Route::post('/cart', 'CartController@store');
        Route::delete('/cart/{id}', 'CartController@destroy');

        // Saveforlater routes
        Route::get('/saveforlater', 'SaveForLaterController@index');
        Route::post('/saveforlater', 'SaveForLaterController@store');
        Route::delete('/saveforlater/{id}', 'SaveForLaterController@destroy');

        // Category routes
        Route::get('/categories', 'CategoryController@index');
        Route::get('/category/{id}', 'CategoryController@show');

        // Login routes
        Route::post('register', 'Auth\AuthController@register');
        Route::post('login', 'Auth\AuthController@login');
        Route::post('logout', 'Auth\AuthController@logout');

        // Search route
        Route::get('/{query}', 'SearchController@search');

    });

});

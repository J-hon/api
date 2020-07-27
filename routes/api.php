<?php

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
        Route::get('cart', 'CartController@index');
        Route::post('cart', 'CartController@store');
        Route::delete('cart/{id}', 'CartController@destroy');

        // Saveforlater routes
        Route::get('saveforlater', 'SaveForLaterController@index');
        Route::post('saveforlater', 'SaveForLaterController@store');
        Route::delete('saveforlater/{id}', 'SaveForLaterController@destroy');

        // Category routes
        Route::get('categories', 'CategoryController@index');
        Route::get('category/{id}', 'CategoryController@show');

        // Auth routes
        Route::post('register', 'Api\AuthController@register');
        Route::post('login', 'Api\AuthController@login');
        Route::post('logout', 'Api\AuthController@logout');

        Route::post('/password/email', 'Api\ForgotPasswordController@sendResetLinkEmail');
        Route::post('/password/reset', 'Api\ResetPasswordController@reset');

        Route::get('email/resend', 'Api\VerificationController@resend')->name('verification.resend');
        Route::get('email/verify/{id}/{hash}', 'Api\VerificationController@verify')->name('verification.verify');

        // Search route
        Route::get('search/{query}', 'SearchController@search');

    });

});

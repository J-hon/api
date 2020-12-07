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
Route::prefix('v1')->group(function () {
    // Product routes
    Route::get('products', 'ProductController@index');
    Route::post('product', 'ProductController@store');

    // Review routes
    Route::get('products/{product}/reviews', 'ReviewController@index');
    Route::post('products/{product}/reviews', 'ReviewController@store');

    // Cart routes
    Route::get('cart', 'CartController@index');
    Route::post('cart', 'CartController@store');
    Route::delete('cart/{id}', 'CartController@destroy');

    // SaveForLater routes
    Route::get('save_for_later', 'SaveForLaterController@index');
    Route::post('save_for_later', 'SaveForLaterController@store');
    Route::delete('save_for_later/{id}', 'SaveForLaterController@destroy');

    // Category routes
    Route::get('categories', 'CategoryController@index');
    Route::get('category/{id}', 'CategoryController@show');

    Route::post('register', 'Auth\AuthController@register');
    Route::post('login', 'Auth\AuthController@login');
    Route::post('logout', 'Auth\AuthController@logout');

    Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

    Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
    Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');

    // Search route
    Route::get('search/{query}', 'SearchController@search');

});

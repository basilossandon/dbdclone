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

// Redirect the user to the provider authentication page
Route::get('auth/{provider}', [
    'as' => 'provider.login',
    'uses' => 'Auth\LoginController@redirectToProvider'
]);

// Get the user information from provider
Route::get('auth/{provider}/callback', [
    'as' => 'provider.callback',
    'uses' => 'Auth\LoginController@handleProviderCallback'
]);

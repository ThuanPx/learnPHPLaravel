<?php

use App\Http\Middleware\CheckAdmin;
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


Route::prefix('user')->group(function () {
    Route::get('{id}', 'User\UserController@getUser');

    Route::post('', 'User\UserController@createUser');

    Route::put('', 'User\UserController@updateUser');

    Route::delete('{id}', 'User\UserController@deleteUser');
});

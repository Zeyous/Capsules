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

Route::post('register', 'API\RegisterController@register');
Route::post('login', 'API\RegisterController@login');
Route::post('logout','API\RegisterController@logout')->middleware('auth:api');
Route::post('password/email', 'API\ForgotPasswordController@sendResetLinkEmail')->middleware('auth:api');
Route::post('password/reset', 'API\ResetPasswordController@reset')->middleware('auth:api');
Route::get('email/resend', 'API\VerificationController@resend')->name('verefication.resend');
Route::get('email/verefy/{id}/{hash}', 'API\VerificationController@verefy')->name('verefication.verefy');




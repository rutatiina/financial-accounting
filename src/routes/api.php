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

Route::middleware('auth:api')->get('/api/test', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api', 'tenant']], function() {

	Route::prefix('api/v1')->group(function () {

		Route::resource('accounts', 'Rutatiina\FinancialAccounting\Http\Controllers\Api\V1\AccountController', ['as' => 'api.v1']);
		Route::resource('transactions', 'Rutatiina\FinancialAccounting\Http\Controllers\Api\V1\TransactionController', ['as' => 'api.v1']);

	});



});


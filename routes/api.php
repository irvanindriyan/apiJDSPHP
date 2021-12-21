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

$router->group(['middleware' => ['only.json']], function () use ($router) {
    Route::post('/sign_up', [App\Http\Controllers\AuthController::class, 'register'])->name('sign_up');
    Route::post('/sign_in', [App\Http\Controllers\AuthController::class, 'login'])->name('sign_in');
});

$router->group(['middleware' => ['jwt.verify']], function () use ($router) {
	Route::get('/user', [App\Http\Controllers\AuthController::class, 'getUser'])->name('user');
	Route::get('/sign_out', [App\Http\Controllers\AuthController::class, 'logout'])->name('sign_out');

	Route::get('/data', [App\Http\Controllers\FetchController::class, 'getData'])->name('data');
	
	$router->group(['middleware' => ['role.auth']], function () use ($router) {
		Route::get('/data_order', [App\Http\Controllers\FetchController::class, 'getDataOrder'])->name('data_order');
	});
});
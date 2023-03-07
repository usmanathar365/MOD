<?php

use App\Http\Controllers\Admin\API\Brands;
use App\Http\Controllers\Admin\API\Clients;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);



Route::post('/brands', [Brands::class, 'create']);
Route::post('/clients', [Clients::class, 'create']);


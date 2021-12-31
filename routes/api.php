<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Salon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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

Route::post('/sanctum/token',  [App\Http\Controllers\UserController::class, 'login']);

Route::apiResource('/user',  App\Http\Controllers\UserController::class)->only('store');
Route::middleware('auth:sanctum')->put('/user/upgradetosalon', [ App\Http\Controllers\UserController::class,"upgradeToSalon"]);
Route::middleware('auth:sanctum')->apiResource('/salon',  App\Http\Controllers\SalonController::class)->only('store');
Route::middleware('auth:sanctum')->apiResource('/service',  App\Http\Controllers\ServiceController::class)->only('store');
Route::middleware('auth:sanctum')->apiResource('/barber',  App\Http\Controllers\BarberController::class)->only('store');
Route::middleware('auth:sanctum')->apiResource('/image',  App\Http\Controllers\ImageController::class)->only('store');

Route::middleware('auth:sanctum')->get('/user/revoke', function (Request $request) {
   $user=$request->user();
   $user->tokens()->delete();
    return "tokens are deleted";
});

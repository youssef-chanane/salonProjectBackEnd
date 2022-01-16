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
Route::put('/salon/addlike/{id}', [ App\Http\Controllers\SalonController::class,"addlike"]);
Route::put('/salon/deletelike/{id}', [ App\Http\Controllers\SalonController::class,"deletelike"]);
Route::post('/reserve', [ App\Http\Controllers\ReserveController::class,"store"]);
Route::get('/reserve/{id}', [ App\Http\Controllers\ReserveController::class,"show"]);
Route::delete('/reserve/{id}', [ App\Http\Controllers\ReserveController::class,"destroy"]);
Route::apiResource('/salon',  App\Http\Controllers\SalonController::class);
Route::apiResource('/service',  App\Http\Controllers\ServiceController::class)->only(['store','show']);
Route::apiResource('/barber',  App\Http\Controllers\BarberController::class);
Route::apiResource('/image',  App\Http\Controllers\ImageController::class)->only(['store','show']);

Route::middleware('auth:sanctum')->get('/user/revoke', function (Request $request) {
   $user=$request->user();
   $user->tokens()->delete();
    return "tokens are deleted";
});

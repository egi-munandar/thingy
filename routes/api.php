<?php

use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\Master\CurrencyController;
use App\Http\Controllers\Master\InstanceController;
use App\Http\Controllers\Master\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    $user = $request->user();
    $user->perms = $user->getPermissionNames();
    return $user;
});
Route::post('/login', [ApiAuthController::class, 'api_login']);
Route::post('/logout-app', [ApiAuthController::class, 'api_logout'])->middleware('auth:sanctum');
Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('location', LocationController::class);
    Route::resource('instance', InstanceController::class);
    Route::resource('currency', CurrencyController::class, ['except' => ['edit']]);
});
Route::get('/test', [InstanceController::class, 'index']);

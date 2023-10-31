<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes(['register' => env('REGISTER_ENABLE', false)]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::view('/{path?}', 'frontend')
    ->where('path', '.*')
    ->name('react')->middleware('auth');
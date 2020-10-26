<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'register'], function () {
    Route::get('add', [App\Http\Controllers\RegisterController::class, 'index']);
    Route::post('store', [App\Http\Controllers\RegisterController::class, 'store']);
});

Route::group(['prefix' => 'employe'], function () {
    Route::get('index', [App\Http\Controllers\EmployeController::class, 'index']);
    Route::get('search', [App\Http\Controllers\EmployeController::class, 'index']);
    Route::post('store', [App\Http\Controllers\EmployeController::class, 'store']);
});

Route::group(['prefix' => 'presensi'], function () {
    Route::get('index', [App\Http\Controllers\PresensiController::class, 'index']);
    Route::get('search', [App\Http\Controllers\PresensiController::class, 'index']);
});

Route::group(['prefix' => 'verification'], function () {
    Route::get('index', [App\Http\Controllers\VerificationController::class, 'index']);
    Route::get('search', [App\Http\Controllers\VerificationController::class, 'index']);
    Route::get('accept/{id}', [App\Http\Controllers\VerificationController::class, 'accept']);
    Route::get('reject/{id}', [App\Http\Controllers\VerificationController::class, 'reject']);
});

Route::group(['prefix' => 'fcm'], function () {
    Route::post('register-token', [App\Http\Controllers\NotificationController::class, 'register']);
});

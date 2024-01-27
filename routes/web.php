<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [AuthController::class, 'login'])->name('login');

Route::post('login', [AuthController::class, 'AuthLogin']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('forgot-password', [AuthController::class, 'ForgotPassword']);
Route::post('forgot-password', [AuthController::class, 'PostForgotPassword']);
Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'PostReset']);

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {

    Route::get('/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('/operator', function(){
        return view('admin.operator');
    });

});

Route::group(['prefix' => 'operator', 'middleware' => ['auth', 'operator']], function() {

    Route::get('/dashboard', [DashboardController::class, 'dashboard']);

});

Route::group(['prefix' => 'sikayetci', 'middleware' => ['auth', 'sikayetci']], function() {

    Route::get('/dashboard', [DashboardController::class, 'dashboard']);

});

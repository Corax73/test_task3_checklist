<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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


Route::controller(LoginController::class)
-> group(function () {
    Route::get('/', 'index') -> name('login');
    Route::post('/', 'auth') -> name('auth');
    Route::get('/dashboard', 'users') -> name('users');
    Route::post('/logout', 'logout') -> name('logout');
    Route::post('/dashboard/{id}', 'change') -> name('change');
});

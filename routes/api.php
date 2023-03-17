<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\ChecklistController;

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

Route::controller(RegisterController::class)
-> group(function () {
    Route::post('/register', 'register');
});

Route::controller(ChecklistController::class)
-> group(function () {
    Route::middleware('auth:api') -> post('checklists', 'store');
    Route::middleware('auth:api') -> post('checklists/create', 'createItemChecklist');
    Route::middleware('auth:api') -> get('checklists/getUsersChecklists/{user_id}', 'getUsersChecklists');
});

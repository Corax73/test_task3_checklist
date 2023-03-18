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
    Route::middleware('auth:api') -> post('checklists/createChecklists', 'store');
    Route::middleware('auth:api') -> post('checklists/createItemChecklist', 'createItemChecklist');
    Route::middleware('auth:api') -> get('checklists/getUsersChecklists/{user_id}', 'getUsersChecklists');
    Route::middleware('auth:api') -> get('checklists/getItemsChecklists/{checklist_id}', 'getItemsChecklists');
    Route::middleware('auth:api') -> patch('checklists/setItemsImplementation/{checklist_id}/{item_description}/{implementation}', 'setItemsImplementation');
    Route::middleware('auth:api') -> delete('checklists/deleteChecklists/{checklist_id}', 'destroyUsersChecklists');
    Route::middleware('auth:api') -> delete('checklists/deleteItemsChecklists/{checklist_id}/{item_description}', 'destroyItemsChecklists');
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\GroupController;

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
//Route::resource('users',UserController::class);
Route::group(['prefix' => 'users'], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/store', [UserController::class, 'store']);
    Route::post('delete', [UserController::class, 'destroy']);
    Route::post('assign-group', [UserController::class, 'assignGroup']);
    Route::post('unassign-group', [UserController::class, 'UnAssignGroup']);
});

Route::group(['prefix' => 'groups'], function () {
    Route::get('/', [GroupController::class, 'index']);
    Route::post('/store', [GroupController::class, 'store']);
    Route::post('delete', [GroupController::class, 'destroy']);
});

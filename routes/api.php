<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\ProgrammingController;

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
    return $request->user();
});

/**TAG*/
Route::get('/tags/getAll', [TagController::class, 'index']);
Route::post('/tag/create', [TagController::class, 'store']);
Route::post('/tag/update', [TagController::class, 'update']);
Route::get('/tag/delete', [TagController::class, 'destroy']);

/**PROGRAMMING*/
Route::get('/programs/getAll', [ProgrammingController::class, 'index']);
Route::post('/program/create', [ProgrammingController::class, 'store']);
Route::post('/program/update', [ProgrammingController::class, 'update']);
Route::get('/program/delete', [ProgrammingController::class, 'destroy']);
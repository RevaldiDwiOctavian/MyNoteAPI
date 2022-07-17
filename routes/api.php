<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MyNotesController;
use App\Http\Controllers\API\PublicNotesController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middlewareauth => sanctum'], function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::group(['prefix' => 'mynotes'], function () {
        Route::get('/list/{id}', [MyNotesController::class, 'index'])->middleware('auth:sanctum');
        Route::post('/create', [MyNotesController::class, 'store'])->middleware('auth:sanctum');
        Route::get('/show/{id}', [MyNotesController::class, 'show'])->middleware('auth:sanctum');
        Route::put('/update/{id}', [MyNotesController::class, 'update'])->middleware('auth:sanctum');
        Route::delete('/delete/{id}', [MyNotesController::class, 'destroy'])->middleware('auth:sanctum');
    });
    Route::group(['prefix' => 'publicnotes'], function () {
        Route::get('/list', [PublicNotesController::class, 'index'])->middleware('auth:sanctum');
        Route::get('/show/{id}', [PublicNotesController::class, 'show'])->middleware('auth:sanctum');
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

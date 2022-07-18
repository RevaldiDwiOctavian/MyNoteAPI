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
        Route::get('/list/{id}', [MyNotesController::class, 'index']);
        Route::post('/create', [MyNotesController::class, 'store']);
        Route::get('/show/{id}', [MyNotesController::class, 'show']);
        Route::put('/update/{id}', [MyNotesController::class, 'update']);
        Route::delete('/delete/{id}', [MyNotesController::class, 'destroy']);
    });
    Route::group(['prefix' => 'publicnotes'], function () {
        Route::get('/list', [PublicNotesController::class, 'index']);
        Route::get('/show/{id}', [PublicNotesController::class, 'show']);
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

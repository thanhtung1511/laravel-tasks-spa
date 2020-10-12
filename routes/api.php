<?php

use App\Http\Controllers\Api\{LoginController, ProfileController, TaskController, UserController};
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')->group(
    function () {
        Route::post('login', LoginController::class);
    }
);

Route::middleware('auth:api')->group(
    function () {
        Route::prefix('auth')->group(
            function () {
                Route::get('/me', ProfileController::class);
            }
        );
        Route::prefix('users')->group(
            function () {
                Route::get('/', [UserController::class, 'index']);
            }
        );
        Route::prefix('tasks')->group(
            function () {
                Route::get('/', [TaskController::class, 'index']);
                Route::post('/', [TaskController::class, 'store']);
                Route::put('/{task}/complete', [TaskController::class, 'complete']);
            }
        );
    }
);



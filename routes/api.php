<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function (Request $request) {
    return response()->success(['version' => app()->version()]);
});

Route::post('/tokens', [App\Http\Controllers\AuthController::class, 'login']);

Route::controller(App\Http\Controllers\SystemController::class)
    ->prefix('/system')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/menus', 'menuList');
        }
    );

Route::controller(App\Http\Controllers\FileController::class)
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::post('/upload', 'upload');
        }
    );

Route::controller(App\Http\Controllers\EnterpriseController::class)
    ->prefix('/enterprises')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'save');
        }
    );
Route::controller(App\Http\Controllers\ProductController::class)
    ->prefix('/products')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'save');
        }
    );

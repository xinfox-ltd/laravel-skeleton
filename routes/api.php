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

Route::controller(App\Http\Controllers\CompanyController::class)
    ->prefix('/companies')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
        }
    );

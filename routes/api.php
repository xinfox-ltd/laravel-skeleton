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
    var_dump($request->post());
    return response()->success(['version' => app()->version()]);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/tokens/create', function (Request $request) {
    $user = \App\Models\User::query()->where("email", 'jayme26@example.org')->first();
    $token = $user->createToken('admin');

    return $token;
});

Route::middleware('auth:sanctum')->get('/users/me', function (Request $request) {
    $request->user()->currentAccessToken()->delete();
    return $request->user();
});

Route::get('/is_login', function (Request $request) {
    dd(auth()->check());
    return $request->header('Authorization');
    return $request->user();
});

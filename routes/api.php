<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;

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

//view routes
Route::get('login_page', [UserController::class, 'login_page']);

// These routes doesnt need authentication
Route::post('register', [UserController::class, 'register']) -> name('register');
Route::post('login', [UserController::class, 'login'])-> name('login');

// These routes need Authentication
Route::middleware('auth:api') ->group(function () {
    Route::get('index', [BlogController::class, 'index'])->name("index");
    Route::post('create', [BlogController::class, 'create'])->name("create");

    Route::get('profile', [UserController::class, 'profile']);
    Route::post('logout', [UserController::class, 'logout']);

});

<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\BlogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//view routes for Users
Route::get('/', [UserController::class, 'login_page']) -> name('main');
Route::get('register', [UserController::class, 'register_page']) -> name('sign_up');

//view routes for Posts
Route::get('posts_list', [BlogController::class, 'postsList']) -> name('posts_list');
Route::get('create_post', [BlogController::class, 'createPost']) -> name('create_post');
Route::get('single_post/{id}', [BlogController::class, 'singlePostView']) -> name('single_post');


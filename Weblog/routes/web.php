<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [
    PostController::class, 
    'index'
])->name('posts.index');

Route::get('/register', [
    UserController::class, 
    'create'
])->name('user.create')->middleware('guest');

Route::post('/register', [
    UserController::class,
    'register'
])->name('user.register')->middleware('guest');

Route::get('/signin', [
    UserController::class, 
    'signIn'
])->name('user.signin')->middleware('guest');

Route::post('/signin', [
    UserController::class,
    'login'
])->name('user.login')->middleware('guest');

Route::get('logout', [
    UserController::class,
    'logoutuser'
])->name('user.logout')->middleware('auth');

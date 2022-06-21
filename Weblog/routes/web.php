<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
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


//
//      POST ROUTES
//
Route::get('/', [
    PostController::class, 
    'index'
])->name('posts.index');

Route::get('/create', [
    PostController::class,
    'create'
])->name('posts.create');

Route::post('/create', [
    PostController::class,
    'store'
])->name('posts.store');

Route::get('/post/{post}', [
    PostController::class,
    'view'
])->name('post.view');

Route::get('/post/edit/{post}', [
    PostController::class,
    'edit'
])->name('post.edit');

Route::patch('/post/edit/{post}', [
    PostController::class,
    'update'
])->name('post.update');

Route::delete('/post/edit/{post}', [
    PostController::class,
    'delete'
])->name('post.delete');

// 
//      COMMENT ROUTES
//

Route::post('/post/{post}', [
    CommentController::class,
    'post'
])->name('comment.post');

// 
//      USER ROUTES
//

Route::get('/register', [
    UserController::class, 
    'create'
])->name('user.create')->middleware('guest');

Route::post('/user/register', [
    UserController::class,
    'register'
])->name('user.register')->middleware('guest');

Route::get('/user/signin', [
    UserController::class, 
    'signIn'
])->name('user.signin')->middleware('guest');

Route::post('/user/signin', [
    UserController::class,
    'login'
])->name('user.login')->middleware('guest');

Route::get('/user/logout', [
    UserController::class,
    'logoutuser'
])->name('user.logout')->middleware('auth');

Route::get('/user/overview', [
    UserController::class,
    'overview'
])->name('user.overview');

// 
//      CATEGORIES ROUTES
//

Route::get('/category/create', [
    CategoryController::class,
    "create"
])->name('category.create');

Route::post('/category/store', [
    CategoryController::class,
    "store"
])->name('category.store');

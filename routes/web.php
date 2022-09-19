<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

use App\Models\Category;

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


require __DIR__.'/auth.php';

// Route::get('categories', CategoryController::class)->name('category');
Route::get('{slug}', PostController::class)->name('post');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/category/{category_path}', CategoryController::class)->where('category_path', '.*')->name('category');

Route::get('/blog/{post:slug}', PostController::class)->name('post');

Route::get('/', HomeController::class)->name('home');

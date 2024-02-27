<?php

use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\IndexController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resources([
    'categories' => CategoryController::class,
    'tags' => TagController::class,
    'products' => ProductController::class
]);

Route::get('/', [IndexController::class, 'index'])->name('index');

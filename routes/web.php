<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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
    dd("Welcome");
    return view('welcome');
});
Route::get('/login', [LoginController::class, 'authenticate']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/about', function () {
    return view('about');
});
Route::post('/cart', [CartController::class, 'add']);
Route::get('/categories', [CategoryController::class, 'getAction']);
Route::get('/products/{slog}', [ProductController::class, 'show']);
Route::get('/showCart', [CartController::class, 'show']);
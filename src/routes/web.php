<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/register', [ProductController::class, 'register']);
Route::post('/products/register', [ProductController::class, 'store']);
Route::get('/products/search', [ProductController::class, 'search']);
Route::get('/products/{productId}', [ProductController::class, 'show']);
Route::get('/products/{productId}/update', [ProductController::class, 'edit']);
Route::post('/products/{productId}/update', [ProductController::class, 'update']);
Route::post('/products/{productId}/delete', [ProductController::class, 'destroy']);
<?php

use App\Http\Controllers\ImageController;
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

Route::get('/products', [ProductController::class, 'products']);
Route::post('/products/search', [ProductController::class, 'search'])->name('product.search');
Route::get('/products/search', [ProductController::class, 'search'])->name('product.search');
Route::get('/products/ascending', [ProductController::class, 'ascending'])->name('product.sort');
Route::get('/products/descending', [ProductController::class, 'descending'])->name('product.sort');
Route::get('/products/register', [ProductController::class, 'register']);
Route::post('/products/register', [ProductController::class, 'store']);
Route::get('/products/{id}', [ProductController::class, 'detail'])->name('product.detail')->where('id', '[0-9]+');
Route::patch('/products/{id}/update', [ProductController::class, 'update']);
Route::delete('/products/{id}/delete', [ProductController::class, 'destroy']);


Route::get('/img',[ImageController::class, 'imageregister']);
Route::post('/img', [ImageController::class, 'imagestore']);


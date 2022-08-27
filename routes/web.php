<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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

Route::group(['as' => 'book.', 'prefix' => 'book/'], function() {
    Route::get('', [BookController::class, 'index'])->name('index');
    Route::get('create', [BookController::class, 'create'])->name('create');
    Route::post('store', [BookController::class, 'store'])->name('store');
    Route::get('{id}/show', [BookController::class, 'show'])->name('show');
    Route::get('{id}/edit', [BookController::class, 'edit'])->name('edit');
    Route::put('{id}/update', [BookController::class, 'update'])->name('update');
    Route::delete('{id}/delete', [BookController::class, 'delete'])->name('delete');
});

// Route::resource('book', 'App\Http\Controllers\BookController');

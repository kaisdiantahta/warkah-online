<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\PeminjamanController;

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

Route::get('/', function() {
    return redirect()->route('peminjaman.index');
});

Route::group(['middleware' => 'auth'], function() {
    Route::group(['as' => 'book.', 'prefix' => 'book/'], function() {
        Route::get('', [BookController::class, 'index'])->name('index');
        Route::get('create', [BookController::class, 'create'])->name('create');
        Route::post('store', [BookController::class, 'store'])->name('store');
        Route::get('{id}/show', [BookController::class, 'show'])->name('show');
        Route::get('{id}/edit', [BookController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [BookController::class, 'update'])->name('update');
        Route::delete('{id}/delete', [BookController::class, 'delete'])->name('delete');

        Route::get('json-all', [BookController::class, 'jsonAll'])->name('json-all');
    });

    Route::group(['as' => 'category.', 'prefix'=>'category/'], function() {
        Route::get('', [BookCategoryController::class, 'index'])->name('index');
        Route::get('create', [BookCategoryController::class, 'create'])->name('create');
        Route::post('store', [BookCategoryController::class, 'store'])->name('store');
        Route::get('{id}/edit', [BookCategoryController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [BookCategoryController::class, 'update'])->name('update');
        Route::delete('{id}/delete', [BookCategoryController::class, 'delete'])->name('delete');

        Route::get('json-all', [BookCategoryController::class, 'jsonAll'])->name('json-all');
    });

    Route::group(['as' => 'peminjaman.', 'prefix' => 'peminjaman/'], function() {
        Route::get('', [PeminjamanController::class, 'index'])->name('index');
        Route::get('form-peminjaman', [PeminjamanController::class, 'formPeminjaman'])->name('form-peminjaman');
        Route::post('store', [PeminjamanController::class, 'store'])->name('store');
        Route::get('{id}/detail-peminjaman', [PeminjamanController::class, 'detailPeminjaman'])->name('detail-peminjaman');
        Route::get('{id}/pengembalian', [PeminjamanController::class, 'pengembalian'])->name('pengembalian');
        Route::put('{id}/update', [PeminjamanController::class, 'update'])->name('update');
        Route::delete('{id}/delete', [PeminjamanController::class, 'delete'])->name('delete');
    });
});

// Route::resource('book', 'App\Http\Controllers\BookController');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

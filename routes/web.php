<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SapaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;


Route::get('/', function () {
    return view('pages.beranda');
});

// menampilkan data diri
Route::get('/about', function () {
    return view('pages.about', [
        'nama'  => 'Naufal Naqajiwa Mulian',
        'kelas' => '48-02',
        'nim'   => '707082400038',
    ]);
});

Route::get('/contact', function () {
    return view('pages.contact');
});

Route::get('/sapa', [SapaController::class, 'index']);

// Satu controller dapat memiliki beberapa method
Route::get('/product', [ProductController::class, 'index']); // menampilkan data
Route::get('/product/addProduct', [ProductController::class, 'addProduct']);
// detail produk berdasarkan id
Route::get('/product/{id}', [ProductController::class, 'show']);
// form edit data
Route::get('/product/{id}/edit', [ProductController::class, 'edit']);
// menyimpan data hasil edit
Route::put('/product/{id}', [ProductController::class, 'update']);
// menghapus data
Route::delete('/product/{id}', [ProductController::class, 'destroy']);
// memasukkan data dari form ke database
Route::post('/product', [ProductController::class, 'store']);
Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
Route::resource('/category', CategoryController::class);
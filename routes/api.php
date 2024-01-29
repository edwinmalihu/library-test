<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(BookController::class)->group(function () {
    Route::post('/book', 'AddBook');
    Route::get('/book/{id_book}', 'GetBook');
    Route::put('/book/{id_book}', 'UpdateBook');
    Route::delete('/book/{id_book}', 'DeleteBook');
    Route::get('/book', 'ListBook');
});

Route::controller(CategoryController::class)->group(function () {
    Route::post('/category', 'AddCategory');
    Route::get('/category/{id_catrgory}', 'GetCategory');
    Route::put('/category/{id_category}', 'UpdateCategory');
    Route::get('/category', 'ListCategory');
});

Route::controller(StatusController::class)->group(function () {
    Route::post('/status', 'AddStatus');
});

Route::controller(PeminjamanController::class)->group(function () {
    Route::post('/pinjam', 'PinjamBuku');
    Route::get('/pinjam', 'ListPeminjamanBook');
    Route::get('/pinjam/{kode_peminjaman}', 'ListPeminjamanBook');
});

Route::controller(PengembalianController::class)->group(function () {
    Route::post('/pengembalian', 'PengembalianBook');
    Route::get('/pengembalian', 'ListPengembalian');
    Route::get('/pengembalian/{id_pengembalian}', 'GetPengembalian');
});



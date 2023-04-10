<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MahasiswaController;


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
    return view('Layout');
});

Route::get('mahasiswa',[MahasiswaController::class,'index'])->name('mahasiswa');
Route::get('mahasiswa/tampilkan',[MahasiswaController::class,'tampilkan'])->name('mahasiswa/tampilkan');
Route::post('mahasiswa/tambah',[MahasiswaController::class,'tambah'])->name('mahasiswa/tambah');
Route::delete('mahasiswa/hapus',[MahasiswaController::class,'hapus'])->name('mahasiswa/hapus');
Route::put('mahasiswa/edit',[MahasiswaController::class,'edit'])->name('mahasiswa/edit');
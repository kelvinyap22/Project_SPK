
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\NilaiAlternatifController;
use App\Http\Controllers\TopsisController;

Route::get('/', function () {
    return redirect()->route('alternatif.index');
});

// Alternatif
Route::resource('alternatif', AlternatifController::class)
    ->only(['index', 'store', 'update', 'destroy']);

// Kriteria
Route::resource('kriteria', KriteriaController::class);

// Input Nilai
Route::get('/nilai', [NilaiAlternatifController::class, 'index'])
    ->name('nilai.index');

Route::post('/nilai', [NilaiAlternatifController::class, 'update'])
    ->name('nilai.store');

// TOPSIS
Route::get('/topsis', [TopsisController::class, 'index'])
    ->name('topsis.index');

Route::post('/topsis/hitung', [TopsisController::class, 'hitung'])
    ->name('topsis.hitung');

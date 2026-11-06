<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\NilaiAlternatifController;
use App\Http\Controllers\TopsisController;

Route::get('/', function () {
    return redirect()->route('topsis.index');
});

Route::resource('alternatif', AlternatifController::class);

Route::resource('kriteria', KriteriaController::class);

Route::get('/nilai', [NilaiAlternatifController::class, 'index'])
    ->name('nilai.index');

Route::post('/nilai', [NilaiAlternatifController::class, 'store'])
    ->name('nilai.store');

Route::get('/topsis', [TopsisController::class, 'index'])
    ->name('topsis.index');

Route::post('/topsis/hitung', [TopsisController::class, 'hitung'])
    ->name('topsis.hitung');
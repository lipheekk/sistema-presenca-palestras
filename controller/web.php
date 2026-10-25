<?php

use App\Http\Controllers\PalestraController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PalestraController::class, 'index'])->name('palestras.index');
Route::post('/palestras', [PalestraController::class, 'store'])->name('palestras.store');
Route::put('/palestras/{palestra}', [PalestraController::class, 'update'])->name('palestras.update');
Route::delete('/palestras/{palestra}', [PalestraController::class, 'destroy'])->name('palestras.destroy');

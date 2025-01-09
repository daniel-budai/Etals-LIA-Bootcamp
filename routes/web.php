<?php

use App\Http\Controllers\Chirp\ChirpController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ChirpController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/', [ChirpController::class, 'store'])->name('chirps.store');
    Route::put('/{chirp}', [ChirpController::class, 'update'])->name('chirps.update');
    Route::delete('/{chirp}', [ChirpController::class, 'destroy'])->name('chirps.destroy');
});

require __DIR__.'/auth.php';

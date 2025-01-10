<?php

use App\Http\Controllers\Chirp\ChirpController;
use App\Http\Controllers\AI\AIChirpController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ChirpController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () { //ratelimit trottle?
    Route::post('/', [ChirpController::class, 'store'])->name('chirps.store');
    Route::put('/{chirp}', [ChirpController::class, 'update'])->name('chirps.update');
    Route::delete('/{chirp}', [ChirpController::class, 'destroy'])->name('chirps.destroy');
    
    Route::prefix('chirps/ai')->name('chirps.ai.')->group(function () {
        Route::post('generate', [AIChirpController::class, 'generate'])->name('generate');
    });
});

require __DIR__.'/auth.php';



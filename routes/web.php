<?php

use App\Http\Controllers\AllergeenController;
use App\Http\Controllers\InstructeurController;
use App\Http\Controllers\VoertuigController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/instructeurs', [InstructeurController::class, 'index'])->name('instructeurs.index');
Route::get('/instructeurs/{instructeur}/voertuigen', [VoertuigController::class, 'byInstructor'])
    ->name('instructeurs.voertuigen');
Route::get('/instructeurs/{instructeur}/voertuigen/beschikbaar', [VoertuigController::class, 'available'])
    ->name('instructeurs.voertuigen.available');
Route::get('/instructeurs/{instructeur}/voertuigen/{voertuig}/edit', [VoertuigController::class, 'edit'])
    ->name('instructeurs.voertuigen.edit');
Route::put('/instructeurs/{instructeur}/voertuigen/{voertuig}', [VoertuigController::class, 'update'])
    ->name('instructeurs.voertuigen.update');

Route::get('/allergenen', [AllergeenController::class, 'index'])->name('allergenen.index');

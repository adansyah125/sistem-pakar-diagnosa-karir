<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataDiagnosaController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\RoadmapController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('diagnosa', [DiagnosaController::class, 'index'])->name('diagnosa');
    Route::post('diagnosa', [DiagnosaController::class, 'store'])->name('diagnosa.store');
    Route::get('dataDiagnosa', [DataDiagnosaController::class, 'index'])->name('dataDiagnosa');
    Route::get('riwayat', [RiwayatController::class, 'index'])->name('riwayat');
    Route::delete('riwayat/{id}', [RiwayatController::class, 'destroy'])->name('riwayat.destroy');
    Route::get('roadmap', [RoadmapController::class, 'index'])->name('roadmap');
    Route::post('roadmap/toggle', [RoadmapController::class, 'toggle'])->name('roadmap.toggle');
});

require __DIR__.'/settings.php';

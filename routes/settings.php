<?php

use App\Http\Controllers\Settings\EducationController;
use App\Http\Controllers\Settings\ExperienceController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Settings\SecurityController;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', '/settings/profile');

    Route::get('settings/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('settings/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('settings/profile/education', [EducationController::class, 'store'])->name('education.store');
    Route::put('settings/profile/education/{education}', [EducationController::class, 'update'])->name('education.update');
    Route::delete('settings/profile/education/{education}', [EducationController::class, 'destroy'])->name('education.destroy');

    Route::post('settings/profile/experience', [ExperienceController::class, 'store'])->name('experience.store');
    Route::put('settings/profile/experience/{experience}', [ExperienceController::class, 'update'])->name('experience.update');
    Route::delete('settings/profile/experience/{experience}', [ExperienceController::class, 'destroy'])->name('experience.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::delete('settings/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('settings/security', [SecurityController::class, 'edit'])
        ->middleware(RequirePassword::class)
        ->name('security.edit');

    Route::put('settings/password', [SecurityController::class, 'update'])
        ->middleware('throttle:6,1')
        ->name('user-password.update');

    Route::inertia('settings/appearance', 'settings/appearance')->name('appearance.edit');
});

Route::get('.well-known/passkey-endpoints', function () {
    return response()->json([
        'enroll' => route('security.edit'),
        'manage' => route('security.edit'),
    ]);
})->name('well-known.passkeys');

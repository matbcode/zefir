<?php

use App\Http\Controllers\CurrentLanguageController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
	// Language
	Route::get('/cms/languages', [LanguageController::class, 'index'])->name('language.index');
	Route::put('/cms/languages', [LanguageController::class, 'store'])->name('language.store');
	Route::patch('/cms/languages/{language}', [LanguageController::class, 'update'])->name('language.update');
	Route::delete('/cms/languages/{language}', [LanguageController::class, 'destroy'])->name('language.destroy');

	// Current Language
	Route::get('/cms/current-language/{id}', [CurrentLanguageController::class, 'update'])->name('current-language.update');

	// User
	Route::get('/cms/users', [UserController::class, 'index'])->name('user.index');
	Route::put('/cms/users', [UserController::class, 'store'])->name('user.store');
	Route::patch('/cms/users/{user}', [UserController::class, 'update'])->name('user.update');
	Route::delete('/cms/users/{user}', [UserController::class, 'destroy'])->name('user.destroy');

	// Domain
	Route::get('/cms/domains', [DomainController::class, 'index'])->name('domain.index');
	Route::put('/cms/domains', [DomainController::class, 'store'])->name('domain.store');
	Route::patch('/cms/domains/{domain}', [DomainController::class, 'update'])->name('domain.update');
	Route::delete('/cms/domains/{domain}', [DomainController::class, 'destroy'])->name('domain.destroy');

	// Profile
    Route::get('/cms/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/cms/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/cms/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

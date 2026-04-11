<?php

use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlaygroundController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SnippetController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\UserProfileController;
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

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Tutorials
    Route::get('/tutorials', [TutorialController::class, 'index'])->name('tutorials.index');
    Route::get('/tutorials/{tutorial}', [TutorialController::class, 'show'])->name('tutorials.show');
    Route::post('/tutorials/{tutorial}/progress', [TutorialController::class, 'updateProgress'])->name('tutorials.progress');

    // Snippets
    Route::get('/snippets', [SnippetController::class, 'index'])->name('snippets.index');
    Route::get('/snippets/{snippet}', [SnippetController::class, 'show'])->name('snippets.show');

    // Playground
    Route::get('/playground', [PlaygroundController::class, 'index'])->name('playground');

    // Progress / Learning Dashboard
    Route::get('/progress', [ProgressController::class, 'index'])->name('progress');

    // Bookmarks
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks');
    Route::post('/bookmarks/toggle', [BookmarkController::class, 'toggle'])->name('bookmarks.toggle');

    // User Profile
    Route::get('/user-profile', [UserProfileController::class, 'index'])->name('user-profile');

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');

    // Breeze Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

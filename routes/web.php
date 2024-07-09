<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrackController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/test', [HomeController::class, 'index'])->name('test');
    Route::get('/tracks', [TrackController::class,'getAllTracks'])->name('tracks');
    Route::get('/track/{uuid}', [TrackController::class,'getTrack'])->name('track');
    Route::post('/track', [TrackController::class,'createTrack'])->name('createTrack');
    Route::put('/track/{uuid}', [TrackController::class,'updateTrack'])->name('updateTrack');
    Route::delete('/track/{uuid}', [TrackController::class,'deleteTrack'])->name('deleteTrack');
    Route::get('/track/{uuid}/play', [TrackController::class,'playTrack'])->name('playTrack');
});



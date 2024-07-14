<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\TrackController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\ApiKeyController;
use App\Models\Track;
use App\Models\Playlist;
use App\Models\ApiKeys;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',

])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard', [
            'playlistsCount' => Playlist::count(),
            'tracksCount' => Track::count(),
        ]);
    })->name('index');
    // Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/tracks', [TrackController::class, 'getAllTracks'])->name('tracks');
    Route::get('/track/{uuid}', [TrackController::class, 'getTrack'])->name('track');

    Route::post('/track', [TrackController::class, 'storeTrack'])->name('storeTrack');
    Route::get('/track/{uuid}/edit', [TrackController::class, 'editTrack'])->name('editTrack');

    Route::put('/track/{uuid}', [TrackController::class, 'updateTrack'])->name('updateTrack');

    Route::delete('/track/{uuid}', [TrackController::class, 'deleteTrack'])->name('deleteTrack');
    // Route::get('/track/{uuid}/play', [TrackController::class, 'playTrack'])->name('playTrack');

    //

    Route::get('/playlists', [PlaylistController::class, 'getAllPlaylists'])->name('playlists');
    Route::get('/playlist/{uuid}', [PlaylistController::class, 'getPlaylist'])->name('playlist');

    Route::get('/create-playlist', [PlaylistController::class, 'createPlaylist'])->name('createPlaylist');
    Route::post('/playlist', [PlaylistController::class, 'storePlaylist'])->name('storePlaylist');


    // API KEY

    Route::get('/api-keys',[ApiKeyController::class,'getAllApiKeys'])->name('apiKeys');

    Route::post('/store-api-key', [ApiKeyController::class, 'createApiKey'])->name('createApiKey');
    Route::delete('/delete-api-key/{uuid}', [ApiKeyController::class, 'deleteApiKey'])->name('deleteApiKey');

    // Route::put('/playlist/{uuid}', [PlaylistController::class, 'updatePlaylist'])->name('updatePlaylist');
    // Route::delete('/playlist/{uuid}', [PlaylistController::class, 'deletePlaylist'])->name('deletePlaylist');
    // Route::post('/playlist/{uuid}/track', [PlaylistController::class, 'addTrackToPlaylist'])->name('addTrackToPlaylist');
    // Route::delete('/playlist/{uuid}/track/{track}', [PlaylistController::class, 'removeTrackFromPlaylist'])->name('removeTrackFromPlaylist');
    // Route::get('/playlist/{uuid}/play', [PlaylistController::class, 'playPlaylist'])->name('playPlaylist');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    IsAdmin::class
])->group(function (){
    Route::get('/create-track', [TrackController::class, 'createTrack'])->name('createTrack');
});


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/tracks', [TrackController::class, 'getAllTracks'])->name('tracks');
//     Route::get('/track/{uuid}', [TrackController::class, 'getTrack'])->name('track');
//     Route::post('/track', [TrackController::class, 'createTrack'])->name('createTrack');
//     Route::put('/track/{uuid}', [TrackController::class, 'updateTrack'])->name('updateTrack');
//     Route::delete('/track/{uuid}', [TrackController::class, 'deleteTrack'])->name('deleteTrack');
//     Route::get('/track/{uuid}/play', [TrackController::class, 'playTrack'])->name('playTrack');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {

// });

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiPlaylistController;
use App\Http\Middleware\CheckApiToken;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware([CheckApiToken::class])->group(function (){
    Route::get('/playlists', [ApiPlaylistController::class,'getAllPlaylists',]);
});
// Route::get('/playlists', [ApiPlaylistController::class,'getAllPlaylists']);

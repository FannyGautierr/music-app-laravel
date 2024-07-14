<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckApiToken;
use App\Models\Playlist;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Http\Request;

class ApiPlaylistController extends Controller
{
    public function getAllPlaylists(Request $request): JsonResponse
    {
        $user = $request->user;

        $playlists = Playlist::where('user_id', $user->id)
            ->with(['tracks'])
            ->withCount('tracks')
            ->get();

        return response()->json($playlists, 200);
    }
}

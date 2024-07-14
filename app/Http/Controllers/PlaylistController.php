<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Playlist;
use Illuminate\Support\Facades\Auth;
use App\Models\Track;


class PlaylistController extends Controller
{
    public function getAllPlaylists()
    {
        $playlists = Playlist::where('user_id', Auth::id())
            ->with(['tracks', 'user'])
            ->withCount('tracks')
            ->get();

        return Inertia::render('Playlists', [
            'playlists' => $playlists
        ]);
    }

    public function getPlaylist($uuid)
    {
        return Inertia::render('Playlist')->with('playlist', Playlist::where('uuid', $uuid)->first());
    }

    public function storePlaylist(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'tracks' => 'required|array',
        ]);
        $playlist = new Playlist();
        $playlist->uuid = \Illuminate\Support\Str::uuid();
        $playlist->name = $validatedData['name'];
        $playlist->user_id = Auth::id();
        $playlist->save();

        $playlist->tracks()->attach($validatedData['tracks']);


        return $this->getAllPlaylists();
    }

    public function createPlaylist(Request $request)
    {
        return Inertia::render('PlaylistCreation', [
            'tracks' => Track::all()
        ]);
    }

    public function updatePlaylist(Request $request, $uuid)
    {
        $playlist = Playlist::where('uuid', $uuid)->first();
        $playlist->name = $request->name;
        $playlist->save();

        return $this->getAllPlaylists();
    }

    public function deletePlaylist($uuid)
    {
        $playlist = Playlist::where('uuid', $uuid)->first();
        $playlist->delete();

        return $this->getAllPlaylists();
    }

    public function addTrackToPlaylist(Request $request, $uuid)
    {
        $playlist = Playlist::where('uuid', $uuid)->first();
        $track = Track::where('uuid', $request->track)->first();
        $playlist->tracks()->attach($track->id);

        return $this->getPlaylist($uuid);
    }

    public function removeTrackFromPlaylist(Request $request, $uuid)
    {
        $playlist = Playlist::where('uuid', $uuid)->first();
        $track = Track::where('uuid', $request->track)->first();
        $playlist->tracks()->detach($track->id);

        return $this->getPlaylist($uuid);
    }

    public function getPlaylistTracks($uuid)
    {
        $playlist = Playlist::where('uuid', $uuid)->first();
        return Inertia::render('PlaylistTracks')->with('playlist', $playlist);
    }
}

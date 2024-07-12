<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;
use Inertia\Inertia;

class TrackController extends Controller
{
    public function getAllTracks()
    {
       return Inertia::render('Tracks')->with('tracks', Track::all()->where('display', true));
    }

    public function getTrack($uuid)
    {
        return Inertia::render('Track')->with('track', \App\Models\Track::where('uuid', $uuid)->first());
    }

    public function storeTrack(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'album' => 'required|string|max:255',
            'cover' => 'nullable|image|mimes:jpeg,png|max:20240',
            'track' => 'required|file|mimes:mp3,wav|max:20240',
        ]);
        $track = new Track();
        $track->uuid = \Illuminate\Support\Str::uuid();
        $track->name = $validatedData['name'];
        $track->artist = $validatedData['artist'];
        $track->album = $validatedData['album'];
        $track->genre = 'Pop';

        $track->file = $validatedData['track']->store('tracks', 'public');

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers', 'public');
            $track->cover = $path;
        }
        $track->save();

        return $this->getAllTracks();
    }

    public function createTrack(Request $request)
    {
        return Inertia::render('TrackCreation');
    }

    public function editTrack(Request $request)
    {
        return Inertia::render('TrackEditing')->with('track', Track::where('uuid', $request->uuid)->first());
    }

    public function updateTrack(Request $request, $uuid)
    {
        // $track = \App\Models\Track::where('uuid', $uuid)->first();
        // $track->name = $request->name;
        // $track->artist = $request->artist;
        // $track->cover = $request->cover;
        // $track->file = $request->file;
        // $track->album = $request->album;
        // $track->genre = $request->genre;
        // $track->display = $request->display;
        // $track->playCount = $request->playCount;


        $track = Track::where('uuid', $uuid)->first();
        $track->name = $request->name;
        $track->artist = $request->artist;
        $track->album = $request->album;
        // $track->genre = $request->genre;
        // $track->display = $request->display;
        // $track->playCount = $request->playCount;


        $track->save();
        return redirect()->route('tracks');
    }

    public function deleteTrack($uuid)
    {
        $track = Track::where('uuid', $uuid)->first();
        $track->delete();
        return redirect()->route('tracks');
    }

    public function playTrack($uuid)
    {
        $track =Track::where('uuid', $uuid)->first();
        $track->playCount++;
        $track->save();
        return redirect()->route('tracks');
    }
    public function getTrackByArtist($artist)
    {
        return Inertia::render('Tracks')->with('tracks',Track::where('artist', $artist)->get());
    }

    public function getTrackByAlbum($album)
    {
        return Inertia::render('Tracks')->with('tracks', Track::where('album', $album)->get());
    }
}

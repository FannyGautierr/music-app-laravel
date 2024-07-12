<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    // protected $primaryKey = 'uuid';
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'artist',
        'cover',
        'file',
        'album',
        'genre',
        'display',
        'playCount',
    ];

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_track', 'track_uuid', 'playlist_uuid', 'uuid', 'uuid');
    }
}

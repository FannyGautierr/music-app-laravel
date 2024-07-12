<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    use HasFactory;

    protected $fillable = ['name', 'uuid', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tracks()
    {
        return $this->belongsToMany(Track::class, 'playlist_track', 'playlist_uuid', 'track_uuid', 'uuid', 'uuid');
    }

}

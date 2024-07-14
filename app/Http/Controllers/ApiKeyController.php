<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\ApiKey;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ApiKeyController extends Controller
{
    public function getAllApiKeys()
    {
        return Inertia::render('ApiKeys')->with('apiKeys', ApiKey::all()->where('user_id', Auth::id()));
    }

    public function createApiKey(Request $request){
        $validation = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $apiKey = new ApiKey();
        $apiKey->name = $validation['name'];
        $apiKey->key = Str::random(32);
        $apiKey->uuid = Str::uuid();
        $apiKey->user_id = Auth::id();

        $apiKey->save();
    }

    public function deleteApiKey(Request $request){
        $apiKey = ApiKey::where('uuid', $request->uuid)->first();
        $apiKey->delete();
    }


}

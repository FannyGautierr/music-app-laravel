<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ApiKey;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public $user;

    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('x-api-key');
        $apiKey = ApiKey::where('key', $apiKey)->first();

        if (!$apiKey) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $request->merge(['user' => $apiKey->user]);

        return $next($request);
    }
}

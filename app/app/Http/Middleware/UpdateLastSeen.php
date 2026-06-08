<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;

class UpdateLastSeen
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

       if (Auth::check()) {
            $key = 'last_seen:' . Auth::id();
            if (!Cache::has($key)) {
              DB::table('users')
                  ->where('id', Auth::id())
                  ->update(['last_seen' => now()]);
              Cache::put($key, true, 120);
            }
        }
        return $next($request);
    }
}

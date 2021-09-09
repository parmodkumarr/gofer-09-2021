<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class Apiauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = null)
    {
        $url = $request->url();
        if(!Auth::guard($guard)->check() && Str::contains($url, '/api')){
            return apiResponse(false,401,'Unauthorized');
        }
        return $next($request);
    }
}

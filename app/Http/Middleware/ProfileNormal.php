<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProfileNormal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(\Auth::user()->isProfileNormal() == false){
            return back();
        }
        
        return $next($request);
    }
}

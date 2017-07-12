<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class IsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->isActive)
            return $next($request);
        else    
            return redirect()->route('changePassword',Auth::user()->id);
    }
}

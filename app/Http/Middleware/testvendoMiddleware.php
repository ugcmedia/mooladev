<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Settings;
use Auth;

class testvendorMiddelware
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
      dd($request);
      if (Auth::guard('vendor')->check()) {
        return $next($request);
      }
      else {
          return redirect('/');
      }

    }
}

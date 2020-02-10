<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Settings;
use Auth;

class PartnerMiddleware
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
      //dd($request);
      if (Auth::guard('partner')->check()) {
        return $next($request);
      }
      else {
          return redirect()->route('partner.login');
      }

    }
}

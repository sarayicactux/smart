<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class checkCustomer
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
        if ( Session::has('customer') ) {
            return $next($request);
        }

        return redirect('home');
    }
}

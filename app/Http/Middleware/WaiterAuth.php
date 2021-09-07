<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class WaiterAuth
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
        if ($request->session()->has('WAITER_LOGIN')) {

        } else {
            $request->session()->flash('msg','Access Denied');
            return redirect('/waiter/');
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class KitchenAuth
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
        if ($request->session()->has('KITCHEN_LOGIN')) {

        } else {
            $request->session()->flash('msg','Access Denied');
            return redirect('/kitchen');
        }
        return $next($request);
    }
}

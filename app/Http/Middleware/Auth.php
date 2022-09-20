<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Flash\Message;

class Auth
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
        if (Auth()->guest())
        {
            flash("Vous devez être connecté pour voir cette page !")->error();
            return redirect('/login');            
        }
        return $next($request);
    }
}

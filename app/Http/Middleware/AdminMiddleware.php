<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::check())
        {
            // admin role user = 0
            // utilisateur role = 1

            if(Auth::user()->role == '0')
            {
                return $next($request);
            }
            else
            {
                $response = "Acces refuse, vous n'avez pas ce droit";
                return redirect()->back()->withErrors($response)->withInput();
            }

        }
        else{
            $response = "Connexion reussit";

            return redirect('/login')->with('message', 'connexion reussit');
            
        }

        return $next($request);
    }
}

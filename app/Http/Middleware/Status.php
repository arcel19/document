<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Status
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         $user = Auth::user();
        //  if($user && $user->state === false){
        //      Auth::logout();
        //      return redirect()->route('login');
        //  }

         if ($user->state === false) {
            Auth::logout();
            return redirect()->back()->with('message', 'Votre compte est inactif. Veuillez contacter l\'administrateur.');
        }
        // if (Auth::check() && Auth::user()->state === false) {
        //     Auth::logout();
        //     // L'utilisateur est inactif, redirigez-le ou renvoyez une réponse appropriée.
        //     // Par exemple, vous pouvez rediriger vers une page de connexion avec un message d'erreur.
        //     return redirect()->route('login')->with('error', 'Votre compte est inactif.');
        // }

        return $next($request);
    }
}

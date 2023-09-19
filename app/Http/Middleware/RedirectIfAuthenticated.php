<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next){

//        dd(auth('teacher')->check());
        if(auth('web')->check()){
            return redirect(RouteServiceProvider::HOME);

        } if(auth('student')->check()){
                 //  dd('hennaaaaaaa');

               return redirect(RouteServiceProvider::STUDENT);
            }
        if(auth('teacher')->check()){
            return redirect(RouteServiceProvider::TEACHER);

        }
        if(auth('parent')->check()){
            return redirect(RouteServiceProvider::PERANT);

        }
        return $next($request);

    }






    // public function handle(Request $request, Closure $next, string ...$guards): Response
    // {
    //     $guards = empty($guards) ? [null] : $guards;

    //     foreach ($guards as $guard) {
    //         if (Auth::guard($guard)->check()) {
    //             return redirect(RouteServiceProvider::HOME);
    //         }
    //     }

    //     return $next($request);
    // }
}

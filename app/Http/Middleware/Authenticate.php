<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;

class Authenticate extends Middleware
{
    // use Request;

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    // protected function redirectTo(Request $request): ?string
    // {
    //     return $request->expectsJson() ? null : route('login');
    // }

    protected function redirectTo($request)
    {
      //  dd($request->expectsJson());
        if (!$request->expectsJson()) {
            if (Request::is(app()->getLocale().'/dashbord/student')) {
                return route('selection');
            }
            elseif(Request::is(app()->getLocale().'/teacher/dashboard')) {
                return route('selection');
            }
            elseif(Request::is(app()->getLocale().'/parent/dashboard')) {
                return route('selection');
            }
            else {
               // dd($request);
                return route('selection');
            }
        }
    }


    // protected function redirectTo( $request)
    // {
    //     if (!$request->expectsJson()) {
    //         if (Request::is(app()->getLocale().'/dashbord/student')) {
    //             dd('heeeeee');
    //             return route('dashbord.student');
    //         }
    //         elseif(Request::is(app()->getLocale().'/teacher/dashboard')) {
    //             return route('selection');
    //         }
    //         elseif(Request::is(app()->getLocale().'/parent/dashboard')) {
    //             return route('selection');
    //         }
    //         else {
    //             dd('heeeeee');

    //             return route('selection');
    //         }
    //     }
    // }
}

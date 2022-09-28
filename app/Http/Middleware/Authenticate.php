<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            // URL::defaults(['locale' => App::currentLocale()]);
            // $locale = 'ar';
            // // dd($request->route()->parameters());
            // if (
            //     $request->route()->hasParameter('locale')
            //     &&
            //     ($request->route()->parameter('locale') == 'ar'
            //         || $request->route()->parameter('locale') == 'en')
            // )
            //     $locale =  $request->route()->parameter('locale');
            // // App::setLocale($locale);
            // URL::defaults(['locale' => $locale]);

            if ($request->is('admin*')) {
                return route('admin.auth.login');
            }

            return route('auth.login');
        }
    }
}

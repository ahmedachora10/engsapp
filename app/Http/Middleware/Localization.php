<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Localization
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
        $locale = 'ar';
        // dd($request->route()->parameters());
        if (
            $request->route()->hasParameter('locale')
            &&
            ($request->route()->parameter('locale') == 'ar'
                || $request->route()->parameter('locale') == 'en')
        )
//            $locale =  $request->route()->parameter('locale');
        App::setLocale($locale);
        return $next($request);
    }
}

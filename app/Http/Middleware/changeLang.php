<?php

namespace App\Http\Middleware;

use App\Models\sections;
use Closure;
use Illuminate\Http\Request;

class changeLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // [sections::class,app()->setlocale('en')];
        app()->setlocale('en');
        if(isset($request->lang) && $request->lang=='ar')
        app()->setlocale('ar');
        // [sections::class,app()->setlocale('ar')];
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class LangMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale');

        if (! in_array($locale, config('app.available_locales'))) {
            $locale = Session::get('locale') ?? config('app.locale');

            return redirect(url($locale));
        }

        URL::defaults(['locale' => $locale]);

        Session::put('locale', $locale);

        App::setLocale($locale);

        return $next($request);
    }
}

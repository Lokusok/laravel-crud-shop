<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
    public function switch(Request $request)
    {
        $prevUrl = url()->previous();

        $queryString = parse_url($prevUrl, PHP_URL_QUERY);

        $prevRequest =  Request::create(url()->previous());

        $segments = $prevRequest->segments();
        $segments[0] = $request->input('lang');

        $url = implode('/', $segments) . '?' . $queryString;

        return redirect($url);
    }
}

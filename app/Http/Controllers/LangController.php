<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
    public function switch(Request $request)
    {
        $prevRequest =  Request::create($request->session()->previousUrl());

        $segments = $prevRequest->segments();
        $segments[0] = $request->input('lang');

        $url = implode('/', $segments);

        return redirect($url);
    }
}

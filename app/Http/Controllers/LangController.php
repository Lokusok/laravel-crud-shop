<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
    public function switch(Request $request)
    {
        // @TODO добавлять QueryString
        $prevRequest =  Request::create(url()->previous());

        $segments = $prevRequest->segments();
        $segments[0] = $request->input('lang');

        $url = implode('/', $segments);

        return redirect($url);
    }
}

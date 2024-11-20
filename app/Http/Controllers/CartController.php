<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => ['required', 'integer', 'exists:articles,id']
        ]);

        $sessionId = Session::getId();

        Cart::query()->create([
            'article_id' => $data['id'],
            'session_id' => $sessionId
        ]);

        return redirect()->route('articles.index');
    }
}

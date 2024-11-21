<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function index()
    {
        $result = DB::select('SELECT articles.id, articles.title, articles.price, COUNT(*) as count FROM articles
                              INNER JOIN article_user_carts on articles.id = article_user_carts.article_id
                              GROUP BY article_user_carts.article_id');

        $sum = Cart::query()->with('article')->get()->pluck('article')->pluck('price')->sum();

        return view('articles.cart', [
            'articles' => $result,
            'totalSum' => $sum
        ]);
    }

    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);

        $cartItem = Cart::query()->where('article_id', $article->id)->orderBy('created_at', 'DESC')->first();
        $cartItem->delete();

        return redirect()->route('articles.cart');
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Cart\CartResource;
use App\Models\Article;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController
{
    public function index()
    {
        $cart = Cart::query()->with('article')->get();

        return CartResource::collection($cart);
    }

    public function cart()
    {
        $result = DB::select('SELECT articles.id, articles.title, articles.price, COUNT(*) as count FROM articles
                              INNER JOIN article_user_carts on articles.id = article_user_carts.article_id
                              GROUP BY article_user_carts.article_id');

        $sum = Cart::query()->with('article')->get()->pluck('article')->pluck('price')->sum();

        return response()->json([
            'articles' => $result,
            'total_sum' => $sum
        ]);
    }

    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);

        $cartItem = Cart::query()->where('article_id', $article->id)->orderBy('created_at', 'DESC')->first();
        $cartItem->delete();

        return response()->json([
            'status' => 'Success'
        ]);
    }
}

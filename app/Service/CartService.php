<?php

namespace App\Service;

use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function getStats()
    {
        $res = DB::select('
            SELECT SUM(articles.price) as total_price, COUNT(*) as count FROM article_user_carts
            INNER JOIN articles ON article_user_carts.article_id = articles.id
            WHERE session_id = :session_id
        ', [
            ':session_id' => Session::getId()
        ])[0];

        return $res;
    }

    public function getInfo()
    {
        $res = DB::select('SELECT articles.id, articles.title, articles.price, COUNT(*) as count FROM articles
                              INNER JOIN article_user_carts on articles.id = article_user_carts.article_id
                              WHERE session_id = :session_id
                              GROUP BY article_user_carts.article_id
                              ', [
            ':session_id' => Session::getId()
        ]);

        $sum = Cart::query()->with('article')->get()->pluck('article')->pluck('price')->sum();

        return [
            'articles' => $res,
            'sum' => $sum
        ];
    }

    public function put(string $id)
    {
        $sessionId = Session::getId();

        Cart::query()->create([
            'article_id' => $id,
            'session_id' => $sessionId
        ]);
    }
}

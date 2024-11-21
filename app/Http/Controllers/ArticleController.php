<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::query()->get();

        $res = DB::select('
            SELECT SUM(articles.price) as total_price, COUNT(*) as count FROM article_user_carts
            INNER JOIN articles ON article_user_carts.article_id = articles.id
        ')[0];

        return view('articles.index', [
            'articles' => $articles,
            'totalPrice' => $res->total_price,
            'count' => $res->count
        ]);
    }
}

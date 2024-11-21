<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::query()->paginate(10, pageName: 'page');

        $res = DB::select('
            SELECT SUM(articles.price) as total_price, COUNT(*) as count FROM article_user_carts
            INNER JOIN articles ON article_user_carts.article_id = articles.id
        ')[0];

        return view('articles.index', [
            'articles' => $articles,
            'totalPrice' => $res->total_price,
            'count' => $res->count,
            'currentPage' => $request->input('page') ?? 1
        ]);
    }
}

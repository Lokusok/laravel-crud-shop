<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Cart;
use App\Service\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function __construct(private CartService $cartService) {}

    public function index(Request $request)
    {
        $articles = Article::query()->paginate(10, pageName: 'page');

        $stats = $this->cartService->getStats();

        return view('articles.index', [
            'articles' => $articles,
            'totalPrice' => $stats->total_price,
            'count' => $stats->count,
            'currentPage' => $request->input('page') ?? 1
        ]);
    }
}

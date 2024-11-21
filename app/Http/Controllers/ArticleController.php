<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Service\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    public function __construct(private CartService $cartService) {}

    public function index(Request $request)
    {
        $page = $request->input('page') ?? 1;

        $articles = Cache::remember("articles.{$page}", 60, function () {
            return Article::query()->paginate(10, pageName: 'page');
        });

        $lastPage = $articles->lastPage();

        $stats = $this->cartService->getStats();

        return view('articles.index', [
            'articles' => $articles,
            'totalPrice' => $stats->total_price,
            'count' => $stats->count,
            'currentPage' => $request->input('page') ?? 1,
            'lastPage' => $lastPage
        ]);
    }
}

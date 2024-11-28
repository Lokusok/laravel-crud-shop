<?php

namespace App\Http\Controllers;

use App\DTO\SearchDto;
use App\Models\Article;
use App\Service\CartService;
use App\Service\FilterService;
use App\Service\SearchService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct(
        private CartService $cartService,
        private SearchService $searchService,
        private FilterService $filterService
    ) {}

    public function index(Request $request)
    {
        $page = $request->input('page') ?? 1;

        $perPage = 10;
        $pageName = 'page';

        $searchDto = new SearchDto(
            $request->input('category'),
            $request->input('date'),
            $request->input('query'),
            (int)$page,
            $perPage,
            $pageName
        );

        $articles = $this->searchService->search($searchDto);
        $stats = $this->cartService->getStats();
        $filters = $this->filterService->getFilters();

        $lastPage = $articles->lastPage();

        return view('articles.index', [
            'articles' => $articles,
            'totalPrice' => $stats->total_price,
            'count' => $stats->count,
            'currentPage' => $page,
            'lastPage' => $lastPage,
            'filters' => $filters
        ]);
    }

    public function show(Request $request)
    {
        $slug = $request->route('slug');

        $article = Article::query()->where([
            'slug' => $slug
        ])->with('category')->first();

        if (! $article) {
            abort(404);
        }

        $stats = $this->cartService->getStats();

        $title = __('Магазин') . ' | ' . $article->title;

        return view('articles.show', [
            'article' => $article,
            'totalPrice' => $stats->total_price,
            'count' => $stats->count,
            'title' => $title
        ]);
    }
}

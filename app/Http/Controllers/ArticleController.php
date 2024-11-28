<?php

namespace App\Http\Controllers;

use App\DTO\SearchDto;
use App\Models\Article;
use App\Models\Category;
use App\Service\CartService;
use App\Service\FilterService;
use App\Service\SearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
            return abort(404);
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

    public function edit(Request $request)
    {
        $slug = $request->route('slug');

        $categories = Category::query()->get();

        $article = Article::query()->where([
            'slug' => $slug
        ])->with('category')->first();

        if (! $article) {
            return abort(404);
        }

        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'year' => ['required', 'integer', 'max:2050']
        ]);

        $slug = $request->route('slug');

        $article = Article::query()->where([
            'slug' => $slug
        ])->with('category')->first();

        $article->update($data);

        return back()->with('message', __('Изменено успешно'));
    }

    public function destroy(Request $request)
    {
        $slug = $request->route('slug');

        $article = Article::query()->where([
            'slug' => $slug
        ])->with('category')->first();

        if (! $article) {
            return abort(404);
        }

        $article->delete();

        Cache::flush();

        return redirect()->route('articles.index')->with('message', __('Удалено успешно'));
    }
}

<?php

namespace App\Http\Controllers;

use App\DTO\SearchDto;
use App\Http\Requests\Article\UpdateRequest;
use App\Models\Category;
use App\Repository\ArticleRepository;
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
        private FilterService $filterService,
        private ArticleRepository $articleRepository
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

        $article = $this->articleRepository->findBySlug($slug) or abort(404);

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

        $article = $this->articleRepository->findBySlug($slug) or abort(404);

        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(UpdateRequest $request)
    {
        $data = $request->validated();

        $slug = $request->route('slug');

        $article = $this->articleRepository->findBySlug($slug) or abort(404);

        $article->update($data);

        return back()->with('message', __('Изменено успешно'));
    }

    public function destroy(Request $request)
    {
        $slug = $request->route('slug');

        $article = $this->articleRepository->findBySlug($slug) or abort(404);

        $article->delete();

        Cache::flush();

        return redirect()->route('articles.index')->with('message', __('Удалено успешно'));
    }
}

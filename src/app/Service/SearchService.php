<?php

namespace App\Service;

use App\DTO\SearchDto;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class SearchService
{
    public function search(SearchDto $filterDto): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        if (
            (isset($filterDto->category) && $filterDto->category !== 'all') ||
            (isset($filterDto->date) && $filterDto->date !== 'default') ||
            (isset($filterDto->query) && strlen($filterDto->query) > 0)
        ) {
            if ($filterDto->category === 'all') {
                $articles = Article::query();
            } else {
                $category = Category::query()->where('slug', $filterDto->category)->first();
                $articles = $category->articles();
            }

            if (strlen($filterDto->query) > 0) $articles->where('title', 'like', "%{$filterDto->query}%");
            if ($filterDto->date !== 'default') $articles->orderBy('created_at', $filterDto->date);

            $articles = $articles->paginate($filterDto->perPage, pageName: $filterDto->pageName);
        } else {
            $articles = Cache::remember("articles:{$filterDto->page}", 60, function () use ($filterDto) {
                return Article::query()->paginate($filterDto->perPage, pageName: $filterDto->pageName);
            });
        }

        return $articles;
    }
}

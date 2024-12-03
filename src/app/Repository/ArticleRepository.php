<?php

namespace App\Repository;

use App\Models\Article;

class ArticleRepository
{
    public function findBySlug(string $slug): ?Article
    {
        $article = Article::query()->where([
            'slug' => $slug
        ])->with('category')->first();

        return $article;
    }
}

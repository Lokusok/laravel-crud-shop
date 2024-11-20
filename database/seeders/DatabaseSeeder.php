<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'id' => 1,
                'title' => 'Книга по Laravel',
                'price' => 4242
            ],
            [
                'id' => 2,
                'title' => 'Книга по Vue',
                'price' => 1212
            ],
            [
                'id' => 3,
                'title' => 'Книга по React',
                'price' => 444
            ],
        ];

        foreach ($articles as $article) {
            Article::create([
                'title' => $article['title'],
                'price' => $article['price']
            ]);
        }
    }
}

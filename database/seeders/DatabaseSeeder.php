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
            [
                'id' => 4,
                'title' => 'Курс по PHP',
                'price' => 3500
            ],
            [
                'id' => 5,
                'title' => 'Курс по JavaScript',
                'price' => 2999
            ],
            [
                'id' => 6,
                'title' => 'Книга по Python',
                'price' => 1999
            ],
            [
                'id' => 7,
                'title' => 'Книга по Java',
                'price' => 2999
            ],
            [
                'id' => 8,
                'title' => 'Курс по C#',
                'price' => 4500
            ],
            [
                'id' => 9,
                'title' => 'Книга по SQL',
                'price' => 1200
            ],
            [
                'id' => 10,
                'title' => 'Книга по Git',
                'price' => 800
            ],
            [
                'id' => 11,
                'title' => 'Курс по HTML и CSS',
                'price' => 2500
            ],
            [
                'id' => 12,
                'title' => 'Курс по UX/UI дизайну',
                'price' => 5000
            ],
            [
                'id' => 13,
                'title' => 'Книга по DevOps',
                'price' => 3200
            ],
            [
                'id' => 14,
                'title' => 'Курс по машинному обучению',
                'price' => 6000
            ],
            [
                'id' => 15,
                'title' => 'Книга по Data Science',
                'price' => 4500
            ],
            [
                'id' => 16,
                'title' => 'Книга по Agile',
                'price' => 1500
            ],
            [
                'id' => 17,
                'title' => 'Курс по тестированию ПО',
                'price' => 4000
            ],
            [
                'id' => 18,
                'title' => 'Книга по сетевым технологиям',
                'price' => 2900
            ],
            [
                'id' => 19,
                'title' => 'Курс по мобильной разработке',
                'price' => 7000
            ],
            [
                'id' => 20,
                'title' => 'Книга по кибербезопасности',
                'price' => 3600
            ],
            [
                'id' => 21,
                'title' => 'Курс по блокчейн-технологиям',
                'price' => 8000
            ],
            [
                'id' => 22,
                'title' => 'Курс по архитектуре ПО',
                'price' => 5500
            ],
            [
                'id' => 23,
                'title' => 'Книга по системному администрированию',
                'price' => 2700
            ],
            [
                'id' => 24,
                'title' => 'Курс по разработке игр',
                'price' => 7500
            ],
            [
                'id' => 25,
                'title' => 'Книга по виртуализации',
                'price' => 2200
            ],
            [
                'id' => 26,
                'title' => 'Курс по Python для анализа данных',
                'price' => 4900
            ],
            [
                'id' => 27,
                'title' => 'Курс по React Native',
                'price' => 6500
            ],
            [
                'id' => 28,
                'title' => 'Книга по PHP для начинающих',
                'price' => 1800
            ],
            [
                'id' => 29,
                'title' => 'Курс по Node.js',
                'price' => 5200
            ],
            [
                'id' => 30,
                'title' => 'Книга по веб-разработке',
                'price' => 3200
            ]
        ];

        foreach ($articles as $article) {
            Article::create([
                'title' => $article['title'],
                'price' => $article['price']
            ]);
        }
    }
}

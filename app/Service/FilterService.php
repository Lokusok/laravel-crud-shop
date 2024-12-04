<?php

namespace App\Service;

use App\Models\Category;

class FilterService
{
    public function getFilters(): array
    {
        return [
            'categories' => Category::query()->get(['title', 'slug'])->toArray(),
            'date' => [
                [
                    'label' => 'По умолчанию',
                    'value' => 'default'
                ],
                [
                    'label' => 'По возрастанию',
                    'value' => 'asc'
                ],
                [
                    'label' => 'По убыванию',
                    'value' => 'desc'
                ]
            ]
        ];
    }
}

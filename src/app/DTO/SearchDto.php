<?php

namespace App\DTO;

class SearchDto
{
    public function __construct(
        public ?string $category = null,
        public ?string $date = null,
        public ?string $query = null,
        public ?int $page = null,
        public ?int $perPage = null,
        public ?string $pageName = null
    ) {}
}

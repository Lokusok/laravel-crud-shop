<?php

namespace App\Http\Resources\Cart;

use App\Http\Resources\Article\ArticleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return ArticleResource::make($this->article);
    }
}

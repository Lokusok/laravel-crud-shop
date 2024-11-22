<?php

namespace App\Exports;

use App\Http\Resources\Cart\CartResource;
use App\Models\Cart;
use Maatwebsite\Excel\Concerns\FromCollection;

class CartExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $cart = Cart::query()->with('article')->get();

        return CartResource::collection($cart);
    }
}

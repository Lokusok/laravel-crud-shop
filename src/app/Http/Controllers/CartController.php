<?php

namespace App\Http\Controllers;

use App\Exports\CartExport;
use App\Http\Requests\Cart\StoreRequest;
use App\Models\Article;
use App\Models\Cart;
use App\Service\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;

class CartController extends Controller
{
    public function __construct(private CartService $cartService) {}

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $this->cartService->put($data['id']);

        return redirect()->back();
    }

    public function index()
    {
        $info = $this->cartService->getInfo();

        return view('cart.index', [
            'articles' => $info['articles'],
            'totalSum' => $info['sum']
        ]);
    }

    public function destroy(Request $request)
    {
        $article = Article::findOrFail($request->route('id'));

        $cartItem = Cart::query()->where('article_id', $article->id)->orderBy('created_at', 'DESC')->first();
        $cartItem->delete();

        return redirect()->route('cart.index');
    }

    public function download()
    {
        return Excel::download(new CartExport, 'cart.xlsx');
    }
}

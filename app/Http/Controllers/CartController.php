<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Cart;
use App\Service\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(private CartService $cartService) {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => ['required', 'integer', 'exists:articles,id']
        ]);

        $this->cartService->put($data['id']);

        return redirect()->back();
    }

    public function index()
    {
        $info = $this->cartService->getInfo();

        return view('articles.cart', [
            'articles' => $info['articles'],
            'totalSum' => $info['sum']
        ]);
    }

    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);

        $cartItem = Cart::query()->where('article_id', $article->id)->orderBy('created_at', 'DESC')->first();
        $cartItem->delete();

        return redirect()->route('articles.cart');
    }
}

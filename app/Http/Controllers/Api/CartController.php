<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Cart\CartResource;
use App\Models\Article;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

/**
 * @OA\Info(title="Cart", version="1.0.0")
 */
class CartController
{
    /**
     * @OA\Get(
     *     path="/api/cart",
     *     tags={"Cart"},
     *     @OA\Response(
     *       response="200",
     *       description="Получить содержимое корзины",
     *       @OA\JsonContent(
     *         @OA\Property(property="data", type="object",
     *         @OA\Property(property="id", type="number", example=4242),
     *         @OA\Property(property="title", type="string", example="Swagger Book"),
     *         @OA\Property(property="price", type="number", example=1800)
     *       )
     *     )
     *   )
     * )
     */
    public function index()
    {
        $cart = Cart::query()->with('article')->get();

        return CartResource::collection($cart);
    }

    /**
     * @OA\Get(
     *     path="/api/cart/current",
     *     tags={"Cart"},
     *     @OA\Response(
     *       response="200",
     *       description="Получить статистику лежащего в корзине",
     *       @OA\JsonContent(
     *         @OA\Property(property="articles", type="array", @OA\Items(
     *          @OA\Property(property="id", type="number", example=4242),
     *          @OA\Property(property="title", type="string", example="Swagger Book"),
     *          @OA\Property(property="price", type="number", example=1800)
     *     )
     *   ),
     *         @OA\Property(property="total_sum", type="number", example="500"),
     *       )
     *     )
     *   )
     * )
     */
    public function cart()
    {
        $result = DB::select('SELECT articles.id, articles.title, articles.price, COUNT(*) as count FROM articles
                              INNER JOIN article_user_carts on articles.id = article_user_carts.article_id
                              GROUP BY article_user_carts.article_id');

        $sum = Cart::query()->with('article')->get()->pluck('article')->pluck('price')->sum();

        return response()->json([
            'articles' => $result,
            'total_sum' => $sum
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/cart/{itemId}",
     *     tags={"Cart"},
     *     @OA\Parameter(
     *       name="itemId",
     *       in="path",
     *       required=true,
     *       description="ID товара",
     *       @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *       response="200",
     *       description="Получить статистику лежащего в корзине",
     *       @OA\JsonContent(
     *         @OA\Property(
     *           property="status",
     *           type="string",
     *           example="Success",
     *         )
     *       )
     *     )
     *   )
     * )
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);

        $cartItem = Cart::query()->where('article_id', $article->id)->orderBy('created_at', 'DESC')->first();
        $cartItem->delete();

        return response()->json([
            'status' => 'Success'
        ]);
    }
}

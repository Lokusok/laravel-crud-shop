<?php

namespace App\Service;

use App\Enum\CartCacheEnum;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartService
{
    private static function prepareForAuth(string $sql): string
    {
        if (Auth::check()) {
            $sql .= ' OR user_id = :user_id';
        }

        return $sql;
    }

    public function getStats()
    {
        $sql = self::prepareForAuth('
            SELECT SUM(articles.price) as total_price, COUNT(*) as count FROM article_user_carts
            INNER JOIN articles ON article_user_carts.article_id = articles.id
            WHERE session_id = :session_id
        ');

        $sessionId = Session::getId();

        if (Auth::check()) {
            $userId = Auth::user()->id;

            $res = Cache::remember(CartCacheEnum::AUTH_USER_CART->value, 60, function () use ($sql, $sessionId, $userId) {
                return DB::select($sql, [
                    ':session_id' => $sessionId,
                    ':user_id' => $userId
                ])[0];
            });
        } else {
            $res = Cache::remember(CartCacheEnum::GUEST_USER_CART->value, 60, function () use ($sql, $sessionId) {
                return DB::select($sql, [
                    ':session_id' => $sessionId,
                ])[0];
            });
        }

        return $res;
    }

    public function getInfo()
    {
        $sql = self::prepareForAuth('
                SELECT articles.id, articles.title, articles.slug, articles.price, COUNT(*) as count FROM articles
                INNER JOIN article_user_carts on articles.id = article_user_carts.article_id
                WHERE session_id = :session_id
        ');

        $sql .= ' GROUP BY articles.id, articles.title, articles.slug, articles.price, article_user_carts.article_id';

        if (Auth::check()) {
            $res = DB::select($sql, [
                ':session_id' => Session::getId(),
                ':user_id' => Auth::user()->id
            ]);
        } else {
            $res = DB::select($sql, [
                ':session_id' => Session::getId(),
            ]);
        }

        $sum = Cart::query();

        if (Auth::check()) {
            $sum = $sum->byUserId(Auth::user()->id);
        } else {
            $sum = $sum->bySessionId(Session::getId());
        }

        $sum = $sum->with('article')->get()->pluck('article')->pluck('price')->sum();

        return [
            'articles' => $res,
            'sum' => $sum
        ];
    }

    public function put(string $id)
    {
        if (Auth::check()) {
            Cache::forget(CartCacheEnum::AUTH_USER_CART->value);

            Cart::query()->create([
                'article_id' => $id,
                'user_id' => Auth::user()->id
            ]);
        } else {
            $sessionId = Session::getId();

            Cache::forget(CartCacheEnum::GUEST_USER_CART->value);

            Cart::query()->create([
                'article_id' => $id,
                'session_id' => $sessionId
            ]);
        }
    }

    public function fromSessionToUser(string $sessionId, string $userId): void
    {
        Cart::query()->where('session_id', $sessionId)->update([
            'user_id' => $userId
        ]);
    }
}

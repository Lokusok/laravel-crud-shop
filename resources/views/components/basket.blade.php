@props(['count', 'totalPrice'])

<span class="basket__descr">В корзине:</span>

<div class="basket_concrete">
    @if ($count > 0)
        <span class="basket__current-count">{{ $count }}
            {{ Str::number($count, ['товар', 'товара', 'товаров']) }}</span>
        /
        <span class="basket__current-price">{{ $totalPrice }} ₽</span>
    @else
        <span>Пусто</span>
    @endif
</div>

<div class="basket__actions">
    <a href="{{ route('articles.cart') }}">
        <button class="basket__action">
            Корзина
        </button>
    </a>
</div>

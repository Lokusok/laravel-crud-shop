@props(['count', 'totalPrice'])

<div class="basket">
    <div class="basket__info">
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
            <button x-data @click="$store.cart.modal.open()" class="basket__action">
                Корзина
            </button>
        </div>
    </div>
</div>

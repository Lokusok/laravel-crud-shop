@props(['count', 'totalPrice'])

<div class="basket">
    <span class="basket__descr">{{ __('В корзине') }}:</span>

    <div class="basket_concrete">
        @if ($count > 0)
            <span class="basket__current-count">{{ $count }}
                {{ Str::number($count, [__('товар'), __('товара'), __('товаров')]) }}</span>
            /
            <span class="basket__current-price">{{ $totalPrice }} ₽</span>
        @else
            <span>{{ __('Пусто') }}</span>
        @endif
    </div>

    <div class="basket__actions">
        <a href="{{ route('cart.index') }}">
            <button class="basket__action">
                {{ __('Корзина') }}
            </button>
        </a>
    </div>
</div>

<x-layouts.main :title="__('Корзина')">
    <x-header :title="__('Корзина')" />

    <x-sub-header>
        <a href="{{ route('articles.index') }}">
            <button>{{ __('Назад') }}</button>
        </a>
    </x-sub-header>

    @foreach ($articles as $article)
        <x-article deletable :id="$article->id" :price="$article->price" :title="$article->title" :count="$article->count" />
    @endforeach

    <div class="cart-result">
        <div class="cart-result__text">
            {{ __('Итого') }}: {{ $totalSum }} ₽
        </div>

        <div>
            <a href="{{ route('cart.download') }}" target="_blank">
                <button>{{ __('Скачать') }}</button>
            </a>
        </div>
    </div>
</x-layouts.main>

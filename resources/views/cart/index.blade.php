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
            Итого: {{ $totalSum }} ₽
        </div>
    </div>
</x-layouts.main>

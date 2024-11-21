<x-layouts.main title="Корзина">
    <x-header title="Корзина" />

    <x-sub-header>
        <a href="{{ route('articles.index') }}">
            <button>Назад</button>
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

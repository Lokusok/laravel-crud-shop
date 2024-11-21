<x-layouts.main title="Корзина">
    <x-header title="Корзина">
        <a href="{{ route('articles.index') }}">
            <button>Назад</button>
        </a>
    </x-header>

    @foreach ($articles as $article)
        <x-article deletable :id="$article->id" :price="$article->price" :title="$article->title" :count="$article->count" />
    @endforeach

    <div class="cart-result">
        <div class="cart-result__text">
            Итого: {{ $totalSum }} ₽
        </div>
    </div>
</x-layouts.main>

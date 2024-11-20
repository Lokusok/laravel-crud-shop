@props(['id', 'title', 'price', 'count' => null])

<article class="article">
    <div class="article__info">
        <span class="article__id">{{ $id }}</span>
        <span class="article__title">{{ $title }}</span>
    </div>

    <div class="article__actions">
        <div class="article__entities">
            <span class="article__price">{{ $price }} ₽</span>

            @isset($count)
                <span class="article__count">{{ $count }} шт</span>
            @endisset
        </div>

        <form action="{{ route('cart.store') }}" method="POST">
            @csrf

            <input type="hidden" value="{{ $id }}" name="id">

            <button type="submit" class="article__buy">
                Добавить
            </button>
        </form>
    </div>
</article>

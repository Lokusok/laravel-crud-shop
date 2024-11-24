<x-layouts.main :title="$title">
    <x-header :title="$title" />

    <x-sub-header>
        <x-nav />

        <x-basket :count="$count" :total-price="$totalPrice" />
    </x-sub-header>

    <x-content>
        <div class="article-info">
            <p class="article-info__descr">
                {{ $article->description }}
            </p>

            <div class="info-item">
                <span class="info-item__key">{{ __('Страна производитель') }}:</span>
                <span class="info-item__value">Россия (RU)</span>
            </div>

            <div class="info-item">
                <span class="info-item__key">{{ __('Категория') }}:</span>
                <span class="info-item__value">Электроника</span>
            </div>

            <div class="info-item">
                <span class="info-item__key">{{ __('Год выпуска') }}:</span>
                <span class="info-item__value">{{ $article->year }}</span>
            </div>

            <div class="article-info__price">
                {{ __('Цена') }}: {{ $article->price }} ₽
            </div>

            <div class="article-info__footer">
                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $article->id }}" name="id">

                    <button>{{ __('Добавить') }}</button>
                </form>
            </div>
        </div>
    </x-content>
</x-layouts.main>
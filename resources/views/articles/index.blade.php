<x-layouts.main :title="__('Магазин')">
    <x-header :title="__('Магазин')" />

    <x-sub-header>
        <x-basket :count="$count" :total-price="$totalPrice" />
    </x-sub-header>

    @foreach ($articles as $article)
        <x-article :id="$article->id" :price="$article->price" :title="$article->title" />
    @endforeach

    <div class="pagination">
        @for ($i = 1; $i <= 3; $i++)
            <a href="?page={{ $i }}" class="pagination__item {{ $i == $currentPage ? 'current' : '' }}">
                {{ $i }}
            </a>
        @endfor
    </div>
</x-layouts.main>

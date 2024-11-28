<x-layouts.main :title="__('Магазин')">
    <x-header :title="__('Магазин')" />

    @session('message')
        <div class="p-3">
            <x-flash name="message" />
        </div>
    @endsession

    <x-sub-header>
        <form class="filters__form" action="{{ route('articles.index') }}" method="GET">
            <div class="filters">
                <div class="filters__category">
                    <select name="category">
                        <option value="all">Все</option>

                        @foreach ($filters['categories'] as $category)
                            <option value="{{ $category['slug'] }}" @selected(request()->input('category') === $category['slug'])>
                                {{ $category['title'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filters__date">
                    <select name="date">
                        @foreach ($filters['date'] as $dateFilter)
                            <option value="{{ $dateFilter['value'] }}" @selected(request()->input('date') === $dateFilter['value'])>
                                {{ $dateFilter['label'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filters__search">
                    <input value="{{ request()->input('query') }}" type="text" name="query"
                        placeholder="{{ __('Поиск') }}">
                </div>

                <button type="submit">{{ __('Искать') }}</button>
            </div>
        </form>

        <a href="{{ route('articles.index') }}">
            <button type="submit">{{ __('Сбросить') }}</button>
        </a>

        <x-basket :count="$count" :total-price="$totalPrice" />
    </x-sub-header>

    @foreach ($articles as $article)
        <x-article :id="$article->id" :price="$article->price" :title="$article->title" :slug="$article->slug" />
    @endforeach

    @if ($lastPage !== 1)
        <div class="pagination">
            @for ($i = 1; $i <= $lastPage; $i++)
                <a href="{{ route('articles.index', [
                    'page' => $i,
                    'category' => request()->input('category'),
                    'date' => request()->input('date'),
                    'query' => request()->input('query'),
                ]) }}"
                    class="pagination__item {{ $i == $currentPage ? 'current' : '' }}">
                    {{ $i }}
                </a>
            @endfor
        </div>
    @endif
</x-layouts.main>

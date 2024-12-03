<x-layouts.main :title="__('Редактирование товара')">
    <x-header :title="__('Редактирование товара')" />

    <x-sub-header>
        <x-nav />
    </x-sub-header>

    <x-content>
        <x-flash name="message" />

        @if (url()->current() !== url()->previous())
            <a href="{{ url()->previous() }}">
                <button>
                    < {{ __('Назад') }} </button>
            </a>
        @endif

        <form action="{{ route('articles.update', [$article->slug]) }}" class="action__form" method="POST">
            @csrf
            @method('PUT')

            <div class="action__field">
                <label for="title" class="action__label">
                    {{ __('Название товара') }}:
                </label>

                <input value="{{ old('title', $article->title) }}" class="action__input" id="title" name="title"
                    type="text" placeholder="{{ __('Название товара') }}">
            </div>

            <div class="action__field">
                <label for="category_id" class="action__label">
                    {{ __('Категория') }}:
                </label>

                <select class="action__input" name="category_id" id="category_id">
                    @foreach ($categories as $category)
                        <option @selected($article->category_id === $category->id) value="{{ $category->id }}">
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="action__field">
                <label for="year" class="action__label">
                    {{ __('Год выпуска') }}:
                </label>

                <input value="{{ old('year', $article->year) }}" class="action__input" id="year" name="year"
                    type="text" placeholder="{{ __('Год выпуска') }}">
            </div>

            @if ($errors->any())
                <div class="action__field action__errors">
                    @foreach ($errors->all() as $error)
                        <span class="action__error">{{ $error }}</span>
                    @endforeach
                </div>
            @endif

            <div class="action__field">
                <button type="submit">{{ __('Изменить') }}</button>
            </div>
        </form>
    </x-content>
</x-layouts.main>

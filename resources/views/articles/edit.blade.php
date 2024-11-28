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

        <form action="{{ route('articles.update', [$article->slug]) }}" class="auth__form" method="POST">
            @csrf
            @method('PUT')

            <div class="auth__field">
                <label for="title" class="auth__label">
                    {{ __('Название товара') }}:
                </label>

                <input value="{{ old('title', $article->title) }}" class="auth__input" id="title" name="title"
                    type="text" placeholder="{{ __('Название товара') }}">
            </div>

            <div class="auth__field">
                <label for="category_id" class="auth__label">
                    {{ __('Категория') }}:
                </label>

                <select class="auth__input" name="category_id" id="category_id">
                    @foreach ($categories as $category)
                        <option @selected($article->category_id === $category->id) value="{{ $category->id }}">
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="auth__field">
                <label for="year" class="auth__label">
                    {{ __('Год выпуска') }}:
                </label>

                <input value="{{ old('year', $article->year) }}" class="auth__input" id="year" name="year"
                    type="text" placeholder="{{ __('Год выпуска') }}">
            </div>

            @if ($errors->any())
                <div class="auth__field auth__errors">
                    @foreach ($errors->all() as $error)
                        <span class="auth__error">{{ $error }}</span>
                    @endforeach
                </div>
            @endif

            <div class="auth__field">
                <button type="submit">{{ __('Изменить') }}</button>
            </div>
        </form>
    </x-content>
</x-layouts.main>

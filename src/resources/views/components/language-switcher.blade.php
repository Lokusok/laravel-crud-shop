<div class="language">
    <form action="{{ route('lang.switch') }}" method="POST">
        @csrf

        <select name="lang">
            @foreach (config('app.available_locales') as $label => $value)
                <option @selected(App::currentLocale() === $value) value="{{ $value }}">
                    {{ $label }}
                </option>
            @endforeach
        </select>

        <button type="submit">
            {{ __('Изменить') }}
        </button>
    </form>
</div>

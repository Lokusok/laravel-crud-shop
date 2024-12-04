<x-layouts.main :title="__('Вход')">
    <x-header :title="__('Вход')" />

    <x-sub-header>
        <x-nav />

        <x-basket :count="$count" :total-price="$totalPrice" />
    </x-sub-header>

    <x-content>
        <x-title>
            {{ __('Вход') }}
        </x-title>

        <x-flash class="mt-2" name="message" />

        <form action="{{ route('auth.loginize') }}" class="action__form" method="POST">
            @csrf

            <div class="action__field">
                <label for="email" class="action__label">
                    {{ __('Логин') }}:
                </label>

                <input value="{{ old('email') }}" class="action__input" id="email" name="email" type="text"
                    placeholder="{{ __('Ваш логин') }}">
            </div>

            <div class="action__field">
                <label for="password" class="action__label">
                    {{ __('Пароль') }}:
                </label>

                <input class="action__input" id="password" name="password" type="text"
                    placeholder="{{ __('Ваш пароль') }}">
            </div>

            <div class="action__field">
                <a href="{{ route('auth.register') }}">{{ __('Нет аккаунта?') }}</a>
            </div>

            @if ($errors->any())
                <div class="action__field action__errors">
                    @foreach ($errors->all() as $error)
                        <span class="action__error">{{ $error }}</span>
                    @endforeach
                </div>
            @endif

            <div class="action__field">
                <button type="submit">{{ __('Войти') }}</button>
            </div>

            <hr>

            <div class="action__advanced">
                <a href="{{ route('oauth.github.redirect') }}">
                    <button type="button">{{ __('Войти через') . ' ' . 'Github' }}</button>
                </a>

                <a href="{{ route('oauth.google.redirect') }}">
                    <button type="button">{{ __('Войти через') . ' ' . 'Gmail' }}</button>
                </a>
            </div>
        </form>
    </x-content>
</x-layouts.main>

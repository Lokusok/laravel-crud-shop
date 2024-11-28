<x-layouts.main :title="__('Регистрация')">
    <x-header :title="__('Регистрация')" />

    <x-sub-header>
        <x-nav />

        <x-basket :count="$count" :total-price="$totalPrice" />
    </x-sub-header>

    <x-content>
        <h3 class="auth__title">
            {{ __('Регистрация') }}
        </h3>

        <form action="{{ route('auth.registerize') }}" class="action__form" method="POST">
            @csrf

            <div class="action__field">
                <label for="name" class="action__label">
                    {{ __('Никнейм') }}:
                </label>

                <input value="{{ old('name') }}" class="action__input" id="name" name="name" type="text"
                    placeholder="{{ __('Ваш никнейм') }}">
            </div>

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
                <label for="password" class="action__label">
                    {{ __('Повторите пароль') }}:
                </label>

                <input class="action__input" id="password" name="password_confirmation" type="text"
                    placeholder="{{ __('Повторите пароль') }}">
            </div>

            <div class="action__field">
                <a href="{{ route('auth.login') }}">
                    {{ __('Уже есть аккаунт?') }}
                </a>
            </div>

            @if ($errors->any())
                <div class="action__field action__errors">
                    @foreach ($errors->all() as $error)
                        <span class="action__error">{{ $error }}</span>
                    @endforeach
                </div>
            @endif

            <div class="action__field">
                <button type="submit">{{ __('Регистрация') }}</button>
            </div>
        </form>
    </x-content>
</x-layouts.main>

<x-layouts.main title="Вход">
    <x-header title="Вход" />

    <x-sub-header>
        <x-nav />

        <x-basket :count="$count" :total-price="$totalPrice" />
    </x-sub-header>

    <x-content>
        <h3 class="auth__title">
            Вход
        </h3>

        <form action="{{ route('auth.loginize') }}" class="auth__form" method="POST">
            @csrf

            <div class="auth__field">
                <label for="email" class="auth__label">
                    Логин:
                </label>

                <input value="{{ old('email') }}" class="auth__input" id="email" name="email" type="text"
                    placeholder="Ваш логин">
            </div>

            <div class="auth__field">
                <label for="password" class="auth__label">
                    Пароль:
                </label>

                <input class="auth__input" id="password" name="password" type="text" placeholder="Ваш пароль">
            </div>

            @if ($errors->any())
                <div class="auth__field auth__errors">
                    @foreach ($errors->all() as $error)
                        <span class="auth__error">{{ $error }}</span>
                    @endforeach
                </div>
            @endif

            <div class="auth__field">
                <button type="submit">Войти</button>
            </div>
        </form>
    </x-content>
</x-layouts.main>

@props([
    'title' => 'Магазин',
])

<div class="header">
    <div class="header__up">
        @guest
            <div class="header__nav">
                <a href="{{ route('auth.login') }}" class="header__link">
                    <button>Войти</button>
                </a>
            </div>
        @endguest

        @auth
            <div class="header__nav">
                <a href="{{ route('profile.index') }}" class="header__link">
                    <button>{{ __('Личный кабинет') }}</button>
                </a>

                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit">{{ __('Выход') }}</button>
                </form>
            </div>
        @endauth
    </div>

    <div class="header__main">
        <h3 class="header__title">{{ $title }}</h3>

        <x-language-switcher />
    </div>
</div>

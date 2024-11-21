@props([
    'title' => 'Магазин',
])

<div class="header">
    <h3 class="header__title">{{ $title }}</h3>

    <div>
        @guest
            <a href="{{ route('auth.login') }}">
                <button>Войти</button>
            </a>
        @endguest

        @auth
            <a href="{{ route('profile.index') }}">
                <button>Личный кабинет</button>
            </a>
        @endauth
    </div>
</div>

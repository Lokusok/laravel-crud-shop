<x-layouts.main title="Профиль">
    <x-header title="Личный кабинет" />

    <x-sub-header>
        <nav class="nav">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="{{ route('articles.index') }}" class="nav__link">Главная</a>
                </li>
            </ul>
        </nav>
    </x-sub-header>

    <x-content>
        <div class="profile">
            <h3 class="profile__title">
                Профиль
            </h3>

            <div class="profile__info">
                <div class="profile__field">
                    <div class="profile__key">Имя:</div>
                    <div class="profile__value">{{ Auth::user()->name }}</div>
                </div>

                <div class="profile__field">
                    <div class="profile__key">Телефон:</div>
                    <div class="profile__value">{{ Auth::user()->phone }}</div>
                </div>

                <div class="profile__field">
                    <div class="profile__key">email:</div>
                    <div class="profile__value">{{ Auth::user()->email }}</div>
                </div>
            </div>
        </div>
    </x-content>
</x-layouts.main>

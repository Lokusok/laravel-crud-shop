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
</x-layouts.main>

<nav class="nav">
    <ul class="nav__list">
        <li class="nav__item">
            <x-nav.link :href="route('articles.index')">
                {{ __('Главная') }}
            </x-nav.link>
        </li>

        @auth
            <li class="nav__item">
                <x-nav.link :href="route('community.index')">
                    {{ __('Сообщество') }}
                </x-nav.link>
            </li>
        @endauth
    </ul>
</nav>

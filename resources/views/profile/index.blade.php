<x-layouts.main :title="__('Профиль')">
    <x-header :title="__('Личный кабинет')" />

    <x-sub-header>
        <x-nav />
    </x-sub-header>

    <x-content>
        <div class="profile">
            <h3 class="profile__title">
                {{ __('Профиль') }}
            </h3>

            <div class="profile__info">
                <div class="profile__field">
                    <div class="profile__key">{{ __('Имя') }}:</div>
                    <div class="profile__value">{{ Auth::user()->name }}</div>
                </div>

                <div class="profile__field">
                    <div class="profile__key">{{ __('Телефон') }}:</div>
                    <div class="profile__value">{{ Auth::user()->phone }}</div>
                </div>

                <div class="profile__field">
                    <div class="profile__key">{{ __('Почта') }}:</div>
                    <div class="profile__value">{{ Auth::user()->email }}</div>
                </div>
            </div>
        </div>
    </x-content>
</x-layouts.main>

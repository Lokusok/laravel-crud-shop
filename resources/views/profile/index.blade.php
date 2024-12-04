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

            <x-flash class="mb-2" name="message" />

            <div class="profile__info">
                <div class="profile__field">
                    <div class="profile__key">{{ __('Имя') }}:</div>
                    <div class="profile__value">{{ Auth::user()->name }}</div>
                </div>

                <div class="profile__field">
                    <div class="profile__key">{{ __('Телефон') }}:</div>
                    <div class="profile__value">{{ Auth::user()->phone ?? __('Нет') }}</div>
                </div>

                <div class="profile__field">
                    <div class="profile__key">{{ __('Аккаунт подтверждён') }}:</div>
                    <div class="profile__value" style="display: flex; column-gap: 10px;">
                        {{ Auth::user()->is_verified ? __('Да') : __('Нет (проверьте почту)') }}

                        @if ($showEmailVerifySend && !Auth::user()->is_verified)
                            <form action="{{ route('email.verify.resend') }}" method="POST">
                                @csrf

                                <button>{{ __('Переслать подтверждение') }}</button>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="profile__field">
                    <div class="profile__key">{{ __('Почта') }}:</div>
                    <div class="profile__value">{{ Auth::user()->email }}</div>
                </div>
            </div>
        </div>
    </x-content>
</x-layouts.main>

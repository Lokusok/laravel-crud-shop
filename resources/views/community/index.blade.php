<x-layouts.main :title="__('Сообщество')">
    <x-header :title="__('Корзина')" />

    <x-sub-header>
        <x-nav />
    </x-sub-header>

    <x-content>
        <x-title>
            {{ __('Сообщество') }}
        </x-title>

        <div class="chat">
            <div class="chat__feed">
                <div class="message message--from">
                    <span class="message__title">
                        Ivan Ivanovich
                    </span>

                    <p class="message__body">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe et quos nihil itaque hic ipsa ad
                        praesentium aspernatur voluptatibus. Temporibus!
                    </p>

                    <div class="message__footer">
                        {{ date('Y-m-d H:i:s') }}
                    </div>
                </div>

                <div class="message message--me">
                    <span class="message__title">
                        Vasily Vasilyevich
                    </span>

                    <p class="message__body">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe et quos nihil itaque hic ipsa ad
                        praesentium aspernatur voluptatibus. Temporibus!
                    </p>

                    <div class="message__footer">
                        {{ date('Y-m-d H:i:s') }}
                    </div>
                </div>
            </div>

            <div class="chat-actions">
                <form class="chat-actions__form" action="">
                    <textarea placeholder="{{ __('Ваше сообщение') }}" class="chat-actions__textarea" type="text"></textarea>
                    <button class="chat-actions__button">
                        {{ __('Отправить') }}
                    </button>
                </form>
            </div>
        </div>
    </x-content>
</x-layouts.main>

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
            <div x-data class="chat__feed">
                <template x-if="$store.chat.waiting">
                    <span>{{ __('Загрузка...') }}</span>
                </template>

                <template x-for="message in $store.chat.messages" :key="message.id">
                    <div class="message"
                        :class="{
                            'message--from': !message.from_me,
                            'message--me': message.from_me
                        }">
                        <span x-text="message.user.name" class="message__title"></span>

                        <p x-text="message.content" class="message__body"></p>

                        <div x-text="message.date" class="message__footer"></div>
                    </div>
                </template>
            </div>

            <div x-init="() => $store.chat.getMessages()" x-data class="chat-actions">
                <form @submit.prevent="() => $store.chat.sendMessage()" class="chat-actions__form">
                    <textarea x-model="$store.chat.content" id="chat-message" placeholder="{{ __('Ваше сообщение') }}"
                        class="chat-actions__textarea" type="text"></textarea>

                    <p x-show="$store.chat.error" x-text="$store.chat.error" id="chat-error"
                        class="chat-actions__error">

                    </p>

                    <button x-cloak :disabled="$store.chat.isSubmitDisabled" data-prevent-disable type="submit"
                        class="chat-actions__button">
                        {{ __('Отправить') }}
                    </button>
                </form>
            </div>
        </div>
    </x-content>
</x-layouts.main>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('chat', {
            waiting: true,

            error: '',
            isSubmitDisabled: false,
            content: '',

            messages: [],

            async getMessages() {
                this.waiting = true;

                try {
                    const response = await axios.get('{{ route('messages.index') }}');

                    this.messages = response.data.data;
                } catch (e) {
                    this.error = "{{ __('Произошла ошибка') }}";
                } finally {
                    this.waiting = false;
                }
            },

            async sendMessage() {
                this.isSubmitDisabled = true;
                this.error = '';

                const content = this.content.trim();

                try {
                    const response = await axios.post('{{ route('messages.store') }}', {
                        content
                    });

                    this.content = '';
                    this.messages.push(response.data.data);
                } catch (e) {
                    if (e.response.data.errors) {
                        const firstErrorKey = Object.keys(e.response.data.errors)[0];
                        const firstMessage = e.response.data.errors[firstErrorKey][0];

                        this.error = firstMessage;
                    }
                } finally {
                    this.isSubmitDisabled = false;
                }
            }
        });
    });
</script>

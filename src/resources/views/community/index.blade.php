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

                        <div class="message__footer">
                            <span x-text="message.date" class="message__date"></span>

                            <template x-if="message.from_me">
                                <button @click="(e) => $store.chat.handleClickDeleteButton(e, message)">
                                    {{ __('Удалить') }}
                                </button>
                            </template>
                        </div>
                    </div>
                </template>
            </div>

            <div x-init="() => {
                $store.chat.getMessages();
                $store.chat.startListen();
            }" x-data class="chat-actions">
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

            handleClickDeleteButton(event, message) {
                event.target.disabled = true;

                try {
                    this.deleteMessage(message.id)
                } catch (e) {
                    event.target.disabled = false;
                }
            },

            startListen() {
                console.log('Connected to test');

                setTimeout(() => {
                    Echo.channel('test')
                        .listen('.test-event', (data) => {
                            console.log('data: ', data);
                            this.messages.push(data);
                        });
                }, 3000);
            },

            async deleteMessage(messageId) {
                const response = await axios.delete(`/api/community/messages/${messageId}`);

                this.messages = this.messages.filter((m) => m.id !== messageId);
            },

            async getMessages() {
                this.waiting = true;

                try {
                    const response = await axios.get('{{ route('messages.index') }}');

                    this.messages = response.data.data;
                } catch (e) {
                    console.log('here', e);
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

{{-- <script>
    setTimeout(() => {
        console.log('Connected to test');

        Echo.channel('test')
            .listen('.test-event', (data) => {
                console.log('data: ', data);
            });
    }, 3000);
</script> --}}

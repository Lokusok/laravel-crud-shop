<div class="cart-modal">
    <div class="cart-modal__content">
        <x-header title="Корзина">
            <button @click="$store.cart.modal.close()">Закрыть</button>
        </x-header>

        <div class="cart-modal__info">
            <template x-data x-for="article in $store.cart.modal.articles" :key="article.id">
                <article class="article">
                    <div class="article__info">
                        <span x-text="article.id" class="article__id"></span>
                        <span x-text="article.title" class="article__title"></span>
                    </div>

                    <div class="article__actions">
                        <div class="article__entities">
                            <span x-text="`${article.price} ₽`" class="article__price"></span>

                            <template x-if="article.count > 0">
                                <span x-text="`${article.count} шт`" class="article__count"></span>
                            </template>
                        </div>

                        <button type="submit" class="article__buy"
                            @click="$store.cart.modal.deleteArticle(article.id)">
                            Удалить
                        </button>
                    </div>
                </article>
            </template>
        </div>

        <div class="cart-modal__result">
            <template x-data x-if="$store.cart.modal.totalSum">
                <div x-data x-text="`Итого: ${$store.cart.modal.totalSum} ₽`" class="cart-modal__price">
                </div>
            </template>
        </div>
    </div>
</div>

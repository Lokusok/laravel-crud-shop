@props([
    'title' => 'Laravel CRUD',
])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"
        integrity="sha512-DdX/YwF5e41Ok+AI81HI8f5/5UsoxCVT9GKYZRIzpLxb8Twz4ZwPPX+jQMwMhNQ9b5+zDEefc+dcvQoPWGNZ3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="content">
        {{ $slot }}
    </div>

    <template x-data x-if="$store.cart.modal.isOpen">
        <x-cart-modal />
    </template>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('cart', {

                modal: {
                    articles: [],
                    totalSum: null,

                    isOpen: false,

                    open() {
                        if (this.articles.length === 0) {
                            this.loadArticles();
                        }

                        this.isOpen = true;
                    },

                    close() {
                        this.isOpen = false;
                    },

                    async deleteArticle(id) {
                        const response = await axios.delete(
                            `http://localhost:8000/api/cart/current/${id}`);

                        this.articles = this.articles.filter((a) => {
                            if (a.id == id) {
                                if (a.count > 1) {
                                    a.count--;
                                    this.totalSum -= a.count * a.price;
                                } else {
                                    this.totalSum -= a.price;
                                    return false;
                                }
                            }

                            return a;
                        })
                    },

                    async loadArticles() {
                        const response = await axios.get('http://localhost:8000/api/cart/current');
                        const json = response.data;

                        this.articles = json.articles;
                        this.totalSum = json.total_sum;
                    },
                }
            })
        })
    </script>
</body>

</html>

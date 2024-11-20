<x-layouts.main title="Каталог">
    <x-header title="Магазин" />

    <x-basket :count="$count" :total-price="$totalPrice" />

    @foreach ($articles as $article)
        <x-article :id="$article->id" :price="$article->price" :title="$article->title" />
    @endforeach
</x-layouts.main>

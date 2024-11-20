@props([
    'title' => 'Магазин',
])

<div class="header">
    <h3 class="header__title">{{ $title }}</h3>

    @if ($slot->isNotEmpty())
        <div>
            {{ $slot }}
        </div>
    @endif
</div>

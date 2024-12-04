@props(['href'])

<a href="{{ $href }}" @class([
    'nav__link',
    'nav__link--current' => url()->current() === $href,
])>
    {{ $slot }}
</a>

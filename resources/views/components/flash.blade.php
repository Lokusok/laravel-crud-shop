@props(['name'])

@session($name)
    <div {{ $attributes->merge(['class' => 'flash']) }}>
        <p>{{ $value }}</p>
    </div>
@endsession

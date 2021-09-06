@props([
    'src',
    'target' => '_self'
])


<a href="{{ $src }}" target="{{ $target }}">
    <img {{ $attributes }}
        src="{{ $src }}" />
</a>
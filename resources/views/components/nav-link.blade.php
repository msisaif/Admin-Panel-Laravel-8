@props(['active'])

@php
$classes = ($active ?? false)
? 'inline-flex items-center px-3 py-1 mx-1 text-base font-bold rounded text-blue-700 bg-white border border-white'
: 'inline-flex items-center px-3 py-1 mx-1 text-base font-bold rounded text-white';
@endphp
<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $icon ?? '' }}
    {{ $slot }}
</a>
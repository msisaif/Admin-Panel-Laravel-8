@props(['href', 'value'])
<a href="{{ $href }}"
    {{ $attributes->merge(['class' => 'text-center font-bold cursor-pointer border border-purple-500 text-purple-600 hover:bg-purple-500 hover:text-white rounded-lg px-3 py-1.5']) }}>
    {!! $value ?? '&#8592; Go to list' !!}
    {{ $slot ?? '' }}
</a>
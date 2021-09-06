@props([
'text' => '',
'highlighter' => '',
])

@if($highlighter = preg_replace('/\s+/', '|', $highlighter))
@php
$text_with_highlighter = preg_filter("/{$highlighter}/i", '<mark>$0</mark>', $text);
@endphp
@endif

<span>{!! $text_with_highlighter ?? $text !!}</span>
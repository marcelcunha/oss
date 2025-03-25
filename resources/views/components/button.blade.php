@props(['color' => 'primary', 
'type' => 'button',
 'href' => null,
 'btn' => 'btn'])
@php
    $format = match ($color) {
        'primary' => 'btn-primary',
        'secondary' => 'btn-secondary',
        'danger' => 'btn-danger',
        'success' => 'btn-success',
        'warning' => 'btn-warning',
        'info' => 'btn-info',
        default => '',
    };
@endphp
@if (isset($href))
    <a href="{{ $href }}" {{ $attributes->except(['type', 'color', 'btn'])->merge(['class' => "{$btn} {$format}"]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->except('btn')->merge(['class' => "cursor-pointer {$btn} {$format}"]) }}>
        {{ $slot }}
    </button>
@endisset

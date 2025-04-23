@props(['color' => ''])
@php
    $colors = match ($color) {
        'warning' => 'bg-yellow-50 text-yellow-800 ring-yellow-600/20',
        'success' => 'bg-green-50 text-green-700 ring-green-600/20',
        'danger' => 'bg-red-50 text-red-600 ring-red-500/10',
        'info' => 'bg-blue-50 text-blue-700 ring-blue-500/10',
        'primary' => 'bg-blue-50 text-blue-700 ring-blue-500/10',
        default => 'bg-gray-50 text-gray-600 ring-gray-500/10',
    };
@endphp
<span
    class="{{ $colors }} inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset">
    {{ $slot }}
</span>

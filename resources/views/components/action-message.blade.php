@props(['type' => null])
@php
    $icon = match ($type) {
        'success' => 'check-circle',
        'danger' => 'exclamation-triangle',
        'warning' => 'exclamation',
        'info' => 'information-circle',
        default => null,
    };

    $bgColor = match ($type) {
        'success' => 'text-green-500',
        'danger' => 'text-red-500',
        'warning' => 'text-yellow-500',
        'info' => 'text-blue-500',
        default => 'text-gray-200',
    };
@endphp

<div x-data="{ shown: true, timeout: null }" x-init="() => { clearTimeout(timeout); timeout = setTimeout(() => { shown = false }, 2000);  }" x-show.transition.out.opacity.duration.1500ms="shown"
    x-transition:leave.opacity.duration.1500ms style="display: none;"
    {{ $attributes->merge(['class' => 'bg-gray-200 flex py-1 gap-2 px-2 w-80  rounded-sm fixed top-20 right-4 z-10 text-sm  ']) }}>
    @if (isset($icon))
        <x-dynamic-component :component="'heroicon-o-' . $icon" class='w-15 {{ $bgColor }}' />
    @endif


    <div class='flex justify-center items-center'>{{ $slot }}</div>

    <button class='flex justify-center items-center p-2  hover:cursor-pointer' @click="shown = false">
        <x-heroicon-o-x-mark class='w-4 h-4 stroke-2 rounded-sm hover:bg-gray-300' />
    </button>
</div>

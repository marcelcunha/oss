@props(['color' => '', 'icon' => null, 'label' => null, 'value' => null])

@php
    $bg = match($color) {
        'red' => 'bg-red-50',
        'green' => 'bg-green-50',
        'blue' => 'bg-blue-50',
        default => 'bg-indigo-500'
    };
@endphp
<div class="relative overflow-hidden rounded-lg bg-white px-4  py-5 shadow-sm sm:px-6 sm:pt-6">
    <dt>
        <div class="absolute rounded-md bg-indigo-500 p-3">
            <x-dynamic-component :component="'heroicon-o-' . $icon" class='size-6 text-white' />
        </div>
        <p class="ml-16 truncate text-sm font-medium text-gray-500">{{$label}}</p>
    </dt>
    <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
        <p class="text-2xl font-semibold text-gray-900">{{$value}}</p>
        {{-- <p class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
            <svg aria-hidden="true" class="size-5 shrink-0 self-center text-green-500" data-slot="icon"
                fill="currentColor" viewBox="0 0 20 20">
                <path clip-rule="evenodd"
                    d="M10 17a.75.75 0 0 1-.75-.75V5.612L5.29 9.77a.75.75 0 0 1-1.08-1.04l5.25-5.5a.75.75 0 0 1 1.08 0l5.25 5.5a.75.75 0 1 1-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0 1 10 17Z"
                    fill-rule="evenodd" />
            </svg>
            <span class="sr-only"> Increased by </span>
            122
        </p> --}}
    </dd>
</div>
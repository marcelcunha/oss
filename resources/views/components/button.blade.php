@if (isset($href))
    <a href="{{ $href }}"
        {{ $attributes->except('type')->merge(['class' => ' btn bg-gray-900 text-gray-100 hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white whitespace-nowrap']) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}"
        {{ $attributes->merge(['class' => 'cursor-pointer btn bg-gray-900 text-gray-100 hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white whitespace-nowrap']) }}>
        {{ $slot }}
    </button>
@endisset

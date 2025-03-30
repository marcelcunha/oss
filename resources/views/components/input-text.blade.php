<div class="flex flex-col {{ $parentClass }}">
    <x-label :value="$label" :for="$id" />

    <div class='mt-2 flex'>
        @isset($prefix)
            {{-- text-gray-800 dark:text-gray-100 leading-5 py-2 px-3 border-gray-200
         hover:border-gray-300 focus:border-gray-300 dark:border-gray-700/60 dark:hover:border-gray-600 
         dark:focus:border-gray-600 shadow-xs rounded-lg disabled:cursor-not-allowed 
        disabled:bg-gray-50 disabled:text-gray-500 disabled:border-solid disabled:outline-gray-200 sm:text-sm/6 --}}
            <div
                class="flex bg-gray-50 shrink-0 items-center shadow-xs rounded-l-lg border-r-0 px-3 text-base text-gray-500 0 sm:text-sm/6 border-gray-200 border">
                {{ $prefix }}
            </div>
        @endisset

        <x-input name='{{ $name }}' id='{{ $id }}' @class([
            'rounded-l-none' => isset($prefix),
            'rounded-r-none' => isset($suffix),
        ])
            {{ $attributes->except('parent-class') }} />

        @isset($suffix)
            <div
                class="flex bg-gray-50 shrink-0 items-center shadow-xs rounded-r-lg border-l-0 px-3 text-base text-gray-500 0 sm:text-sm/6 border-gray-200 border">
                {{ $suffix }}
            </div>
        @endisset
    </div>

    @error($name)
        <div class="text-red-500
            text-xs mt-1">
            {{ $message }}
        </div>
    @enderror
</div>

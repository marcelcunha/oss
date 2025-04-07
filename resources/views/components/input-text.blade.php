<div class="{{ $parentClass }} flex flex-col">
    <x-label :for="$id" :value="$label" />

    <div class='mt-2 flex'>
        @isset($prefix)
            <div @class([
                'shadow-xs 0 flex shrink-0 items-center rounded-l-lg border border-r-0 border-gray-200 bg-gray-50 px-3 text-base text-gray-500 sm:text-sm/6',
                'border-red-500' => $errors->has($getErrorAttribute())
            ])>
                {{ $prefix }}
            </div>
        @endisset

        <x-input {{ $attributes->except('parent-class') }} @class([
            'rounded-l-none' => isset($prefix),
           
            'rounded-r-none' => isset($suffix),
            'border-red-500' => $errors->has($getErrorAttribute()),
        ]) id='{{ $id }}'
            name='{{ $name }}' />

        @isset($suffix)
            <div
               @class(['shadow-xs 0 flex shrink-0 items-center rounded-r-lg border border-l-0 border-gray-200 bg-gray-50 px-3 text-base text-gray-500 sm:text-sm/6',
                'border-red-500' => $errors->has($getErrorAttribute())])>
                {{ $suffix }}
            </div>
        @endisset
    </div>

    @error($getErrorAttribute())
        <div class="mt-1 text-xs text-red-500">
            {{ $message }}
        </div>
    @enderror
</div>

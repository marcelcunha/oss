<div class="flex flex-col {{ $parentClass }}">
    <x-label :value='$label' :for="$id" />

    <textarea name='{{ $name }}' id='{{ $id }}' class='mt-2 form-textarea w-full'
        {{ $attributes->except('parent-class') }}>
       {{ $slot }}
    </textarea>

    @error($name)
        <div class="text-red-500 text-xs mt-1">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="flex flex-col {{ $parentClass }}">
    <x-label :value='$label' :for="$id" />

    <x-input name='{{ $name }}' id='{{ $id }}' class='mt-2'
        {{ $attributes->except('parent-class') }}/>

    @error($name)
        <div class="text-red-500 text-xs mt-1">
            {{ $message }}
        </div>
    @enderror
</div>

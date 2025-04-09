<div class="{{ $parentClass }} flex flex-col">
    <x-label :for="$id" :value='$label' />

    <textarea {{ $attributes->except(['parent-class', 'value']) }} class='form-textarea mt-2 w-full' id='{{ $id }}'
        name='{{ $name }}'>
@if (isset($value))
{{ $value }}
@endif{{ $slot }}
</textarea>

    @error($name)
        <div class="mt-1 text-xs text-red-500">
            {{ $message }}
        </div>
    @enderror
</div>

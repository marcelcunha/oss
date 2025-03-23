<div class='flex flex-col'>
    <x-label :value='$label' :for="$id" />
    <x-input name='{{ $name }}' id='{{ $id }}' class='mt-2' {{ $attributes }}></x-input>
    @error($name)
        <div class="text-red-500 text-xs mt-1">
            {{ $message }}
        </div>
    @enderror
</div>

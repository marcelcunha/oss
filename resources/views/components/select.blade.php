<div class="flex flex-col {{ $parentClass }}">
    <x-label :value='$label' :for="$id" />

    <select name='{{ $name }}' id='{{ $id }}' class='mt-2 form-select w-full' {{ $attributes->except(['parent-class', 'value']) }} >
        @empty($options)
            {{ $slot }}
        @else
            @if (filled($placeholder))
                <option >{{ $placeholder }}</option>
            @endif

            @foreach ($options as $key => $option)
                <option value="{{ $key }}" @if($value == $key) selected @endif>{{ $option }}</option>
            @endforeach
        @endempty
    </select>

    @error($name)
        <div class="text-red-500 text-xs mt-1">
            {{ $message }}
        </div>
    @enderror
</div>

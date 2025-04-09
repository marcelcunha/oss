<div class="flex flex-col {{ $parentClass }}">
    <x-label :value='$label' :for="$id" />

    <select name='{{ $name }}' id='{{ $id }}' @class([
        'mt-2 form-select w-full',
        'border-red-500' => $errors->has($name),
    ])
        {{ $attributes->except(['parent-class', 'value']) }}>
        @empty($options)
            {{ $slot }}
        @else
            @if (!empty($placeholder) && empty($value))
                <option value=''>{{ $placeholder }}</option>
            @endif

            @foreach ($options as $key => $option)
                <option value="{{ $key }}" @if ($value == $key) selected @endif>{{ $option }}
                </option>
            @endforeach
        @endempty
    </select>

    @error($getErrorAttribute())
        <div class="text-red-500 text-xs mt-1">
            {{ $message }}
        </div>
    @enderror
</div>

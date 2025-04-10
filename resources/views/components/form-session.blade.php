@props(['parentClass' => '', 'label'])
<div @class(['flex flex-col md:flex-row gap-x-4 border-t pt-4 md:items-center', $parentClass])>
    <p class='font-bold md:w-36 lg:w-62 mb-4 md:mb-0'>{{ $label }}</p>
    <div {{ $attributes->merge(['class' => 'grid gap-x-4 flex-1']) }}>
        {{ $slot }}
    </div>
</div>

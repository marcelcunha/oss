@props(['parentClass' => '', 'label'])
<div @class(['flex gap-x-4 border-t pt-4 items-center', $parentClass])>
    <p class='font-bold w-62'>{{ $label }}</p>
    <div {{ $attributes->merge(['class' => 'grid gap-x-4 flex-1']) }}>
        {{ $slot }}
    </div>
</div>

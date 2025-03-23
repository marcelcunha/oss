<div  {{ $attributes->merge(['class' => 'col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-xs rounded-xl']) }}>
    <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60">
        <h2 class="font-semibold text-gray-800 dark:text-gray-100">{{ $label }}</h2>
    </header>
    <div class="p-3">
        {{ $slot }}
       
    </div>
    @if(isset($footer))
    <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60">
       {{ $footer }}
    </header>
    @endif
</div>
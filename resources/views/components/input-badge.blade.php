<div class="flex flex-col {{ $parentClass }}" x-data="badges()">
    <x-label :value='$label' :for="$id" />
    @if (isset($subLabel))
        <span>{{ $subLabel }}</span>
    @endif
    <x-input id='{{ $id }}' class='mt-2' x-model='item'
        @keydown="if($event.key === ';'){ addItem(); $event.preventDefault();}"
        {{ $attributes->except(['parent-class', 'items']) }} />

    <div class='flex gap-1 mt-1'>
        <template x-for="(cat, i) in items">

            <span
                class="inline-flex items-center gap-x-0.5 rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-gray-500/10 ring-inset">
                <span x-text='cat' :key='i'></span>
                <button type="button" @click='removeItem(i)'
                    class="group relative -mr-1 size-3.5 rounded-xs hover:bg-gray-500/20 cursor-pointer">
                    <span class="sr-only">Remove</span>
                    <svg viewBox="0 0 14 14" class="size-3.5 stroke-gray-600/50 group-hover:stroke-gray-600/75">
                        <path d="M4 4l6 6m0-6l-6 6" />
                    </svg>
                    <span class="absolute -inset-1"></span>
                </button>
            </span>
        </template>
    </div>
    @error($name)
        <div class="text-red-500 text-xs mt-1">
            {{ $message }}
        </div>
    @enderror
    
    @if ($errors->has($name . '.*'))

        <ul class="mt-1 text-red-500 text-xs">
            @foreach ($errors->get($name . '*') as $error)
                @foreach ($error as $message)
                    <li>{{ $message }}</li>
                @endforeach
            @endforeach
        </ul>
    @endif


    <template x-for="(cat, i) in items">
        <input type="hidden" name='{{ $name }}[]' :value='cat' :key='i' />
    </template>
</div>

@section('js')
    @parent
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('badges', () => ({
                items: @json($items),
                item: '',
                addItem() {
                    this.items.push(this.item);
                    this.item = '';
                },
                removeItem(i) {
                    this.items.splice(i, 1);
                },

            }));
        });
    </script>
@endsection

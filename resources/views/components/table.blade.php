<!-- Table -->
<div class="overflow-x-auto">
    <table class="table-auto w-full dark:text-gray-300">
        <!-- Table header -->
        <thead class="text-xs uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700/50 rounded-xs">
            <tr>
                @foreach ($header as $title)
                    <th class="p-2">
                        <div class="font-semibold text-left">{{ $title }}</div>
                    </th>
                @endforeach
                @if (isset($actions))
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Ações</div>
                    </th>
                @endif

            </tr>
        </thead>
        <!-- Table body -->
        <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
            @forelse ($lines as $line)
                <tr>
                    @foreach ($header as $name => $_)
                        <!-- Row -->
                        <td class="p-2">
                            {{ data_get($line, $name) }}
                        </td>
                    @endforeach
                    @if (isset($actions))
                        <td class="whitespace-nowrap">
                            @if (array_key_exists('show', $actions))
                                <x-button :href="route(data_get($actions, 'show'), $line->id)" class="h-7 w-7" color=secondary btn='btn-xs'>
                                    <x-heroicon-o-eye class=" text-gray-300" />
                                </x-button>
                            @endif
                            @if (array_key_exists('edit', $actions))
                                <x-button :href="route(data_get($actions, 'edit'), $line->id)" class="h-7 w-7" color=secondary btn='btn-xs'>
                                    <x-heroicon-o-pencil class=" text-gray-300" />
                                </x-button>
                            @endif
                            @if (array_key_exists('delete', $actions))
                                <x-button class="h-7 w-7" color=secondary btn='btn-xs'
                                    @click="show=true;name='{{ $line->name }}';route='{{ route(data_get($actions, 'delete'), $line->id) }}'">
                                    <x-heroicon-o-trash class="text-gray-300" />
                                </x-button>
                            @endif
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan='{{ isset($actions) ? count($header) + 1 : count($header) }}' class="p-2 text-center">Não há
                        registros para esse recurso</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

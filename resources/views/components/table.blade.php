<!-- Table -->
<div class="overflow-x-auto">
    <table class="table-auto w-full dark:text-gray-300">
        <!-- Table header -->
        <thead class="text-xs uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700/50 rounded-xs">
            <tr>
                @foreach ($getTitles() as $title)
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
            @forelse ($rows as $row)
                <tr>
                    @foreach ($getColumns() as $column)
                        <!-- Row -->
                        <td class="p-2">
                            @if ($isCustomCell($column) && isset($cell))
                                <!-- Se o slot 'cells' existir, renderiza o conteúdo customizado -->
                                {{ $cell($row) }}
                            @else
                                <!-- Se não houver slot, exibe normalmente -->
                                {{ data_get($row, $column, '') }}
                            @endisset
                    </td>
                @endforeach
                @if (isset($actions))
                    <td class="whitespace-nowrap">
                        @if (array_key_exists('show', $actions))
                            <x-button :href="route(data_get($actions, 'show'), $row->id)" class="h-7 w-7" color=secondary btn='btn-xs'>
                                <x-heroicon-o-eye class=" text-gray-300" />
                            </x-button>
                        @endif
                        @if (array_key_exists('edit', $actions))
                            <x-button :href="route(data_get($actions, 'edit'), $row->id)" class="h-7 w-7" color=secondary btn='btn-xs'>
                                <x-heroicon-o-pencil class=" text-gray-300" />
                            </x-button>
                        @endif
                        @if (array_key_exists('delete', $actions))
                            <x-button class="h-7 w-7" color=secondary btn='btn-xs'
                                @click="show=true;name='{{ $row->name }}';route='{{ route(data_get($actions, 'delete'), $row->id) }}'">
                                <x-heroicon-o-trash class="text-gray-300" />
                            </x-button>
                        @endif
                    </td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan='{{ $totalColumns }}' class="p-2 text-center">
                    Não há
                    registros para esse recurso</td>
            </tr>
        @endforelse
    </tbody>
</table>

</div>

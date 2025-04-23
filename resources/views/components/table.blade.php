<!-- Table -->
<div @class([
    'overflow-x-auto',
    $parentClass,
    'border rounded-xl border-gray-100' => $border,
    'border rounded-xl border-red-500' => $borderRed,
])>
    <table class="w-full table-auto dark:text-gray-300">
        <!-- Table header -->
        <thead class="rounded-xs bg-gray-50 text-xs uppercase text-gray-400 dark:bg-gray-700/50 dark:text-gray-500">
            <tr>
                @foreach ($getTitles() as $title)
                    <th class="p-2">
                        <div class="text-left font-semibold">{{ $title }}</div>
                    </th>
                @endforeach
                @if (!empty($actions))
                    <th class="whitespace-nowrap p-2">
                        <div class="text-left font-semibold">Ações</div>
                    </th>
                @endif

            </tr>
        </thead>
        <!-- Table body -->
        <tbody class="divide-y divide-gray-100 text-sm font-medium dark:divide-gray-700/60">
            @if (isset($rows))
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

                                    {{ $formatCell($column, $row) }}
                                @endisset
                        </td>
                    @endforeach
                    @if (isset($actions))
                        <td class="whitespace-nowrap">
                            @if (array_key_exists('show', $actions))
                                <x-button :href="route(data_get($actions, 'show'), $row->id)" btn='btn-xs' class="h-7 w-7" color=secondary>
                                    <x-heroicon-o-eye class="text-gray-300" />
                                </x-button>
                            @endif
                            @if (array_key_exists('edit', $actions))
                                <x-button :href="route(data_get($actions, 'edit'), $row->id)" btn='btn-xs' class="h-7 w-7" color=secondary>
                                    <x-heroicon-o-pencil class="text-gray-300" />
                                </x-button>
                            @endif
                            @if (array_key_exists('delete', $actions))
                                <x-button
                                    @click="show=true;name='{{ $row->name }}';route='{{ route(data_get($actions, 'delete'), $row->id) }}'"
                                    btn='btn-xs' class="h-7 w-7" color=secondary>
                                    <x-heroicon-o-trash class="text-gray-300" />
                                </x-button>
                            @endif
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td class="p-2 text-center" colspan='{{ $totalColumns }}'>
                        Não há
                        registros para esse recurso</td>
                </tr>
            @endforelse
        @else
            {{ $slot }}
        @endif
    </tbody>
    <!-- Table footer -->
    @if (isset($footer))
        <tfoot>
            {{ $footer }}
        </tfoot>
    @endif
</table>

</div>

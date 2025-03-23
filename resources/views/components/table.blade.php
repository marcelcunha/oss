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
                    Ações
                @endif

            </tr>
        </thead>
        <!-- Table body -->
        <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
            @foreach ($lines as $line)
                <tr>
                    @foreach ($header as $name => $_)
                        <!-- Row -->
                        <td class="p-2">
                            {{ data_get($line, $name) }}
                        </td>
                    @endforeach
                    @if (isset($actions))
                        <td>
                            {{ $actions }}
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

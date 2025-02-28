<div class="overflow-x-auto">
    <table class="w-full min-w-max divide-y divide-gray-200 border border-gray-300 rounded-lg shadow-sm hidden md:table">
        <thead class="bg-gray-50">
        <tr>
            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border">
                <input type="checkbox" wire:click="toggleSelectAll"
                       class="h-5 w-5 text-blue-500 border-gray-300 rounded focus:ring-2 focus:ring-blue-400 transition">
            </th>
            @foreach($columns as $column)
                @if(!in_array($column, $hiddenColumns))
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border cursor-pointer hover:bg-gray-100 transition"
                        wire:click="sortBy('{{ $column }}')">
                        <div class="flex items-center">
                            {{ $columnLabels[$column] ?? ucfirst(str_replace('_', ' ', $column)) }}
                            @if ($sortColumn === $column)
                                <span class="ml-2 text-blue-500">
                                    @if ($sortDirection === 'asc')
                                        ▲
                                    @else
                                        ▼
                                    @endif
                                </span>
                            @endif
                        </div>
                    </th>
                @endif
            @endforeach
            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border">
                {{ __('datatable::datatables.actions') }}
            </th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @foreach($rows as $row)
            <tr class="hover:bg-gray-100 transition cursor-pointer"
                wire:click.prevent="toggleRowSelection({{ $row->id }})">
                <td class="px-4 py-3 border">
                    <input type="checkbox" wire:model="selectedRows"
                           value="{{ $row->id }}"
                           class="h-5 w-5 text-blue-500 border-gray-300 rounded focus:ring-2 focus:ring-blue-400 transition"
                           onclick="event.stopPropagation();">
                </td>
                @foreach($columns as $column)
                    @if(!in_array($column, $hiddenColumns))
                        <td class="px-4 py-3 border text-sm text-gray-700">
                            {{ $row->$column }}
                        </td>
                    @endif
                @endforeach
                <td class="px-4 py-3 border">
                    @includeIf($actionsView, ['row' => $row])
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@includeIf('datatable::components.mobile.table')

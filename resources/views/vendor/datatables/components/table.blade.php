<div class="overflow-x-auto">
    <table class="w-full min-w-max divide-y divide-gray-200 border border-gray-300 rounded-lg shadow-sm hidden md:table">
        <thead class="bg-gray-50">
        <tr>
            @if (count($bulkActions) > 0)
            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border">
                <input type="checkbox" wire:click="toggleSelectAll"
                       class="h-5 w-5 text-blue-500 border-gray-300 rounded focus:ring-2 focus:ring-blue-400 transition">
            </th>
            @endif
            @foreach($columns as $column)
                @if(!in_array($column['column'], $hiddenColumns))
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border cursor-pointer hover:bg-gray-100 transition"
                        wire:click="sortBy('{{ $column['column'] }}')">
                        <div class="flex items-center">
                            {{ ucfirst($column['label']) }}
                            @if ($sortColumn === $column['column'])
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
                @if (count($bulkActions) > 0)
                <td class="px-4 py-3 border">
                    <input type="checkbox" wire:model="selectedRows"
                           value="{{ $row->id }}"
                           class="h-5 w-5 text-blue-500 border-gray-300 rounded focus:ring-2 focus:ring-blue-400 transition"
                           onclick="event.stopPropagation();">
                </td>
                @endif
                @foreach($columns as $column)
                    @if(!in_array($column['column'], $hiddenColumns))
                        <td class="px-4 py-3 border text-sm text-gray-700">
                            {{ $row->{$column['column']} }}
                        </td>
                    @endif
                @endforeach
                <td class="px-4 py-3 border">
                    @includeIf($rowActionView, ['row' => $row])
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@includeIf('datatable::components.mobile.table')

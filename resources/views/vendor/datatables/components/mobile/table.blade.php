<div class="block md:hidden">
    @foreach($rows as $row)
        <div class="bg-white rounded-lg shadow-md p-4 mb-4 border border-gray-300">
            <div class="flex items-center justify-between mb-3">
                <strong class="text-gray-800">#{{ $row->id }}</strong>
                <input type="checkbox" wire:model="selectedRows"
                       wire:change="$dispatch('refreshTable')"
                       value="{{ $row->id }}"
                       class="h-5 w-5 text-blue-500 border-gray-300 rounded focus:ring-2 focus:ring-blue-400 transition">
            </div>
            <div class="grid gap-2 text-sm text-gray-700">
                @foreach($columns as $column)
                    @if(!in_array($column, $hiddenColumns))
                        <div class="flex justify-between border-b pb-1">
                            <strong>{{ $columnLabels[$column] ?? ucfirst(str_replace('_', ' ', $column)) }}:</strong>
                            <span>{{ $row->$column }}</span>
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- ✅ Acties onderaan voor mobiel --}}
            <div class="mt-3 flex flex-wrap gap-2">
                @includeIf($actionsView, ['row' => $row])
            </div>
        </div>
    @endforeach
</div>

<div>
    {{-- 🔍 Zoekbalk --}}
    <div class="flex items-center mb-4">
        <input type="text" wire:model.debounce.500ms="search" placeholder="Zoeken..." class="border px-3 py-1 rounded">
        <select wire:model="perPage" class="ml-2 border px-2 py-1 rounded">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
    </div>

    {{-- 📊 Datatable --}}
    <table class="border-collapse border border-gray-300 w-full">
        <thead>
        <tr>
            @foreach($columns as $column)
                <th class="border border-gray-300 p-2">
                    <a wire:click="sortBy('{{ $column }}')" class="cursor-pointer">
                        {{ ucfirst($column) }}
                        @if ($sortColumn === $column)
                            <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
            @endforeach
            @if (!empty($actions))
                <th class="border border-gray-300 p-2">Acties</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($rows as $row)
            <tr>
                @foreach($columns as $column)
                    <td class="border border-gray-300 p-2">{{ $row->$column }}</td>
                @endforeach
                @if (!empty($actions))
                    <td class="border border-gray-300 p-2">
                        @foreach($actions as $action)
                            <a href="{{ route($action['route'], ['id' => $row->id]) }}" class="text-blue-500">{{ $action['label'] }}</a>
                        @endforeach
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>

    {{-- Paginering --}}
    <div class="mt-4">
        {{ $rows->links() }}
    </div>
</div>

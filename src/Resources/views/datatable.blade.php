<div wire:loading.class="opacity-50">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            {{-- 🔍 Zoekbalk --}}
            <div class="flex justify-between items-center mb-4">
                {{-- 🔍 Zoekbalk met knop --}}
                <div class="flex items-center gap-2">
                    <input type="text" wire:model="search"
                           placeholder="Zoekterm..."
                           class="border border-gray-300 rounded px-3 py-1 text-sm w-64">

                    {{-- Zoekknop --}}
                    <button wire:click="applySearch"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                        Zoeken
                    </button>

                    {{-- Resetknop --}}
                    <button wire:click="resetSearch"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-3 py-1 rounded text-sm">
                        Reset
                    </button>
                </div>
            </div>


            {{-- Selectie aantal resultaten per pagina --}}
            <div class="flex items-center gap-2">
                <label for="perPage" class="text-sm text-gray-600">Resultaten per pagina:</label>
                <select wire:change="updatePerPage($event.target.value)" id="perPage"
                        class="border border-gray-300 rounded px-3 py-1 text-sm w-24">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>

        <div class="flex justify-between items-center mb-4">
            {{-- ✅ Bulkactie dropdown - Alleen tonen als er rijen geselecteerd zijn --}}
            <div class="flex items-center gap-2" wire:key="bulk-actions">
                @if(count($selectedRows) > 0)
                    <select wire:model="bulkAction"
                            class="border border-gray-300 rounded px-3 py-1 text-sm w-48">
                        <option value="">-- Kies een actie --</option>
                        @foreach($bulkActions as $key => $action)
                            <option value="{{ $key }}">{{ $action['label'] }}</option>
                        @endforeach
                    </select>

                    <button wire:click="executeBulkAction"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                        Uitvoeren
                    </button>
                @endif
            </div>
        </div>

        <div wire:loading.class="opacity-50">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 border border-gray-300 rounded-lg">
                    <thead class="bg-gray-100">
                    <tr>
                        {{-- "Selecteer alles" checkbox --}}
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border">
                            <input type="checkbox" wire:click="toggleSelectAll"
                                   class="h-4 w-4 text-blue-500 border-gray-300 rounded">
                        </th>
                        @foreach($columns as $column)
                            @if(!in_array($column, $hiddenColumns))
                                {{-- 🟢 Alleen tonen als niet hidden --}}
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border cursor-pointer"
                                    wire:click="sortBy('{{ $column }}')">
                                    <div class="flex items-center">
                                        {{ $columnLabels[$column] ?? ucfirst(str_replace('_', ' ', $column)) }}
                                        @if ($sortColumn === $column)
                                            <span class="ml-2">
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
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border">Acties</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($rows as $row)
                        <tr class="hover:bg-gray-100 transition cursor-pointer"
                            wire:click.prevent="toggleRowSelection({{ $row->id }})">
                            <td class="px-4 py-3 border">
                                <input type="checkbox" wire:model="selectedRows"
                                       value="{{ $row->id }}"
                                       class="h-4 w-4 text-blue-500 border-gray-300 rounded"
                                       onclick="event.stopPropagation();">
                            </td>

                            @foreach($columns as $column)
                                @if(!in_array($column, $hiddenColumns))
                                    {{-- 🟢 Alleen tonen als niet hidden --}}
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
        </div>

        {{-- Paginering --}}
        <div class="mt-4 flex justify-between items-center">
    <span class="text-sm text-gray-600">
        Pagina {{ $rows->currentPage() }} van {{ $rows->lastPage() }} - {{ $rows->total() }} resultaten
    </span>

            <div class="flex gap-2">
                {{-- Vorige knop --}}
                <button wire:click="previousPage"
                        class="px-4 py-2 rounded {{ $rows->onFirstPage() ? 'bg-gray-200 text-gray-400 cursor-not-allowed' : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}"
                        {{ $rows->onFirstPage() ? 'disabled' : '' }}>
                    Vorige
                </button>

                {{-- ✅ Als er 10 of minder pagina’s zijn: toon paginanummers als knoppen --}}
                @if ($rows->lastPage() <= 10)
                    @for ($page = 1; $page <= $rows->lastPage(); $page++)
                        <button wire:click="gotoPage({{ $page }})"
                                class="px-4 py-2 rounded {{ $rows->currentPage() == $page ? 'bg-blue-500 text-white' : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}">
                            {{ $page }}
                        </button>
                    @endfor
                @else
                    {{-- ✅ Meer dan 10 pagina’s: gebruik een dropdown --}}
                    <select wire:change="gotoPage($event.target.value)"
                            class="border border-gray-300 rounded px-3 py-1 text-sm w-16">
                        @for ($page = 1; $page <= $rows->lastPage(); $page++)
                            <option value="{{ $page }}" {{ $rows->currentPage() == $page ? 'selected' : '' }}>
                                {{ $page }}
                            </option>
                        @endfor
                    </select>
                @endif

                {{-- Volgende knop --}}
                <button wire:click="nextPage"
                        class="px-4 py-2 rounded {{ $rows->hasMorePages() ? 'bg-gray-100 hover:bg-gray-200 text-gray-700' : 'bg-gray-200 text-gray-400 cursor-not-allowed' }}"
                        {{ $rows->hasMorePages() ? '' : 'disabled' }}>
                    Volgende
                </button>
            </div>
        </div>
    </div>

    @if($showSelectAllModal)
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-lg font-semibold mb-4">Selecteer alle rijen?</h2>
                <p class="text-gray-700 text-sm mb-4">
                    Wil je alleen de zichtbare rijen op deze pagina selecteren, of alle rijen in de database?
                </p>
                <div class="flex justify-end gap-3">
                    <button wire:click="confirmSelectAll('visible')"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Alleen zichtbare
                    </button>
                    <button wire:click="confirmSelectAll('all')"
                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                        Alle rijen
                    </button>
                    <button wire:click="cancelSelectAll"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded">
                        Annuleren
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

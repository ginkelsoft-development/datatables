<div x-data="{ open: @entangle('showFilters') }" class="relative">

    <button @click="open = !open"
            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1 rounded-lg text-sm flex items-center gap-1 shadow-sm transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 011 1v1.5l-4.5 5.5V15a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3L3 6.5V5zm2 1v.378L9.5 12.5V15h1v-2.5l4.5-6.122V6H5z" clip-rule="evenodd"/>
        </svg>
        {{ __('datatable::datatables.filters') }}
    </button>

    <div class="flex flex-wrap gap-2 mt-3">
        @foreach($filters as $key => $filter)
            @if(is_array($filter) && isset($filter['column'], $filter['value']) && !empty($filter['value']))
                <div class="flex items-center bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                    {{ ucfirst(str_replace('_', ' ', $filter['column'])) }}:
                    <span class="font-semibold ml-1">{{ $filter['value'] }}</span>

                    {{-- ❌ Sluitknopje om filter te verwijderen --}}
                    <button wire:click="removeFilter('{{ $key }}')"
                            class="ml-2 text-red-600 hover:text-red-800">
                        ✕
                    </button>
                </div>
            @endif
        @endforeach
    </div>

    <div x-show="open" x-cloak
         @click.away="open = false"
         class="absolute left-0 mt-2 w-96 bg-white border border-gray-300 rounded-lg shadow-lg p-4 z-50 transition transform origin-top opacity-100 scale-100">
        <div class="flex flex-wrap gap-4">
            @foreach($filters as $column => $filter)
                @if(isset($filter['type']))
                    @includeIf("datatable::filters.types.{$filter['type']}", ['filter' => $filter])
                @endif
            @endforeach
        </div>

        <div class="mt-4 flex justify-end gap-2">
            <button wire:click="applyFilters"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm shadow-sm transition">
                {{ __('datatable::datatables.apply_filters') }}
            </button>
            <button type="button" wire:click="resetFilters"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg text-sm shadow-sm transition">
                {{ __('datatable::datatables.reset') }}
            </button>
        </div>
    </div>
</div>


    <input type="text" wire:model="search"
           placeholder="{{ __('datatable::datatables.search') }}"
           class="border border-gray-300 rounded-lg px-4 py-2 text-sm w-64 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">

    <button wire:click="applySearch"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm shadow-sm transition">
        {{ __('datatable::datatables.search') }}
    </button>

    <button wire:click="resetSearch"
            class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg text-sm shadow-sm transition">
        {{ __('datatable::datatables.reset') }}
    </button>

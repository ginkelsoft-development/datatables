<input type="text" wire:model.debounce.500ms="search"
       @keydown.enter="$dispatch('searchUpdated')"
       @blur="$dispatch('searchUpdated')"
       placeholder="{{ __('datatable::datatables.search') }}"
       class="border border-gray-300 rounded-lg px-4 py-2 text-sm w-96 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">

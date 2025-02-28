<div class="block md:hidden flex justify-between items-center mt-4">
    <button wire:click="previousPage"
            class="px-4 py-2 rounded-lg text-sm shadow-sm transition {{ $currentPage === 1 ? 'bg-gray-200 text-gray-400 cursor-not-allowed' : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}"
            {{ $currentPage === 1 ? 'disabled' : '' }}>
        {{ __('datatable::datatables.previous') }}
    </button>

    <span class="text-sm text-gray-600">
        {{ __('datatable::datatables.page') }} {{ $currentPage }} {{ __('datatable::datatables.of') }} {{ $rows->lastPage() }}
    </span>

    <button wire:click="nextPage"
            class="px-4 py-2 rounded-lg text-sm shadow-sm transition {{ $currentPage === $rows->lastPage() ? 'bg-gray-200 text-gray-400 cursor-not-allowed' : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}"
            {{ $currentPage === $rows->lastPage() ? 'disabled' : '' }}>
        {{ __('datatable::datatables.next') }}
    </button>
</div>

<div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white p-6 rounded-xl shadow-xl w-96">
        <h2 class="text-lg font-semibold mb-4 text-gray-800">{{ __('datatable::datatables.select_all_rows') }}</h2>
        <p class="text-gray-600 text-sm mb-4">
            {{ __('datatable::datatables.select_all_question') }}
        </p>
        <div class="flex justify-end gap-3">
            <button wire:click="confirmSelectAll('visible')"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow-sm transition">
                {{ __('datatable::datatables.select_all_visible_rows') }}
            </button>
            <button wire:click="confirmSelectAll('all')"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow-sm transition">
                {{ __('datatable::datatables.select_all_rows') }}
            </button>
            <button wire:click="cancelSelectAll"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg shadow-sm transition">
                {{ __('datatable::datatables.cancel') }}
            </button>
        </div>
    </div>
</div>

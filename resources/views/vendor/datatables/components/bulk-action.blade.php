<label class="text-sm text-gray-600">{{ __('datatable::datatables.bulk_actions') }}</label>
<select wire:model="bulkAction"
        class="border border-gray-300 rounded-lg px-3 py-2 text-sm w-48 focus:ring-2 focus:ring-blue-400 transition">
    <option value="">{{ __('datatable::datatables.select_option') }}</option>
    @foreach($bulkActions as $key => $action)
        <option value="{{ $key }}">{{ $action['label'] }}</option>
    @endforeach
</select>

<button wire:click="executeBulkAction"
        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm shadow-sm transition">
    {{ __('datatable::datatables.execute') }}
</button>

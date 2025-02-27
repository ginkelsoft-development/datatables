<div>
    <label class="text-sm font-medium text-gray-600">{{ ucfirst(str_replace('_', ' ', $filter['column'])) }}</label>
    <select wire:model.defer="filters.{{ $filter['column'] }}.value"
            class="border border-gray-300 rounded px-3 py-1 text-sm w-48">
        <option value="">{{ __('datatable::datatables.select_option') }}</option>
        @foreach($filter['options'] as $key => $option)
            <option value="{{ $key }}">{{ $option }}</option>
        @endforeach
    </select>
</div>

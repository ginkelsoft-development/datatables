<div>
    <label class="text-sm font-medium text-gray-600">{{ ucfirst(str_replace('_', ' ', $filter['column'])) }}</label>
    <input type="date" wire:model.defer="filters.{{ $filter['column'] }}.value"
           class="border border-gray-300 rounded px-3 py-1 text-sm w-48">
</div>

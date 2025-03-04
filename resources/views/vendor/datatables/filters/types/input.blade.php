<div>
    <label class="text-sm font-medium text-gray-600">{{ ucfirst($filter['label']) }}</label>
    <input type="text" wire:model.defer="filters.{{ $column }}.value"
           class="border border-gray-300 rounded px-3 py-1 text-sm w-48">
</div>

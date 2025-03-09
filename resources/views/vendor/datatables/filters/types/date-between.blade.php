<div>
    <label class="text-sm font-medium text-gray-600">{{ ucfirst($filter['label']) }}</label>
    <div class="flex space-x-2 mt-1">
        <input type="date" wire:model.defer="filters.{{ $column }}.value.from"
               class="border border-gray-300 rounded px-3 py-1 text-sm w-48"
               placeholder="Start date">
        <span class="text-gray-500">-</span>
        <input type="date" wire:model.defer="filters.{{ $column }}.value.to"
               class="border border-gray-300 rounded px-3 py-1 text-sm w-48"
               placeholder="End date">
    </div>
</div>

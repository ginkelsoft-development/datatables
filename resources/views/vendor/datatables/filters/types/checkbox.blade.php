<div class="flex items-center gap-2">
    <input type="checkbox" wire:model.defer="filters.{{ $column }}.value"
           class="h-4 w-4 text-blue-500 border-gray-300 rounded">
    <label class="text-sm font-medium text-gray-600">{{ ucfirst($filter['label']) }}</label>
</div>

<div>
    <label class="text-sm font-medium text-gray-600 block">{{ ucfirst(str_replace('_', ' ', $filter['column'])) }}</label>
    <div class="flex gap-2">
        @foreach($filter['options'] as $key => $option)
            <label class="flex items-center gap-1 text-sm">
                <input type="radio" wire:model.defer="filters.{{ $filter['column'] }}.value" value="{{ $key }}"
                       class="h-4 w-4 text-blue-500 border-gray-300 rounded">
                {{ $option }}
            </label>
        @endforeach
    </div>
</div>

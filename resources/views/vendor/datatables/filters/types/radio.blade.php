<div>
    <label class="text-sm font-medium text-gray-600 block">{{ ucfirst($filter['label']) }}</label>
    <div class="flex gap-2">
        @foreach($filter['options'] as $key => $option)
            <label class="text-sm font-medium text-gray-700">{{ ucfirst($filter['label']) }}
                <input type="radio" wire:model.defer="filters.{{ $column }}.value" value="{{ $key }}"
                       class="h-4 w-4 text-blue-500 border-gray-300 rounded">
                {{ $option }}
            </label>
        @endforeach
    </div>
</div>

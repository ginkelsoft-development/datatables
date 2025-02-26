<div class="flex items-center space-x-2">
        @foreach($actions as $action)
                <a href="{{ route($action['route'], $row->id) }}"
                   class="{{ $action['class'] ?? 'px-2 py-1 text-sm font-medium text-white bg-blue-500 rounded hover:bg-blue-600' }}"
                   style="{{ $action['style'] ?? '' }}"
                   onclick="event.stopPropagation();">
                        {{ $action['label'] }}
                </a>
        @endforeach
</div>

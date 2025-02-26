<div class="flex items-center space-x-2">
    @foreach($actions as $action)
        <a href="{{ route($action['route'], $row->id) }}"
           onclick="event.stopPropagation();"
        @foreach($action['attributes'] ?? [] as $key => $value)
            {{ $key }}="{{ $value }}"
        @endforeach
        >
        {{ $action['label'] }}
        </a>
    @endforeach
</div>

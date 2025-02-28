<div class="flex items-center space-x-2">
        @foreach($actions as $action)
                <a href="{{ isset($action['route']) ? route($action['route'], $row->id) : (isset($action['url']) ? str_replace('{id}', $row->id, $action['url']) : '#') }}"
                   onclick="event.stopPropagation();"
                @foreach($action['attributes'] ?? [] as $key => $value)
                        {{ $key }}="{{ $value }}"
                @endforeach>
                {{ $action['label'] }}
                </a>
        @endforeach
</div>

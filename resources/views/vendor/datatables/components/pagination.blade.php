<div class="mt-4 flex justify-between items-center">
                <span class="text-sm text-gray-600">
                    {{ __('datatable::datatables.page') }} {{ $rows->currentPage() }} van {{ $rows->lastPage() }} - {{ $rows->total() }} {{ __('datatable::datatables.results') }}
                </span>

    <div class="flex gap-2">
        <button wire:click="previousPage"
                class="px-4 py-2 rounded {{ $rows->onFirstPage() ? 'bg-gray-200 text-gray-400 cursor-not-allowed' : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}"
                {{ $rows->onFirstPage() ? 'disabled' : '' }}>
            {{ __('datatable::datatables.previous') }}
        </button>

        @if ($rows->lastPage() <= 10)
            @for ($page = 1; $page <= $rows->lastPage(); $page++)
                <button wire:click="gotoPage({{ $page }})"
                        class="px-4 py-2 rounded {{ $rows->currentPage() == $page ? 'bg-blue-500 text-white' : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}">
                    {{ $page }}
                </button>
            @endfor
        @else

            <select wire:change="gotoPage($event.target.value)"
                    class="border border-gray-300 rounded px-3 py-1 text-sm w-16">
                @for ($page = 1; $page <= $rows->lastPage(); $page++)
                    <option value="{{ $page }}" {{ $rows->currentPage() == $page ? 'selected' : '' }}>
                        {{ $page }}
                    </option>
                @endfor
            </select>
        @endif

        {{-- Volgende knop --}}
        <button wire:click="nextPage"
                class="px-4 py-2 rounded {{ $rows->hasMorePages() ? 'bg-gray-100 hover:bg-gray-200 text-gray-700' : 'bg-gray-200 text-gray-400 cursor-not-allowed' }}"
                {{ $rows->hasMorePages() ? '' : 'disabled' }}>
            {{ __('datatable::datatables.next') }}
        </button>
    </div>
</div>

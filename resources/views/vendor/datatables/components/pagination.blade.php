<div class="mt-4 flex justify-between items-center">
    <span class="text-sm text-gray-600">
        {{ __('datatable::datatables.page') }} {{ $currentPage }} {{ __('datatable::datatables.of') }} {{ $rows->lastPage() }} - {{ $rows->total() }} {{ __('datatable::datatables.results') }}
    </span>
    <div class="hidden md:flex gap-2">
        <button wire:click="previousPage"
                class="px-4 py-2 rounded {{ $currentPage === 1 ? 'bg-gray-200 text-gray-400 cursor-not-allowed' : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}"
                {{ $currentPage === 1 ? 'disabled' : '' }}>
            {{ __('datatable::datatables.previous') }}
        </button>

        @if ($rows->lastPage() <= 10)
            @for ($page = 1; $page <= $rows->lastPage(); $page++)
                <button wire:click="gotoPage({{ $page }})"
                        class="px-4 py-2 rounded {{ $currentPage == $page ? 'bg-blue-500 text-white' : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}">
                    {{ $page }}
                </button>
            @endfor
        @else
            <select wire:change="gotoPage($event.target.value)"
                    class="border border-gray-300 rounded px-3 py-1 text-sm w-16">
                @for ($page = 1; $page <= $rows->lastPage(); $page++)
                    <option value="{{ $page }}" {{ $currentPage == $page ? 'selected' : '' }}>
                        {{ $page }}
                    </option>
                @endfor
            </select>
        @endif

        <button wire:click="nextPage"
                class="px-4 py-2 rounded {{ $currentPage === $rows->lastPage() ? 'bg-gray-200 text-gray-400 cursor-not-allowed' : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}"
                {{ $currentPage === $rows->lastPage() ? 'disabled' : '' }}>
            {{ __('datatable::datatables.next') }}
        </button>
    </div>
</div>

@includeIf('datatable::components.mobile.pagination')

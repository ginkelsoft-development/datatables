<div class="hidden md:block">
    <select wire:change="updatePerPage($event.target.value)" id="perPage"
            class="border border-gray-300 rounded-lg px-3 py-2 text-sm w-24 focus:ring-2 focus:ring-blue-400 transition">
        @foreach(config('datatable.per_page.options') as $perPage)
            <option value="{{ $perPage }}" @if($perPage == $this->perPage) selected @endif>{{ $perPage }}</option>
        @endforeach
    </select>
    <label for="perPage" class="text-sm text-gray-600">{{ __('datatable::datatables.results_per_page') }}</label>
</div>

<div class="hidden md:block">
    <label for="perPage" class="text-sm text-gray-600">{{ __('datatable::datatables.results_per_page') }}</label>
    <select wire:change="updatePerPage($event.target.value)" id="perPage"
            class="border border-gray-300 rounded-lg px-3 py-2 text-sm w-24 focus:ring-2 focus:ring-blue-400 transition">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>

</div>

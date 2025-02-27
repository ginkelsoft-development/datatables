<div wire:loading.class="opacity-50">
    <div class="bg-white shadow-lg rounded-xl p-6">

        <div class="flex justify-between items-center mb-4 gap-4">

            <div class="flex items-center gap-2">
                @includeIf('datatable::components.search')
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2">
                    @includeIf('datatable::components.page-result')
                </div>
            </div>

        </div>

        <div class="flex justify-between items-center mb-4">

            <div class="flex items-center gap-2">
                @if(!empty($filters))
                    <div>
                        @includeIf('datatable::filters', ['filters' => $filters])
                    </div>
                @endif
            </div>

            @if(count($selectedRows) > 0)
                <div class="flex items-center gap-2">
                    @includeIf('datatable::components.bulk-action')
                </div>
            @endif

        </div>

        <div class="overflow-x-auto">
            @includeIf('datatable::components.table')

            @includeIf('datatable::components.pagination')
        </div>

        @if($showSelectAllModal)
            @includeIf('datatable::components.select-all-modal')
        @endif
    </div>
</div>

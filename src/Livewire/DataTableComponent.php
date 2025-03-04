<?php

namespace Ginkelsoft\DataTables\Livewire;

use Ginkelsoft\DataTables\Action;
use Ginkelsoft\DataTables\Factories\FilterFactory;
use Livewire\Component;
use Livewire\WithPagination;
use Ginkelsoft\DataTables\Search;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

/**
 * Class DataTableComponent
 *
 * A Livewire component for displaying and managing a DataTable.
 * Supports searching, sorting, filtering, bulk actions, and row selection.
 */
class DataTableComponent extends Component
{
    use WithPagination;

    /** @var string The Eloquent model associated with the DataTable */
    public string $model;

    /** @var array List of columns to be displayed */
    public array $columns = [];

    /** @var array List of actions available for each row */
    public array $actions = [];

    /** @var string The Blade view file for displaying row actions */
    public string $actionsView = 'datatable::actions';

        /** @var string The search query entered by the user */
    #[\Livewire\Attributes\Url(history: true)]
    public string $search = '';

    /** @var string The column used for sorting */
    public string $sortColumn = 'id';

    /** @var string The sorting direction ('asc' or 'desc') */
    public string $sortDirection = 'asc';

    /** @var int Number of rows per page */
    public int $perPage = 10;

    /** @var array Active filters applied to the DataTable */
    public array $filters = [];

    /** @var bool Whether the filter panel is visible */
    public bool $showFilters = false;

    /** @var array Selected row IDs for bulk actions */
    public array $selectedRows = [];

    /** @var bool Whether all rows are selected */
    public bool $selectAll = false;

    /** @var array Columns that should be hidden */
    public array $hiddenColumns = [];

    /** @var array Bulk actions available for the DataTable */
    public array $bulkActions = [];

    /** @var string The currently selected bulk action */
    public string $bulkAction = '';

    /** @var bool Whether to show the select-all confirmation modal */
    public bool $showSelectAllModal = false;

    public int $currentPage = 1;

    /** @var array Livewire event listeners */
    protected $listeners = ['refreshTable' => '$refresh', 'searchUpdated' => 'applySearch'];

    /**
     * Mount the DataTable component.
     *
     * @param string $model The model class name.
     * @param array $columns List of table columns.
     * @param array $actions Row actions.
     * @param string $actionsView Blade view for row actions.
     * @param array $hiddenColumns Columns that should be hidden.
     * @param array $bulkActions Available bulk actions.
     * @param array $filters Initial filters.
     */
    public function mount(
        string $model,
        array  $columns,
        array  $actions = [],
        string $actionsView = 'datatable::actions',
        array  $hiddenColumns = [],
        array  $bulkActions = [],
        array  $filters = []
    ): void
    {
        $this->model = $model;
        $this->columns = $columns;
        $this->actions = array_map(fn($action) => $action instanceof Action ? $action->toArray() : $action, $actions);
        $this->actionsView = $actionsView;
        $this->hiddenColumns = $hiddenColumns;
        $this->bulkActions = $bulkActions;
        $this->filters = collect($filters)
            ->map(fn($filter) => FilterFactory::make($filter)->toArray())
            ->collapse()
            ->toArray();
    }

    /**
     * Toggle the visibility of the filter panel.
     */
    public function toggleFilters(): void
    {
        $this->showFilters = !$this->showFilters;
    }

    /**
     * Remove a specific filter by key.
     *
     * @param string $filterKey The key of the filter to remove.
     */
    public function removeFilter(string $filterKey): void
    {
        if (isset($this->filters[$filterKey]) && is_array($this->filters[$filterKey])) {
            $this->filters[$filterKey]['value'] = '';
        }
        $this->resetPage();
    }

    /**
     * Select or deselect all rows.
     */
    public function toggleSelectAll(): void
    {
        if ($this->selectAll) {
            $this->selectedRows = [];
            $this->selectAll = false;
        } else {
            $this->showSelectAllModal = true;
        }
    }

    /**
     * Confirm the selection of all rows or only visible rows.
     *
     * @param string $mode 'all' selects all rows, 'visible' selects only the current page.
     */
    public function confirmSelectAll(string $mode): void
    {
        $query = app($this->model)::query();

        if (!empty($this->search)) {
            (new Search())->setSearch($this->search)->apply($query, $this->columns);
        }

        if ($mode === 'all') {
            $this->selectedRows = $query->pluck('id')->toArray(); // 🔥 Selecteer *alle* rijen
        } else {
            $this->selectedRows = $this->getRows()->pluck('id')->toArray(); // 🔥 Alleen zichtbare rijen
        }

        $this->selectAll = true;
        $this->showSelectAllModal = false; // 🔥 Sluit modal na selectie
    }

    public function applySearch(): void
    {
        $this->resetPage();
    }

    /**
     * Cancel the select-all action and reset selection.
     */
    public function cancelSelectAll(): void
    {
        $this->selectedRows = [];
        $this->showSelectAllModal = false;
    }

    /**
     * Update the number of rows per page.
     *
     * @param int $value New number of rows per page.
     */
    public function updatePerPage(int $value): void
    {
        $this->perPage = $value;
        $this->resetPage();
    }

    /**
     * Update sorting order when a column header is clicked.
     *
     * @param string $column The column to sort by.
     */
    public function sortBy(string $column): void
    {
        $this->sortDirection = ($this->sortColumn === $column && $this->sortDirection === 'asc') ? 'desc' : 'asc';
        $this->sortColumn = $column;
        $this->resetPage();
    }

    /**
     * Apply filters and reset pagination.
     */
    public function applyFilters(): void
    {
        $this->resetPage();
    }

    /**
     * Reset all applied filters.
     */
    public function resetFilters(): void
    {
        foreach ($this->filters as $key => $filter) {
            $this->filters[$key]['value'] = '';
        }
        $this->resetPage();
    }

    /**
     * Retrieve paginated rows with applied filters, search, and sorting.
     *
     * @return LengthAwarePaginator The paginated dataset.
     */
    public function getRows(): LengthAwarePaginator
    {
        $query = app($this->model)::query();

        if (!empty($this->search)) {
            (new Search())->setSearch($this->search)->apply($query, $this->columns);
        }

        $filters = collect($this->filters)
            ->filter(fn($filter, $key) => is_array($filter) && is_string($key) && isset($filter['type']))
            ->map(fn($filter, $key) => FilterFactory::make(array_merge(["column" => $key], $filter))); // ✅ Voeg de column key toe

        foreach ($filters as $filter) {
            $query = $filter->apply($query);
        }

        $query->orderBy($this->sortColumn, $this->sortDirection);

        // Handmatige paginatie zonder Livewire’s paginate() (voorkomt URL-updates)
        $total = $query->count();
        $rows = $query->skip(($this->currentPage - 1) * $this->perPage)->take($this->perPage)->get();

        return new \Illuminate\Pagination\LengthAwarePaginator(
            $rows,
            $total,
            $this->perPage,
            $this->currentPage
        );
    }

    public function gotoPage(int $page): void
    {
        $this->currentPage = max(1, min($page, $this->getRows()->lastPage()));
    }

    public function previousPage(): void
    {
        $this->currentPage = max(1, $this->currentPage - 1);
    }

    public function nextPage(): void
    {
        $this->currentPage = min($this->currentPage + 1, $this->getRows()->lastPage());
    }

    /**
     * Get a unique pagination name for this DataTable instance.
     *
     * @return string The unique pagination name.
     */
    protected function getPaginationName(): string
    {
        return md5($this->model . implode(',', $this->columns));
    }

    /**
     * Execute the selected bulk action.
     */
    public function executeBulkAction(): void
    {
        if (empty($this->bulkAction) || count($this->selectedRows) === 0) {
            return;
        }

        redirect()->route($this->bulkActions[$this->bulkAction]['route'], [
            'model' => $this->model,
            'ids' => implode(',', $this->selectedRows)
        ]);
    }

    /**
     * Toggle selection of a single row.
     *
     * @param int|string $rowId The row ID to toggle.
     */
    public function toggleRowSelection($rowId): void
    {
        if (in_array($rowId, $this->selectedRows)) {
            $this->selectedRows = array_diff($this->selectedRows, [$rowId]);
        } else {
            $this->selectedRows[] = $rowId;
        }
    }

    /**
     * Render the DataTable component.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('datatable::datatable', [
            'rows' => $this->getRows(),
            'columns' => $this->columns,
            'actions' => $this->actions,
            'actionsView' => $this->actionsView,
            'hiddenColumns' => $this->hiddenColumns,
            'selectedRows' => $this->selectedRows,
            'selectAll' => $this->selectAll,
            'showSelectAllModal' => $this->showSelectAllModal,
            'bulkActions' => $this->bulkActions,
            'bulkAction' => $this->bulkAction,
            'filters' => $this->filters
        ]);
    }
}

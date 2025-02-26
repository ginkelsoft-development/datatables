<?php

namespace Ginkelsoft\DataTables\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Ginkelsoft\DataTables\DataTable;
use Ginkelsoft\DataTables\Column;
use Ginkelsoft\DataTables\Sorting;
use Ginkelsoft\DataTables\Search;
use Ginkelsoft\DataTables\Filter;
use Ginkelsoft\DataTables\Action;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class DataTableComponent extends Component
{
    use WithPagination;

    /** @var string The model associated with the datatable */
    public string $model;

    /** @var array Columns to be displayed in the datatable */
    public array $columns = [];

    /** @var array Actions available for the datatable rows */
    public array $actions = [];

    /** @var string The view path for row actions */
    public string $actionsView = '';

    /** @var string Search query entered by the user */
    public string $search = '';

    /** @var string The column to sort by */
    public string $sortColumn = 'id';

    /** @var string Sorting direction (asc or desc) */
    public string $sortDirection = 'asc';

    /** @var int Number of records per page */
    public int $perPage = 10;

    /** @var array Filters applied to the dataset */
    public array $filters = [];

    /** @var array Selected row IDs for bulk actions */
    public array $selectedRows = [];

    /** @var bool Whether all rows are selected */
    public bool $selectAll = false;

    /** @var array Columns that should be hidden */
    public array $hiddenColumns = [];

    /** @var array Bulk actions available for the datatable */
    public array $bulkActions = [];

    /** @var string Currently selected bulk action */
    public string $bulkAction = '';

    /** @var bool Whether to show the select-all confirmation modal */
    public bool $showSelectAllModal = false;

    /** @var array Livewire event listeners */
    protected $listeners = ['refreshTable' => '$refresh'];

    /**
     * Mount the DataTable component.
     */
    public function mount(string $model, array $columns, array $actions = [], string $actionsView = '', array $hiddenColumns = [], array $bulkActions = []): void
    {
        $this->model = $model;
        $this->columns = $columns;
        $this->actions = $actions;
        $this->actionsView = $actionsView;
        $this->hiddenColumns = $hiddenColumns;
        $this->bulkActions = $bulkActions;
    }

    /**
     * Toggle selection of all rows.
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
     */
    public function confirmSelectAll(string $mode): void
    {
        $query = app($this->model)::query();

        if (!empty($this->search)) {
            (new Search())->setSearch($this->search)->apply($query, $this->columns);
        }

        $this->selectedRows = ($mode === 'all')
            ? $query->pluck('id')->toArray()
            : $this->getRows()->pluck('id')->toArray();

        $this->selectAll = true;
        $this->showSelectAllModal = false;
    }

    /**
     * Cancel the select all action and reset selection.
     */
    public function cancelSelectAll(): void
    {
        $this->selectedRows = [];
        $this->showSelectAllModal = false;
    }

    /**
     * Update the number of items per page.
     */
    public function updatePerPage(int $value): void
    {
        $this->perPage = $value;
        $this->resetPage();
    }

    /**
     * Apply search filter.
     */
    public function applySearch(): void
    {
        $this->resetPage();
    }

    /**
     * Reset search input and pagination.
     */
    public function resetSearch(): void
    {
        $this->search = '';
        $this->resetPage();
    }

    /**
     * Update sorting when a column header is clicked.
     */
    public function sortBy(string $column): void
    {
        $this->sortDirection = ($this->sortColumn === $column && $this->sortDirection === 'asc')
            ? 'desc'
            : 'asc';

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
     * Retrieve paginated rows.
     */
    public function getRows(): LengthAwarePaginator
    {
        $query = app($this->model)::query();

        if (!empty($this->search)) {
            (new Search())->setSearch($this->search)->apply($query, $this->columns);
        }

        foreach ($this->filters as $column => $value) {
            if (!empty($value)) {
                $query->where($column, 'like', "%{$value}%");
            }
        }

        $query->orderBy($this->sortColumn, $this->sortDirection);

        return $query->paginate($this->perPage);
    }

    /**
     * Execute the selected bulk action.
     */
    public function executeBulkAction(): void
    {
        if (empty($this->bulkAction) || count($this->selectedRows) === 0) {
            return;
        }

        if (!isset($this->bulkActions[$this->bulkAction]['route'])) {
            return;
        }

        $route = $this->bulkActions[$this->bulkAction]['route'];

        redirect()->route($route, [
            'model' => $this->model,
            'ids' => implode(',', $this->selectedRows)
        ]);
    }

    /**
     * Toggles the selection of a single row.
     *
     * @param int|string $rowId The ID of the row to toggle.
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
        ]);
    }
}

<?php

namespace Ginkelsoft\DataTables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class DataTable
 *
 * Handles querying, pagination, and column management for DataTables.
 */
class DataTable
{
    /**
     * The Eloquent query builder instance.
     */
    protected Builder $query;

    /**
     * The list of columns for the DataTable.
     */
    protected array $columns = [];

    /**
     * The number of results per page.
     */
    protected int $perPage = 10;

    /**
     * DataTable constructor.
     *
     * @param  Builder  $query  The Eloquent query builder instance.
     */
    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    /**
     * Set the columns for the DataTable.
     *
     * @param  array  $columns  The array of column definitions.
     * @return self Returns the current instance for method chaining.
     */
    public function setColumns(array $columns): self
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * Set the number of items per page.
     *
     * @param  int  $perPage  The number of results per page.
     * @return self Returns the current instance for method chaining.
     */
    public function setPerPage(int $perPage): self
    {
        $this->perPage = $perPage;

        return $this;
    }

    /**
     * Retrieve paginated rows for the DataTable.
     *
     * @return LengthAwarePaginator The paginated results.
     */
    public function getRows(): LengthAwarePaginator
    {
        return $this->query->paginate($this->perPage);
    }
}

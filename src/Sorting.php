<?php

namespace Ginkelsoft\DataTables;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class Sorting
 *
 * Manages sorting logic for DataTables.
 */
class Sorting
{
    /**
     * @var string The column to sort by
     */
    protected string $sortColumn = 'id';

    /**
     * @var string The sort direction, either 'asc' or 'desc'
     */
    protected string $sortDirection = 'asc';

    /**
     * Set the sorting preferences.
     *
     * @param string $column The column name to sort by.
     * @param string $direction The sort direction (default 'asc').
     * @return self Returns the Sorting instance for method chaining.
     */
    public function setSorting(string $column, string $direction = 'asc'): self
    {
        $this->sortColumn = $column;
        $this->sortDirection = $direction;
        return $this;
    }

    /**
     * Apply sorting to the given query.
     *
     * @param Builder $query The Eloquent query builder instance.
     * @return Builder The modified query with sorting applied.
     */
    public function apply(Builder $query): Builder
    {
        return $query->orderBy($this->sortColumn, $this->sortDirection);
    }
}

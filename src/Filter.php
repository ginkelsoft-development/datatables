<?php

namespace Ginkelsoft\DataTables;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class Filter
 *
 * Handles filtering logic for DataTables.
 */
class Filter
{
    /**
     * @var array<string, mixed> $filters
     * Stores the filters applied to the DataTable.
     */
    protected array $filters = [];

    /**
     * Add a filter to the query.
     *
     * @param string $column The column name to filter.
     * @param mixed $value The value to filter by.
     * @return self Returns the Filter instance for method chaining.
     */
    public function addFilter(string $column, mixed $value): self
    {
        $this->filters[$column] = $value;
        return $this;
    }

    /**
     * Apply filters to the given query.
     *
     * @param Builder $query The Eloquent query builder instance.
     * @return Builder Returns the modified query with applied filters.
     */
    public function apply(Builder $query): Builder
    {
        foreach ($this->filters as $column => $value) {
            if (!is_null($value)) {
                $query->where($column, 'like', "%{$value}%");
            }
        }
        return $query;
    }
}

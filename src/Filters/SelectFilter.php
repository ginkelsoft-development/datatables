<?php

namespace Ginkelsoft\DataTables\Filters;

use Illuminate\Database\Eloquent\Builder;
use Ginkelsoft\DataTables\Filter;

/**
 * Class SelectFilter
 *
 * A filter for handling dropdown (select) filtering in a DataTable.
 */
class SelectFilter extends Filter
{
    /**
     * SelectFilter constructor.
     *
     * @param string $column The column to filter.
     * @param mixed|null $value The selected value (default: null).
     * @param array $options Available options for the select dropdown.
     */
    public function __construct(string $column, mixed $value = null, array $options = [])
    {
        parent::__construct($column, $value, 'select', $options);
    }

    /**
     * Apply the select filter to the query.
     *
     * @param Builder $query The Eloquent query builder instance.
     * @return Builder The modified query with the select filter applied.
     */
    public function apply(Builder $query): Builder
    {
        if (!empty($this->value)) {
            $query->where($this->column, '=', $this->value);
        }

        return $query;
    }
}

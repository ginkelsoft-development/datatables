<?php

namespace Ginkelsoft\DataTables\Filters;

use Illuminate\Database\Eloquent\Builder;
use Ginkelsoft\DataTables\Filter;

/**
 * Class BooleanFilter
 *
 * A specialized filter for handling boolean (true/false) values using checkboxes.
 */
class BooleanFilter extends Filter
{
    /**
     * BooleanFilter constructor.
     *
     * @param string $column The column to filter.
     * @param bool|null $value The boolean value to filter by (default: null).
     */
    public function __construct(string $column, ?bool $value = null)
    {
        parent::__construct($column, $value, 'checkbox');
    }

    /**
     * Apply the boolean filter to the query.
     *
     * @param Builder $query The Eloquent query builder instance.
     * @return Builder The modified query with the boolean filter applied.
     */
    public function apply(Builder $query): Builder
    {
        if (!is_null($this->value)) {
            $query->where($this->column, (bool) $this->value);
        }

        return $query;
    }
}

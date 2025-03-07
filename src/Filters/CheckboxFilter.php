<?php

namespace Ginkelsoft\DataTables\Filters;

use Ginkelsoft\DataTables\Filter;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class BooleanFilter
 *
 * A specialized filter for handling boolean (true/false) values using checkboxes.
 */
class CheckboxFilter extends Filter
{
    /**
     * BooleanFilter constructor.
     *
     * @param  string  $column  The column to filter.
     * @param  bool|null  $value  The boolean value to filter by (default: null).
     */
    public function __construct(string $column, ?bool $value = null, string $label = '')
    {
        parent::__construct($column, $value, 'checkbox', [], $label);
    }

    /**
     * Apply the boolean filter to the query.
     *
     * @param  Builder  $query  The Eloquent query builder instance.
     * @return Builder The modified query with the boolean filter applied.
     */
    public function apply(Builder $query): Builder
    {
        $value = $this->getValue();

        if (! empty($value)) {
            $query->where($this->column, (bool) $this->value);
        }

        return $query;
    }
}

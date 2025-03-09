<?php

namespace Ginkelsoft\DataTables\Filters;

use Ginkelsoft\DataTables\Filter;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class DateBetweenFilter
 *
 * A filter for selecting a date range in a DataTable.
 */
class DateBetweenFilter extends Filter
{
    /**
     * DateBetweenFilter constructor.
     *
     * @param  string  $column  The column to filter.
     * @param  array|null  $dates  The selected date range (default: null).
     * @param  string  $label  The label for the filter.
     */
    public function __construct(string $column, ?array $dates = [], string $label = '')
    {
        parent::__construct($column, $dates, 'date-between', [], $label);
    }

    /**
     * Apply the date range filter to the query.
     *
     * @param  Builder  $query  The Eloquent query builder instance.
     * @return Builder The modified query with the date range filter applied.
     */
    public function apply(Builder $query): Builder
    {
        $dates = $this->getValue();

        if (! empty($dates) && is_array($dates) && count($dates) === 2) {
            $query->whereBetween($this->column, [$dates['from'], $dates['to']]);
        }

        return $query;
    }
}

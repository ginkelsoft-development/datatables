<?php

namespace Ginkelsoft\DataTables\Filters;

use Illuminate\Database\Eloquent\Builder;
use Ginkelsoft\DataTables\Filter;

/**
 * Class DateFilter
 *
 * A filter for handling single-date selection in a DataTable.
 */
class DateFilter extends Filter
{
    /**
     * DateFilter constructor.
     *
     * @param string $column The column to filter.
     * @param string|null $date The selected date (default: null).
     */
    public function __construct(string $column, ?string $date = null, string $label = '')
    {
        parent::__construct($column, $date, 'date', [], $label);
    }

    /**
     * Apply the date filter to the query.
     *
     * @param Builder $query The Eloquent query builder instance.
     * @return Builder The modified query with the date filter applied.
     */
    public function apply(Builder $query): Builder
    {
        $value = $this->getValue();

        if (!empty($value)) {
            $query->whereDate($this->column, '=', $this->value);
        }

        return $query;
    }
}

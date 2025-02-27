<?php

namespace Ginkelsoft\DataTables\Filters;

use Illuminate\Database\Eloquent\Builder;
use Ginkelsoft\DataTables\Filter;

/**
 * Class TextFilter
 *
 * A filter for handling text input search in a DataTable.
 */
class TextFilter extends Filter
{
    /**
     * TextFilter constructor.
     *
     * @param string $column The column to filter.
     * @param mixed|null $value The search value (default: null).
     */
    public function __construct(string $column, mixed $value = null)
    {
        parent::__construct($column, $value, 'input');
    }

    /**
     * Apply the text filter to the query.
     *
     * @param Builder $query The Eloquent query builder instance.
     * @return Builder The modified query with the text filter applied.
     */
    public function apply(Builder $query): Builder
    {
        if (!empty($this->value)) {
            $query->where($this->column, 'like', "%{$this->value}%");
        }

        return $query;
    }
}

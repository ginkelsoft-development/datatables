<?php

namespace Ginkelsoft\DataTables\Filters;

use Ginkelsoft\DataTables\Filter;
use Illuminate\Database\Eloquent\Builder;

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
     * @param  string  $column  The column to filter.
     * @param  mixed|null  $value  The search value (default: '').
     */
    public function __construct(string $column, mixed $value = '', string $label = '')
    {
        parent::__construct($column, $value, 'input', [], $label);
    }

    /**
     * Apply the text filter to the query.
     *
     * @param  Builder  $query  The Eloquent query builder instance.
     * @return Builder The modified query with the text filter applied.
     */
    public function apply(Builder $query): Builder
    {
        $value = $this->getValue();

        if (! empty($value)) {
            $query->where($this->column, 'like', "%{$value}%");
        }

        // dd($this->value, $query->get());

        return $query;
    }
}

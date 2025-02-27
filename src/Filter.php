<?php

namespace Ginkelsoft\DataTables;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class Filter
 *
 * Handles filtering logic for DataTables. Supports different filter types such as text input,
 * select dropdowns, checkboxes, and date ranges.
 */
class Filter
{
    /** @var string The column to apply the filter on */
    public string $column;

    /** @var string The type of filter (e.g., input, select, checkbox, date-range) */
    public string $type;

    /** @var mixed The filter value */
    public mixed $value;

    /** @var array Options for select and radio button filters */
    public array $options;

    /**
     * Filter constructor.
     *
     * @param string $column The column to filter.
     * @param mixed $value The initial value of the filter.
     * @param string $type The type of filter (default: 'input').
     * @param array $options Options for select, radio, or other multi-choice filters.
     */
    public function __construct(string $column, mixed $value = '', string $type = 'input', array $options = [])
    {
        $this->column = $column;
        $this->value = $value;
        $this->type = $type;
        $this->options = $options;
    }

    /**
     * Apply the filter to the given query.
     *
     * @param Builder $query The Eloquent query builder instance.
     * @return Builder The modified query with applied filters.
     */
    public function apply(Builder $query): Builder
    {
        if (!empty($this->value)) {
            switch ($this->type) {
                case 'select':
                    $query->where($this->column, $this->value);
                    break;

                case 'checkbox':
                    $query->where($this->column, '=', (bool) $this->value);
                    break;

                case 'radio':
                    $query->where($this->column, '=', $this->value);
                    break;

                case 'date-range':
                    if (is_array($this->value)) {
                        if (!empty($this->value['from'])) {
                            $query->whereDate($this->column, '>=', $this->value['from']);
                        }
                        if (!empty($this->value['to'])) {
                            $query->whereDate($this->column, '<=', $this->value['to']);
                        }
                    }
                    break;

                default:
                    $query->where($this->column, 'like', "%{$this->value}%");
                    break;
            }
        }
        return $query;
    }
}

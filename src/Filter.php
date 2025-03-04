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

    /** @var mixed The raw filter value */
    protected mixed $value;

    /** @var array Options for select and radio button filters */
    public array $options;

    public string $label;

    /**
     * Filter constructor.
     *
     * @param string $column The column to filter.
     * @param mixed $value The initial value of the filter.
     * @param string $type The type of filter (default: 'input').
     * @param array $options Options for select, radio, or other multi-choice filters.
     */
    public function __construct(string $column, mixed $value = '', string $type = 'input', array $options = [], string $label = '')
    {

        $this->column = $column;
        $this->type = $type;
        $this->options = $options;
        $this->setValue($value);
        $this->label = $label ?: ucfirst(str_replace('_', ' ', $column));
    }

    /**
     * Set the filter value.
     *
     * @param mixed $value
     * @return void
     */
    public function setValue(mixed $value): void
    {
        $this->value = !is_string($value) ? json_decode($value, true) : $value;
    }

    /**
     * Get the filter value.
     *
     * @return mixed
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * Convert the filter to an array format.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            $this->column => [
                'type' => $this->type,
                'value' => $this->getValue(), // ✅ Correcte waarde
                'options' => $this->options,
                'label' => $this->label,
            ]
        ];
    }

    /**
     * Apply the filter to the given query.
     *
     * @param Builder $query The Eloquent query builder instance.
     * @return Builder The modified query with applied filters.
     */
    public function apply(Builder $query): Builder
    {
        return $query;
    }
}

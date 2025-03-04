<?php

namespace Ginkelsoft\DataTables\Factories;

use Ginkelsoft\DataTables\Filters\DateFilter;
use Ginkelsoft\DataTables\Filters\TextFilter;
use Ginkelsoft\DataTables\Filters\SelectFilter;
use Ginkelsoft\DataTables\Filters\CheckboxFilter;
use Ginkelsoft\DataTables\Filters\RadioFilter;
use Ginkelsoft\DataTables\Filter;

class FilterFactory
{
    /**
     * Create a filter instance based on the type.
     */
    public static function make(array $filter): Filter
    {
        return match ($filter['type']) {
            'input' => new TextFilter(
                $filter['column'],
                $filter['value'] ?? '',
                $filter['label'] ?? ''
            ),
            'select' => new SelectFilter($filter['column'], $filter['value'] ?? '', $filter['options'] ?? [], $filter['label'] ?? ''),
            'checkbox' => new CheckboxFilter($filter['column'], $filter['value'] ?? false, $filter['label'] ?? ''),
            'radio' => new RadioFilter($filter['column'], $filter['value'] ?? false, $filter['options'] ?? [], $filter['label'] ?? ''),
            'date' => new DateFilter($filter['column'], $filter['value'] ?? null, $filter['label'] ?? ''),
            /*'date-between' => new DateBetweenFilter(
                $filter['column'],
                $filter['value']['from'] ?? null,
                $filter['value']['to'] ?? null
            ),*/
            default => throw new \Exception("Unknown filter type: {$filter['type']}"),
        };
    }
}

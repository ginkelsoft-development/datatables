<?php

namespace Ginkelsoft\DataTables;

/**
 * Represents a column in a DataTable.
 */
class Column
{
    /** @var string Column name */
    public string $name;

    /** @var string Column label */
    public string $label;

    /** @var bool Determines if column is sortable */
    public bool $sortable;

    /** @var bool Determines if column is searchable */
    public bool $searchable;

    /**
     * Column constructor.
     *
     * @param  string  $name  The column name.
     * @param  string  $label  The column label (default: formatted name).
     * @param  bool  $sortable  Indicates if the column is sortable.
     * @param  bool  $searchable  Indicates if the column is searchable.
     */
    public function __construct(string $name, string $label = '', bool $sortable = true, bool $searchable = true)
    {
        $this->name = $name;
        $this->label = $label ?: ucfirst(str_replace('_', ' ', $name));
        $this->sortable = $sortable;
        $this->searchable = $searchable;
    }

    /**
     * Factory method to create a new Column instance.
     *
     * @param  string  $name  The column name.
     * @param  string  $label  The column label (optional).
     * @param  bool  $sortable  Indicates if the column is sortable (default: true).
     * @param  bool  $searchable  Indicates if the column is searchable (default: true).
     */
    public static function make(string $name, string $label = '', bool $sortable = true, bool $searchable = true): self
    {
        return new self($name, $label, $sortable, $searchable);
    }
}

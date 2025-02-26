<?php

namespace Ginkelsoft\DataTables\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ginkelsoft\DataTables\DataTable
 */
class DataTable extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'datatable';
    }
}

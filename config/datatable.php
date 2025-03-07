<?php


return [

    /*
    |--------------------------------------------------------------------------
    | Default DataTable Settings
    |--------------------------------------------------------------------------
    |
    | These settings define the default behavior of the DataTable component.
    | You can override these settings by passing parameters to the component.
    |
    */
    'per_page' => [
        'active' => true,
        'options' => [10, 25, 50, 100],
        'default' => 10,
    ],

    'sort' => [
        'active' => true,
        'column' => 'id',
        'direction' => 'asc',
    ],

    'columns' => [
        'hidden' => [],
    ],

    'filters' => [
        'active' => true,
    ],

    'row_actions' => [
        'view' => 'datatable::row-actions',
    ],

    'bulk_actions' => [
        'active' => true,
    ],

    'search' => [
        'active' => true,
    ],

];

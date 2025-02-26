# Ginkelsoft DataTables

Ginkelsoft DataTables is a flexible and easy-to-use package for managing tabular data in your Laravel projects. It supports both a **base DataTable** class for traditional server-rendered apps and an **optional Livewire** component for dynamic, AJAX-driven experiences. You can easily add filtering, searching, sorting, and bulk actions with minimal setup.

---

## Table of Contents

1. [Requirements](#requirements)
2. [Installation](#installation)
3. [Usage (Without Livewire)](#usage-without-livewire)
4. [Usage (With Livewire)](#usage-with-livewire)
5. [Working with Actions](#working-with-actions)
6. [Additional Features](#additional-features)
7. [Contributing](#contributing)
8. [License](#license)

---

## Requirements

- **PHP 8.2+**
- **Laravel 10.0+**&#x20;
- **Livewire** *(Optional, only if you need AJAX-driven data tables.)*

---

## Installation

1. **Require the package**:

   ```bash
   composer require ginkelsoft/datatables:dev-main
   ```

2. **Publish the package views** (optional) for customization:

   ```bash
   php artisan vendor:publish --provider="Ginkelsoft\\DataTables\\DataTableServiceProvider" --tag=views
   ```

---

## Usage (Without Livewire)

For a traditional server-rendered app:

```php
use Ginkelsoft\DataTables\DataTable;
use Ginkelsoft\DataTables\Column;
use App\Models\User;

public function index()
{
    $query = User::query();

    $datatable = (new DataTable($query))
        ->setColumns([
            Column::make('id', 'ID'),
            Column::make('name', 'Name'),
            Column::make('email', 'Email'),
        ])
        ->setPerPage(10);

    $rows = $datatable->getRows();

    return view('users.index', compact('rows'));
}
```

And in `resources/views/users/index.blade.php`:

```blade
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rows as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $rows->links() }}
```

---

## Usage (With Livewire)

If you prefer an **AJAX-driven** workflow with real-time sorting, searching, and pagination:

```blade
<livewire:datatable
    model="App\\Models\\User"
    :columns="['id', 'name', 'email']"
    :actions="[
        ['label' => 'Edit', 'route' => 'users.edit'],
        ['label' => 'Delete', 'route' => 'users.destroy']
    ]"
    :bulkActions="[
        'delete' => ['label' => 'Delete', 'route' => 'users.bulk.delete'],
        'export' => ['label' => 'Export', 'route' => 'users.bulk.export']
    ]"
/>
```

You can now:

- **Search** by typing in the search field (if your component includes that feature).
- **Sort** by clicking column headers.
- **Paginate** without page reload.
- **Select rows** individually or choose to select all.

---

## Working with Actions

### Row Actions

Specify row-level actions in your Blade:

```blade
:actions="[
    ['label' => 'Edit', 'route' => 'users.edit'],
    ['label' => 'Delete', 'route' => 'users.destroy']
]"
```

### Bulk Actions

For bulk actions (like deleting multiple rows) set `:bulkActions`:

```blade
:bulkActions="[
    'delete' => ['label' => 'Delete', 'route' => 'users.bulk.delete'],
    'export' => ['label' => 'Export', 'route' => 'users.bulk.export']
]"
```

When multiple rows are selected, the component redirects to the specified route with `ids` in the query/string, so you can handle them in your controller.

---

## Additional Features

- **Search Class** for multi-column searching.
- **Filter Class** for custom filters (status, categories, etc.).
- **Sorting Class** for ascending/descending ordering.
- **Select All** (with confirmation modal) to choose between only visible rows or all rows.

---

## Contributing

1. **Fork** this repository.
2. **Create** a new branch for your feature or fix.
3. **Push** your changes and open a **pull request**.

We welcome improvements to code quality, new features, or better documentation.

---

## License

Ginkelsoft DataTables is open-sourced software licensed under the [MIT license](LICENSE).


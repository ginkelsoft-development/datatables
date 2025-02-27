# Ginkelsoft DataTables

Ginkelsoft DataTables is a flexible and easy-to-use package for managing tabular data in Laravel projects. It supports both a **base DataTable** class for traditional server-rendered apps and an **optional Livewire** component for dynamic, AJAX-driven experiences. You can easily add filtering, searching, sorting, and bulk actions with minimal setup.

---

## Table of Contents

1. [Requirements](#requirements)
2. [Installation](#installation)
3. Usage
4. Usage With Livewire
5. [Filters](#filters)
6. [Actions & Bulk Actions](#actions--bulk-actions)
7. [Additional Features](#additional-features)
8. [Contributing](#contributing)
9. [License](#license)

---

## Requirements

- **PHP 8.2+**
- **Laravel 10.0+**
- **Livewire** *(Optional, only if you need AJAX-driven data tables.)*

---

## Installation

1. **Require the package**:

   ```bash
   composer require ginkelsoft/datatables
   ```

2. **Publish the package views** (optional) for customization:

   ```bash
   php artisan vendor:publish --provider="Ginkelsoft\\DataTables\\DataTableServiceProvider" --tag=views
   ```

---

## Usage

You can use this package in a standard Laravel Blade view without Livewire.

### Example

#### Controller:

```php
use Ginkelsoft\DataTables\DataTable;
use Ginkelsoft\DataTables\Column;
use Ginkelsoft\DataTables\Filters\TextFilter;
use Ginkelsoft\DataTables\Filters\SelectFilter;
use Ginkelsoft\DataTables\Filters\DateFilter;
use Ginkelsoft\DataTables\Filters\BooleanFilter;
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
        ->setFilters([
            new TextFilter('name'),
            new SelectFilter('role', null, ['admin' => 'Admin', 'user' => 'User']),
            new DateFilter('created_at'),
            new BooleanFilter('active')
        ])
        ->setPerPage(10);

    $rows = $datatable->getRows();

    return view('users.index', compact('rows'));
}
```

#### Blade Template:

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

### Actions & Bulk Actions

#### Row Actions:

```blade
@foreach($rows as $row)
    <a href="{{ route('users.edit', $row->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded">Edit</a>
    <a href="{{ route('users.destroy', $row->id) }}" class="bg-red-500 text-white px-3 py-1 rounded">Delete</a>
@endforeach
```

#### Bulk Actions:

```blade
<form action="{{ route('users.bulk.delete') }}" method="POST">
    @csrf
    <input type="hidden" name="ids" value="{{ implode(',', $selectedRows) }}">
    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Delete Selected</button>
</form>
```

---

## Usage With Livewire

For an **AJAX-driven** workflow with real-time sorting, searching, and pagination:

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
    :filters="[
        ['column' => 'name', 'type' => 'text'],
        ['column' => 'role', 'type' => 'select', 'options' => ['admin' => 'Admin', 'user' => 'User']],
        ['column' => 'created_at', 'type' => 'date'],
        ['column' => 'active', 'type' => 'boolean']
    ]"
/>
```

---

## Additional Features

- **Multi-language Support:** English, Dutch, German, French, Spanish.
- **Search Class** for multi-column searching.
- **Filter Class** for custom filters (status, categories, etc.).
- **Sorting Class** for ascending/descending ordering.
- **Select All** (with confirmation modal) to choose between only visible rows or all rows.
- **Custom Actions** now support classes and inline styles.
- **Prevent row selection when clicking an action button** to avoid accidental selection.

---

## Contributing

1. **Fork** this repository.
2. **Create** a new branch for your feature or fix.
3. **Push** your changes and open a **pull request**.

We welcome improvements to code quality, new features, or better documentation.

---

## License

Ginkelsoft DataTables is open-sourced software licensed under the [MIT license](LICENSE).


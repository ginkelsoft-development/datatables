# Ginkelsoft DataTables

Ginkelsoft DataTables is a flexible and easy-to-use package for managing tabular data in Laravel projects. This package **requires Livewire** for dynamic, AJAX-driven experiences. You can easily add filtering, searching, sorting, and bulk actions with minimal setup.

---

## Table of Contents

1. [Requirements](#requirements)
2. [Installation](#installation)
3. [Usage With Livewire](#usage-with-livewire)
4. [Filters](#filters)
5. [Actions & Bulk Actions](#actions--bulk-actions)
6. [Additional Features](#additional-features)
7. [Contributing](#contributing)
8. [License](#license)

---

## Requirements

- **PHP 8.2+**
- **Laravel 10.0+**
- **Livewire** *(Required for usage of this package.)*

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

## Usage With Livewire

This package **requires Livewire** and cannot be used without it. To integrate DataTables in your Laravel project, use the following setup:

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

You can now:

- **Search** by typing in the search field.
- **Sort** by clicking column headers.
- **Paginate** without page reload.
- **Select rows** individually or choose to select all.

---

## Filters

You can define various filters for refining results dynamically.

```blade
:filters="[
    ['column' => 'name', 'type' => 'text'],
    ['column' => 'role', 'type' => 'select', 'options' => ['admin' => 'Admin', 'user' => 'User']],
    ['column' => 'created_at', 'type' => 'date'],
    ['column' => 'active', 'type' => 'boolean']
]"
```

---

## Actions & Bulk Actions

### Row Actions

```blade
:actions="[
    ['label' => 'Edit', 'route' => 'users.edit', 'class' => 'bg-green-500 text-white px-3 py-1 rounded'],
    ['label' => 'Delete', 'url' => 'users/{id}', 'class' => 'bg-red-500 text-white px-3 py-1 rounded', 'onclick' => 'return confirm(\'Are you sure?\')']
]"
```

### Bulk Actions

```blade
:bulkActions="[
    'delete' => ['label' => 'Delete', 'route' => 'users.bulk.delete'],
    'export' => ['label' => 'Export', 'route' => 'users.bulk.export']
]"
```

When multiple rows are selected, the component redirects to the specified route with `ids` in the query/string, so you can handle them in your controller.

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

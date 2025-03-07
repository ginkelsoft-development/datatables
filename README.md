# Ginkelsoft DataTables version 0.0.10

![Downloads](https://img.shields.io/packagist/dt/ginkelsoft/datatables)
![Packagist](https://img.shields.io/packagist/v/ginkelsoft/datatables)
![License](https://img.shields.io/packagist/l/ginkelsoft/datatables)

Ginkelsoft DataTables is a flexible and easy-to-use package for managing tabular data in Laravel projects. This package **requires Livewire** for dynamic, AJAX-driven experiences. You can easily add filtering, searching, sorting, and bulk actions with minimal setup.

## Documentation

The official documentation is now available at:

- [Ginkelsoft DataTables Website](https://datatables.ginkelsoft.com/)
- [Full Documentation](https://datatables.ginkelsoft.com/docs)

---

## Table of Contents

1. [Requirements](#requirements)
2. [Installation](#installation)
3. [Usage With Livewire](#usage-with-livewire)
4. [Filters](#filters)
5. [Sorting](#sorting)
6. [Row Actions & Bulk Actions](#row-actions--bulk-actions)
7. [Additional Features](#additional-features)
8. [Contributing](#contributing)
9. [License](#license)

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
   php artisan vendor:publish --provider="Ginkelsoft\DataTables\DataTableServiceProvider" --tag=views
   ```

3. **Publish configuration file** (optional) for customization:

   ```bash
   php artisan vendor:publish --provider="Ginkelsoft\DataTables\DataTableServiceProvider" --tag=config
   ```

---

## Usage With Livewire

This package **requires Livewire** and cannot be used without it. To integrate DataTables in your Laravel project, use the following setup:

```blade
<livewire:datatable
    model="App\\Models\\User"
    :columns="['id', 'name', 'email', 'created_at']"
    :hidden-columns="['id']"
    :filters="[
        ['column' => 'name', 'type' => 'input', 'label' => 'Naam'],
        ['column' => 'email', 'type' => 'input', 'label' => 'Email'],
        ['column' => 'created_at', 'type' => 'date', 'label' => 'Aangemaakt op']
    ]"
    :row-actions="[
        ['name' => 'edit', 'label' => 'Edit', 'route' => 'users.datatable.edit'],
        ['name' => 'delete', 'label' => 'Delete', 'route' => 'users.datatable.delete'],
        ['name' => 'view', 'label' => 'View Profile', 'url' => '/users/{id}']
    ]"
    :bulk-actions="[
        'export' => ['label' => 'Export', 'route' => 'users.datatable.export']
    ]"
/>
```

---

## Filters

You can define various filters for refining results dynamically.

```blade
:filters="[
    ['column' => 'name', 'type' => 'input', 'label' => 'Naam'],
    ['column' => 'email', 'type' => 'input', 'label' => 'Email'],
    ['column' => 'created_at', 'type' => 'date', 'label' => 'Aangemaakt op']
]"
```

---

## Sorting

Sorting is enabled by default. Clickable column headers allow users to sort the data in ascending or descending order.

By default, sorting is applied to the first column in the `:columns` array. If needed, sorting can be applied programmatically by setting:

```blade
:sort-column="'created_at'"
:sort-direction="'desc'"
```

---

## Row Actions & Bulk Actions

### Row Actions

```blade
:row-actions="[
    ['label' => 'Edit', 'route' => 'users.edit'],
    ['label' => 'Delete', 'url' => 'users/{id}', 'onclick' => 'return confirm(\'Are you sure?\')']
]"
```

### Bulk Actions

```blade
:bulk-actions="[
    'delete' => ['label' => 'Delete', 'route' => 'users.bulk.delete'],
    'export' => ['label' => 'Export', 'route' => 'users.bulk.export']
]"
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

---

### Version Changes

**Changes in version 0.0.10:**
- `actions` have been renamed to `row-actions`.
- A new configuration file has been added.
- Ensure the Livewire component is updated, otherwise, it will not work correctly.
- Official documentation site launched: [https://datatables.ginkelsoft.com/](https://datatables.ginkelsoft.com/)


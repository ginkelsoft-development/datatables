<?php

namespace Ginkelsoft\DataTables;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class DataTableServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * This method is used to bind classes into the service container.
     *
     * @return void
     */
    public function register(): void
    {
        // Load package views
        $this->loadViewsFrom(__DIR__ . '/Resources/views', 'datatable');
    }

    /**
     * Boot the application services.
     *
     * This method is used to set up the service, including publishing assets
     * and registering Livewire components.
     *
     * @return void
     */
    public function boot(): void
    {
        // Publish views to allow customization
        $this->publishes([
            __DIR__ . '/Resources/views' => resource_path('views/vendor/datatables'),
        ], 'views');

        // Register the Livewire component for the DataTable
        Livewire::component('datatable', \Ginkelsoft\DataTables\Livewire\DataTableComponent::class);
    }
}

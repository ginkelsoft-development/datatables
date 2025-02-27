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
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang/vendor/datatables', 'datatable');
        $this->loadViewsFrom(__DIR__ . '/../resources/views/vendor/datatables', 'datatable');
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
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/datatables'),
        ], 'views');

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/datatables'),
        ], 'lang');

        Livewire::component('datatable', \Ginkelsoft\DataTables\Livewire\DataTableComponent::class);
    }
}

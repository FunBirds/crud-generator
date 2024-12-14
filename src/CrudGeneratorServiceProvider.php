<?php
namespace Foxdevuz\CrudGenerator;

use Illuminate\Support\ServiceProvider;
use Foxdevuz\CrudGenerator\Console\MakeCrud;

class CrudGeneratorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register the Artisan command
        $this->commands([
            MakeCrud::class,
        ]);
    }

    public function boot(): void
    {
        // Publish the stubs so users can customize them
        $this->publishes([
            __DIR__ . '/stubs/crud.controller.stub' => resource_path('stubs/crud.controller.stub'),
        ], 'crud-generator-stubs');
    }
}

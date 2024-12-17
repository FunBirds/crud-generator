<?php
namespace Foxdevuz\CrudGenerator;

use Illuminate\Support\ServiceProvider;
use Foxdevuz\CrudGenerator\Console\MakeCrud;

class CrudGeneratorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->commands([
            MakeCrud::class,
        ]);
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../crud-config.json' => base_path('crud-config.json'),
        ], 'crud-generator-config');
    }
}

<?php
namespace Foxdevuz\CrudGenerator\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Console\Command\Command as CommandAlias;

class MakeCrud extends Command
{
    protected $signature = 'make:crud
        {--c|controller=: Controller name}
        {--m|model=: Model name}';

    protected $description = 'Generate a CRUD Controller bound to a Model';

    public function handle(): int
    {
        $controllerName = $this->option('controller');
        $modelName = $this->option('model');

        // Validate inputs
        if (!$controllerName || !$modelName) {
            $this->error('Both --controller and --model options are required.');
            return CommandAlias::FAILURE;
        }

        // Ensure proper naming conventions
        $controllerName = Str::studly($controllerName . 'Controller');
        $modelName = Str::studly($modelName);

        // Resolve stub path
        $stubPath = __DIR__ . '/../stubs/crud.controller.stub';
        if (!File::exists($stubPath)) {
            $this->error('CRUD controller stub not found.');
            return CommandAlias::FAILURE;
        }

        // Read stub content
        $stub = File::get($stubPath);

        // Replace placeholders
        $controllerContent = str_replace(
            ['{{controllerName}}', '{{modelName}}', '{{namespace}}'],
            [$controllerName, $modelName, 'App\Http\Controllers'],
            $stub
        );

        // Determine controller file path
        $controllerPath = app_path("Http/Controllers/{$controllerName}.php");

        // Check for existing file
        if (File::exists($controllerPath)) {
            $this->error("Controller {$controllerName} already exists.");
            return CommandAlias::FAILURE;
        }


        File::ensureDirectoryExists(dirname($controllerPath));

        // Write controller file
        File::put($controllerPath, $controllerContent);

        $this->info("Controller {$controllerName} created successfully!");
        return CommandAlias::SUCCESS;
    }
}
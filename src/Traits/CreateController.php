<?php

namespace Foxdevuz\CrudGenerator\Traits;

use Exception;
use Foxdevuz\CrudGenerator\Exceptions\FileAlreadyExistsException;
use Illuminate\Support\Facades\File;

trait CreateController
{
    use FileHelper;

    /**
     * @throws FileAlreadyExistsException
     * @throws Exception
     */
    protected function createController(string $name, string $model_name) : void
    {
        $stub = $this->getControllerStub();

        $updateRequestName = $model_name . "UpdateRequest";
        $storeRequestName = $model_name . "CreateRequest";

        $ready_controller = str_replace(
            ['{{controllerName}}', '{{modelName}}', '{{updateRequestName}}', '{{storeRequestName}}'],
            [$name, $model_name, $updateRequestName, $storeRequestName],
            $stub
        );

        $path = app_path("Http/Controllers/{$name}.php");

        if (File::exists($path)) {
            throw new FileAlreadyExistsException("File already exists");
        }

        File::put($path, $ready_controller);
    }
}
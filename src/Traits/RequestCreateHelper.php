<?php

namespace Foxdevuz\CrudGenerator\Traits;


use Foxdevuz\CrudGenerator\Exceptions\FileAlreadyExistsException;
use Illuminate\Support\Facades\File;
use TypeError;

trait RequestCreateHelper
{
    use FileHelper;

    /**
     * @param string $type Either create or update
     * @param string $requestName
     * @param array|string|null $fields
     * @return void
     * @throws FileAlreadyExistsException
     */
    protected function createRequestFile(string $type, string $requestName, array|string|null $fields): void
    {
        if ($type == "create") {
            $request = $this->getRequestStub("create");
        } else if ($type == "update") {
            $request = $this->getRequestStub("update");
        } else {
            throw new TypeError("Type should be either create or update, other methods are not supported");
        }

        $ready_request = str_replace(
            ['{{requestName}}', '{{fields}}'],
            [$requestName, $fields],
            $request
        );

        $path = app_path("Http/Requests/{$requestName}.php");

        if (File::exists($path)) {
            throw new FileAlreadyExistsException("File already exists");
        }

        File::put($path, $ready_request);
    }
}